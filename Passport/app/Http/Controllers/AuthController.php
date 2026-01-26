<?php

namespace App\Http\Controllers;

use App\Mail\OtpMail;
use App\Models\User;
use App\Models\UserOtp;
use App\Models\UserTrustedDevice;
use App\Support\SystemSettings;
use Carbon\CarbonImmutable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Cookie as CookieInstance;

class AuthController extends Controller
{
    private const OTP_TTL_MINUTES = 10;
    private const OTP_LENGTH = 6;
    private const TRUSTED_DEVICE_COOKIE = 'trusted_device';
    private const TRUSTED_DEVICE_TTL_MINUTES = 60 * 24 * 365;

    public function showLoginForm(): View
    {
        if ($redirect = self::redirectForUser(auth()->user())) {
            return redirect()->to($redirect);
        }

        return view('auth.login');
    }

    public function showWhatsappLoginForm(Request $request): View
    {
        if ($redirect = self::redirectForUser(auth()->user())) {
            return redirect()->to($redirect);
        }

        return view('auth.login-whatsapp', [
            'phone' => old('phone', $request->session()->get('whatsapp_phone')),
            'otpSent' => $request->session()->has('whatsapp_user_id'),
        ]);
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (! Auth::validate($credentials)) {
            return back()->withErrors([
                'email' => 'These credentials do not match our records.',
            ])->onlyInput('email');
        }

        $user = User::where('email', $credentials['email'])->firstOrFail();

        if ($user->status === 'banned') {
            return back()->withErrors([
                'email' => 'This account has been banned. Contact support for assistance.',
            ])->onlyInput('email');
        }

        if ($user->status !== 'active') {
            return back()->withErrors([
                'email' => $user->role === 'agent'
                    ? 'Your agent account is waiting for approval. We will notify you when it is active.'
                    : 'Your account is inactive. Please contact an administrator.',
            ])->onlyInput('email');
        }

        if (SystemSettings::requiresEmailVerification($user->role) && ! $user->email_verified_at) {
            return back()->withErrors([
                'email' => 'Verify your email address before signing in. Check your inbox for the confirmation code.',
            ])->onlyInput('email');
        }

        $requiresEmailVerification = SystemSettings::requiresEmailVerification($user->role);

        if (! $requiresEmailVerification) {
            if (! $user->email_verified_at) {
                $user->forceFill(['email_verified_at' => now()])->save();
            }

            return $this->completeLogin(
                $request,
                $user,
                rememberDevice: false
            );
        }

        if ($trusted = $this->resolveTrustedDevice($request, $user)) {
            return $this->completeLogin(
                $request,
                $user,
                rememberDevice: false,
                trustedDevice: $trusted['device'],
                rawToken: $trusted['token']
            );
        }

        $otp = $this->issueOtp($user, 'login');

        $this->sendOtp($user, $otp, 'Login verification');

        $this->storeOtpContext($request, $user, $otp, 'login');

        return redirect()
            ->route('auth.verify')
            ->with('status', 'We just emailed a verification code to '. $this->maskEmail($user->email) .'. Enter it below to finish signing in.');
    }

    public function sendWhatsappOtp(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'phone' => ['required', 'string', 'max:30'],
        ]);

        $phone = trim($data['phone']);
        $digitsOnly = preg_replace('/\D+/', '', $phone) ?? '';
        $variants = array_filter([
            $phone,
            str_replace(' ', '', $phone),
            $digitsOnly ? ('+' . $digitsOnly) : null,
            $digitsOnly,
            $digitsOnly ? ('00' . $digitsOnly) : null,
        ]);

        if ($digitsOnly !== '') {
            if (str_starts_with($digitsOnly, '880')) {
                $local = substr($digitsOnly, 3);
                if ($local !== '') {
                    $variants[] = '0' . $local;
                }
            }

            if (str_starts_with($digitsOnly, '0')) {
                $variants[] = ltrim($digitsOnly, '0');
            }
        }

        $variants = array_values(array_unique(array_filter($variants)));

        $normalizedDigits = $digitsOnly;
        $user = User::query()
            ->whereIn('role', ['lg_student', 'uni_student'])
            ->where(function ($query) use ($variants, $normalizedDigits) {
                $query->whereIn('phone', $variants)
                    ->orWhereHas('profile', function ($q) use ($variants, $normalizedDigits) {
                        $q->whereIn('alt_phone_e164', $variants);

                        if ($normalizedDigits !== '') {
                            $q->orWhereRaw(
                                "REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(alt_phone_e164, '+', ''), ' ', ''), '-', ''), '(', ''), ')', '') = ?",
                                [$normalizedDigits]
                            );
                        }
                    });

                if ($normalizedDigits !== '') {
                    $query->orWhereRaw(
                        "REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(phone, '+', ''), ' ', ''), '-', ''), '(', ''), ')', '') = ?",
                        [$normalizedDigits]
                    );
                }
            })
            ->first();

        if (! $user) {
            return back()->withErrors([
                'phone' => 'No student account found for that phone number.',
            ])->withInput();
        }

        if ($user->status === 'banned') {
            return back()->withErrors([
                'phone' => 'This account has been banned.',
            ])->withInput();
        }

        if ($user->status !== 'active') {
            return back()->withErrors([
                'phone' => 'This account is inactive.',
            ])->withInput();
        }

        $otp = $this->issueWhatsappOtp($user);

        if (! $this->sendWhatsappMessage($phone, $otp->code)) {
            return back()->withErrors([
                'phone' => 'Unable to send WhatsApp OTP. Check Twilio settings.',
            ])->withInput();
        }

        $request->session()->put([
            'whatsapp_user_id' => $user->id,
            'whatsapp_phone' => $phone,
        ]);

        return redirect()
            ->route('login.whatsapp')
            ->with('status', 'OTP sent to your WhatsApp number.');
    }

    public function verifyWhatsappOtp(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'code' => ['required', 'digits:'.self::OTP_LENGTH],
        ]);

        $userId = $request->session()->get('whatsapp_user_id');
        if (! $userId) {
            return redirect()->route('login.whatsapp')->withErrors([
                'phone' => 'Start by requesting an OTP.',
            ]);
        }

        $otp = UserOtp::query()
            ->where('user_id', $userId)
            ->where('purpose', 'whatsapp_login')
            ->whereNull('used_at')
            ->where('code', $validated['code'])
            ->latest()
            ->first();

        if (! $otp || $otp->isExpired()) {
            return back()->withErrors([
                'code' => 'The verification code is invalid or has expired.',
            ]);
        }

        $otp->markAsUsed();

        $this->clearWhatsappContext($request);

        $user = $otp->user;

        return $this->completeLogin($request, $user, rememberDevice: false);
    }

    public function showForgotForm(): View
    {
        if ($redirect = self::redirectForUser(auth()->user())) {
            return redirect()->to($redirect);
        }

        return view('auth.forgot-password');
    }

    public function showResetPasswordForm(Request $request, string $token): RedirectResponse|View
    {
        if ($redirect = self::redirectForUser($request->user())) {
            return redirect()->to($redirect);
        }

        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->query('email'),
        ]);
    }

    public function resetPassword(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'token' => ['required', 'string'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'confirmed', 'min:8'],
        ]);

        $status = Password::reset(
            $credentials,
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                    'email_verified_at' => $user->email_verified_at ?? now(),
                ])->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', __($status));
        }

        return back()->withErrors(['email' => __($status)]);
    }

    public function sendForgotOtp(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::where('email', $data['email'])->first();

        if (! $user) {
            return back()
                ->with('status', 'If that email exists in our system we will send a verification code shortly.')
                ->onlyInput('email');
        }

        $otp = $this->issueOtp($user, 'password_reset');

        $this->sendOtp($user, $otp, 'Password reset verification');

        $this->storeOtpContext($request, $user, $otp, 'password_reset');

        return redirect()
            ->route('auth.verify')
            ->with('status', 'We sent a reset verification code to '. $this->maskEmail($user->email) .'. Enter the code and set your new password.');
    }

    public function showVerifyForm(Request $request): RedirectResponse|View
    {
        if ($redirect = self::redirectForUser($request->user())) {
            return redirect()->to($redirect);
        }

        if (! $request->session()->has('otp_user_id')) {
            return redirect()->route('login')->withErrors([
                'email' => 'Start by logging in or requesting a password reset.',
            ]);
        }

        return view('auth.verifi', [
            'purpose' => $request->session()->get('otp_purpose'),
            'email' => $request->session()->get('otp_email'),
        ]);
    }

    public function verifyOtp(Request $request): RedirectResponse
    {
        $purpose = $request->session()->get('otp_purpose');
        $userId = $request->session()->get('otp_user_id');

        if (! $purpose || ! $userId) {
            return redirect()->route('login')->withErrors([
                'email' => 'Your verification session expired. Please try again.',
            ]);
        }

        $rules = [
            'code' => ['required', 'digits:'.self::OTP_LENGTH],
        ];

        if ($purpose === 'password_reset') {
            $rules['password'] = ['required', 'string', 'min:8', 'confirmed'];
        }

        $validated = $request->validate($rules);

        $otp = UserOtp::query()
            ->where('user_id', $userId)
            ->where('purpose', $purpose)
            ->whereNull('used_at')
            ->where('code', $validated['code'])
            ->latest()
            ->first();

        if (! $otp || $otp->isExpired()) {
            return back()->withErrors([
                'code' => 'The verification code is invalid or has expired.',
            ]);
        }

        $otp->markAsUsed();

        $user = $otp->user;

        if ($purpose === 'login') {
            $this->clearOtpContext($request);

            return $this->completeLogin($request, $user, rememberDevice: true);
        }

        if ($purpose === 'password_reset') {
            $user->update([
                'password' => $validated['password'],
            ]);

            $this->clearOtpContext($request);

            return redirect()->route('login')
                ->with('status', 'Password updated successfully. Please sign in with your new password.');
        }

        $this->clearOtpContext($request);

        return redirect()->route('login')->withErrors([
            'email' => 'Unknown verification purpose.',
        ]);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    private function issueOtp(User $user, string $purpose): UserOtp
    {
        $user->otps()
            ->where('purpose', $purpose)
            ->whereNull('used_at')
            ->delete();

        $code = str_pad((string) random_int(0, (10 ** self::OTP_LENGTH) - 1), self::OTP_LENGTH, '0', STR_PAD_LEFT);

        return $user->otps()->create([
            'purpose' => $purpose,
            'code' => $code,
            'channel' => 'email',
            'expires_at' => CarbonImmutable::now()->addMinutes(self::OTP_TTL_MINUTES),
            'meta' => [
                'ip' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ],
        ]);
    }

    private function issueWhatsappOtp(User $user): UserOtp
    {
        $user->otps()
            ->where('purpose', 'whatsapp_login')
            ->whereNull('used_at')
            ->delete();

        $code = str_pad((string) random_int(0, (10 ** self::OTP_LENGTH) - 1), self::OTP_LENGTH, '0', STR_PAD_LEFT);

        return $user->otps()->create([
            'purpose' => 'whatsapp_login',
            'code' => $code,
            'channel' => 'whatsapp',
            'expires_at' => CarbonImmutable::now()->addMinutes(self::OTP_TTL_MINUTES),
            'meta' => [
                'ip' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ],
        ]);
    }

    private function sendWhatsappMessage(string $phone, string $code): bool
    {
        $settings = SystemSettings::twilio();
        $sid = $settings['account_sid'] ?? null;
        $token = $settings['auth_token'] ?? null;
        $from = $settings['from_whatsapp'] ?? null;

        if (! $sid || ! $token || ! $from) {
            return false;
        }

        $to = str_starts_with($phone, 'whatsapp:') ? $phone : 'whatsapp:' . $phone;

        $response = Http::withBasicAuth($sid, $token)
            ->asForm()
            ->post("https://api.twilio.com/2010-04-01/Accounts/{$sid}/Messages.json", [
                'From' => $from,
                'To' => $to,
                'Body' => "Your login code is {$code}",
            ]);

        return $response->successful();
    }

    private function clearWhatsappContext(Request $request): void
    {
        $request->session()->forget([
            'whatsapp_user_id',
            'whatsapp_phone',
        ]);
    }

    private function sendOtp(User $user, UserOtp $otp, string $purposeLabel): void
    {
        $expiresHuman = $otp->expires_at?->diffForHumans(null, true);

        Mail::to($user->email)->send(
            new OtpMail($otp->code, $purposeLabel, $expiresHuman ? "in {$expiresHuman}" : null)
        );
    }

    private function storeOtpContext(Request $request, User $user, UserOtp $otp, string $purpose): void
    {
        $request->session()->put([
            'otp_user_id' => $user->id,
            'otp_email' => $user->email,
            'otp_id' => $otp->id,
            'otp_purpose' => $purpose,
        ]);
    }

    private function clearOtpContext(Request $request): void
    {
        $request->session()->forget([
            'otp_user_id',
            'otp_email',
            'otp_id',
            'otp_purpose',
        ]);
    }

    private function maskEmail(string $email): string
    {
        [$local, $domain] = explode('@', $email, 2);
        $visibleLocal = substr($local, 0, 2);
        $maskedLocal = str_repeat('•', max(strlen($local) - 2, 2));

        return sprintf('%s%s@%s', $visibleLocal, $maskedLocal, $domain);
    }

    private function resolveTrustedDevice(Request $request, User $user): ?array
    {
        $cookieValue = $request->cookie(self::TRUSTED_DEVICE_COOKIE);

        if (! $cookieValue) {
            return null;
        }

        $parts = explode('|', $cookieValue, 2);

        if (count($parts) !== 2) {
            $this->forgetTrustedCookie();

            return null;
        }

        [$deviceId, $rawToken] = $parts;

        if (! ctype_digit($deviceId) || empty($rawToken)) {
            $this->forgetTrustedCookie();

            return null;
        }

        $device = $user->trustedDevices()->find($deviceId);

        if (! $device) {
            $this->forgetTrustedCookie();

            return null;
        }

        if (! hash_equals($device->token_hash, hash('sha256', $rawToken))) {
            $device->delete();
            $this->forgetTrustedCookie();

            return null;
        }

        return [
            'device' => $device,
            'token' => $rawToken,
        ];
    }

    private function completeLogin(
        Request $request,
        User $user,
        bool $rememberDevice,
        ?UserTrustedDevice $trustedDevice = null,
        ?string $rawToken = null
    ): RedirectResponse {
        Auth::login($user, true);
        $user->forceFill(['last_login_at' => now()])->save();

        $destination = self::redirectForUser($user) ?? route('home');

        $message = 'Welcome back, ' . Str::of($user->name ?? $user->email)->trim() . '!';

        $intended = $request->session()->pull('url.intended');

        $response = $intended && ! $this->shouldIgnoreIntended($intended)
            ? redirect()->to($intended)
            : redirect()->to($destination);

        $response = $response->with('status', $message);

        if ($rememberDevice) {
            [$device, $token] = $this->createTrustedDevice($request, $user);
            $cookie = $this->makeTrustedDeviceCookie($device->id, $token);

            return $response->withCookie($cookie);
        }

        if ($trustedDevice && $rawToken) {
            $trustedDevice->forceFill([
                'last_used_at' => now(),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ])->save();

            $cookie = $this->makeTrustedDeviceCookie($trustedDevice->id, $rawToken);

            return $response->withCookie($cookie);
        }

        return $response;
    }

    private function shouldIgnoreIntended(?string $url): bool
    {
        if (! $url) {
            return true;
        }

        $path = parse_url($url, PHP_URL_PATH) ?? '';

        $ignored = [
            '/',
            route('login', [], false),
            route('auth.verify', [], false),
            route('agent.verify', [], false),
        ];

        $ignored = array_merge($ignored, ['/login', '/verify', '/agent/verify']);

        return in_array($path, $ignored, true);
    }

    public static function redirectForUser(?User $user): ?string
    {
        if (! $user) {
            return null;
        }

        $routeMap = [
            'admin' => 'admin.dashboard',
            'agent' => 'agent.dashboard',
            'uni_agent' => 'agent.dashboard',
            'lg_agent' => 'agent.dashboard',
            'team' => 'team.dashboard',
            'counselor' => 'counselor.dashboard',
            'counsellor' => 'counselor.dashboard',
            'school' => 'school.dashboard',
            'student' => 'student.dashboard',
            'lg_student' => 'student.dashboard',
            'uni_student' => 'student.dashboard',
        ];

        $routeName = $routeMap[$user->role] ?? null;

        if ($routeName && Route::has($routeName)) {
            return route($routeName);
        }

        return Route::has('home') ? route('home') : url('/');
    }

    private function createTrustedDevice(Request $request, User $user): array
    {
        $rawToken = Str::random(64);

        $device = $user->trustedDevices()->create([
            'token_hash' => hash('sha256', $rawToken),
            'device_name' => $this->determineDeviceName($request),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'last_used_at' => now(),
        ]);

        return [$device, $rawToken];
    }

    private function makeTrustedDeviceCookie(int $deviceId, string $rawToken): CookieInstance
    {
        return cookie(
            self::TRUSTED_DEVICE_COOKIE,
            $deviceId . '|' . $rawToken,
            self::TRUSTED_DEVICE_TTL_MINUTES,
            '/',
            null,
            config('session.secure', false),
            true,
            false,
            config('session.same_site', 'lax') ?? 'lax'
        );
    }

    private function forgetTrustedCookie(): void
    {
        Cookie::queue(Cookie::forget(self::TRUSTED_DEVICE_COOKIE, '/', null));
    }

    private function determineDeviceName(Request $request): string
    {
        $agent = $request->userAgent();

        return $agent
            ? Str::limit($agent, 60, '')
            : 'Unknown device';
    }
}
