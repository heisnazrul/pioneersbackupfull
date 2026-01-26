<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Support\SystemSettings;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function index(): View
    {
        return view('admin.settings.index', [
            'roles' => User::ROLES,
            'emailVerificationRoles' => SystemSettings::emailVerificationRoles(),
            'smtp' => SystemSettings::smtp(),
            'branding' => SystemSettings::branding(),
            'apiClients' => SystemSettings::apiClients(),
            'apiAllowHttp' => SystemSettings::apiAllowHttp(),
            'twilio' => SystemSettings::twilio(),
        ]);
    }

    public function updateEmailVerification(Request $request): RedirectResponse
    {
        $roles = $request->input('roles', []);
        $allowedRoles = array_values(array_intersect(User::ROLES, $roles));

        SystemSettings::setEmailVerificationRoles($allowedRoles);

        return back()->with('success', 'Email verification settings updated.');
    }

    public function updateSmtp(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'host' => ['required', 'string', 'max:255'],
            'port' => ['required', 'integer'],
            'encryption' => ['nullable', 'string', 'in:tls,ssl'],
            'username' => ['nullable', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'max:255'],
            'from_address' => ['required', 'email'],
            'from_name' => ['required', 'string', 'max:255'],
        ]);

        $current = SystemSettings::smtp();

        if (isset($validated['encryption']) && $validated['encryption'] === '') {
            $validated['encryption'] = null;
        }

        if (empty($validated['password']) && ! empty($current['password'])) {
            $validated['password'] = $current['password'];
        }

        $validated['password'] = $validated['password'] ?: null;

        if ($validated['username'] === '') {
            $validated['username'] = null;
        }

        SystemSettings::setSmtp($validated);

        config([
            'mail.mailers.smtp.host' => $validated['host'],
            'mail.mailers.smtp.port' => $validated['port'],
            'mail.mailers.smtp.username' => $validated['username'] ?? null,
            'mail.mailers.smtp.password' => $validated['password'] ?? null,
            'mail.mailers.smtp.encryption' => $validated['encryption'] ?? null,
            'mail.from.address' => $validated['from_address'],
            'mail.from.name' => $validated['from_name'],
        ]);

        return back()->with('success', 'SMTP configuration updated.');
    }

    public function updateBranding(Request $request): RedirectResponse
    {
        $branding = SystemSettings::branding();

        $validated = $request->validate([
            'app_name' => ['required', 'string', 'max:255'],
            'primary_color' => ['required', 'regex:/^#([0-9a-fA-F]{6})$/'],
            'logo' => ['nullable', 'image', 'max:5120'],
            'favicon' => ['nullable', 'file', 'mimes:ico,png,svg', 'max:2048'],
        ]);

        $disk = config('system.logo_disk', 'public');
        $logoPath = $branding['logo'] ?? null;
        $faviconPath = $branding['favicon'] ?? null;

        if ($request->hasFile('logo')) {
            if (! empty($logoPath)) {
                Storage::disk($disk)->delete($logoPath);
            }

            $logoPath = $request->file('logo')->store('branding', $disk);
        }

        if ($request->hasFile('favicon')) {
            if (! empty($faviconPath)) {
                Storage::disk($disk)->delete($faviconPath);
            }

            $faviconPath = $request->file('favicon')->store('branding', $disk);
        }

        SystemSettings::setBranding([
            'app_name' => $validated['app_name'],
            'primary_color' => $validated['primary_color'],
            'logo' => $logoPath,
            'favicon' => $faviconPath,
        ]);

        config(['app.name' => $validated['app_name']]);

        return back()->with('success', 'Branding settings updated.');
    }

    public function updateApiClients(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'clients' => ['nullable', 'string'],
            'allow_http' => ['nullable', 'boolean'],
        ]);

        $raw = $validated['clients'] ?? '';
        $list = preg_split('/[\r\n,]+/', $raw);
        $list = array_values(array_filter(array_map('trim', $list)));

        SystemSettings::setApiClients($list);
        SystemSettings::setApiAllowHttp((bool) ($validated['allow_http'] ?? false));

        return back()->with('success', 'API client allowlist updated.');
    }

    public function updateTwilio(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'account_sid' => ['required', 'string', 'max:255'],
            'auth_token' => ['required', 'string', 'max:255'],
            'from_whatsapp' => ['required', 'string', 'max:255'],
        ]);

        SystemSettings::setTwilio([
            'account_sid' => $validated['account_sid'],
            'auth_token' => $validated['auth_token'],
            'from_whatsapp' => $validated['from_whatsapp'],
        ]);

        return back()->with('success', 'Twilio WhatsApp settings updated.');
    }
}
