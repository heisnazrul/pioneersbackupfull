<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirectToGoogle(Request $request): RedirectResponse
    {
        if ($request->has('redirect_to')) {
            Session::put('redirect_to', $request->input('redirect_to'));
        }
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                // Create new user
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'username' => Str::slug($googleUser->getName()) . rand(1000, 9999),
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                    'password' => bcrypt(Str::random(32)), // Generate random secure password
                    'email_verified_at' => now(),
                    'role' => 'uni_student',
                    'status' => 'active',
                ]);
            } else {
                // Update existing user
                $updateData = [];
                if (!$user->google_id) {
                    $updateData['google_id'] = $googleUser->getId();
                }
                if (!$user->avatar) {
                    $updateData['avatar'] = $googleUser->getAvatar();
                }
                if (count($updateData) > 0) {
                    $user->update($updateData);
                }
            }

            $redirect = Session::pull('redirect_to');

            if ($redirect === 'frontend') {
                $token = $user->createToken('GoogleLogin')->accessToken;
                $userStr = json_encode($user);

                return response(<<<HTML
<html>
<head><title>Login Success</title></head>
<body>
    <script>
        window.opener.postMessage({
            type: 'GOOGLE_LOGIN_SUCCESS',
            token: '$token',
            userStr: '$userStr'
        }, '*');
        window.close();
    </script>
</body>
</html>
HTML
                );
            }

            Auth::login($user);

            return redirect()->route('admin.dashboard'); // Redirect to dashboard after login

        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['email' => 'Unable to login with Google. Please try again.']);
        }
    }
    public function handleOneTap(Request $request)
    {
        try {
            $credential = $request->input('credential');

            if (!$credential) {
                return response()->json(['success' => false, 'message' => 'No credential provided'], 400);
            }

            // Verify the ID Token with Google
            $client = new \GuzzleHttp\Client();
            $response = $client->get('https://oauth2.googleapis.com/tokeninfo', [
                'query' => ['id_token' => $credential]
            ]);

            $payload = json_decode($response->getBody()->getContents(), true);

            if (!isset($payload['email'])) {
                return response()->json(['success' => false, 'message' => 'Invalid token'], 400);
            }

            // Find or Create User
            $user = User::where('email', $payload['email'])->first();

            if (!$user) {
                $user = User::create([
                    'name' => $payload['name'],
                    'email' => $payload['email'],
                    'username' => Str::slug($payload['name']) . rand(1000, 9999),
                    'google_id' => $payload['sub'],
                    'avatar' => $payload['picture'] ?? null,
                    'password' => bcrypt(Str::random(32)),
                    'email_verified_at' => now(),
                    'role' => 'lg_student',
                    'status' => 'active',
                ]);
            } else {
                // Update missing fields
                $updateData = [];
                if (!$user->google_id)
                    $updateData['google_id'] = $payload['sub'];
                if (!$user->avatar && isset($payload['picture']))
                    $updateData['avatar'] = $payload['picture'];
                if (count($updateData) > 0)
                    $user->update($updateData);
            }

            // Create Access Token
            $token = $user->createToken('GoogleOneTap')->accessToken;

            return response()->json([
                'success' => true,
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user
            ]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Authentication failed: ' . $e->getMessage()], 500);
        }
    }
    public function loginFrontend()
    {
        return Socialite::driver('google')
            ->stateless()
            ->redirectUrl('http://127.0.0.1:8000/auth/google/frontend/callback')
            ->redirect();
    }

    public function callbackFrontend(Request $request)
    {
        try {
            if (!$request->has('code')) {
                return response()->json(['error' => 'No code provided', 'inputs' => $request->all()], 400);
            }
            $googleUser = Socialite::driver('google')
                ->stateless()
                ->redirectUrl('http://127.0.0.1:8000/auth/google/frontend/callback')
                ->user();

            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'username' => Str::slug($googleUser->getName()) . rand(1000, 9999),
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                    'password' => bcrypt(Str::random(32)), // Generate random secure password
                    'email_verified_at' => now(),
                    'role' => 'uni_student',
                    'status' => 'active',
                ]);
            } else {
                $updateData = [];
                if (!$user->google_id)
                    $updateData['google_id'] = $googleUser->getId();
                if (!$user->avatar)
                    $updateData['avatar'] = $googleUser->getAvatar();
                if (count($updateData) > 0)
                    $user->update($updateData);
            }

            $token = $user->createToken('GoogleLogin')->accessToken;
            $userStr = json_encode($user);

            return response(<<<HTML
<html>
<head><title>Login Success</title></head>
<body>
    <script>
        window.opener.postMessage({
            type: 'GOOGLE_LOGIN_SUCCESS',
            token: '$token',
            userStr: '$userStr'
        }, '*');
        window.close();
    </script>
</body>
</html>
HTML
            );

        } catch (\Exception $e) {
            return response("Login failed: " . $e->getMessage(), 500);
        }
    }
}
