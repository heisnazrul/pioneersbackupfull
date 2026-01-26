@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="box">
                <div class="box-body p-8">
                    <h1 class="text-3xl font-semibold text-gray-800 dark:text-white mb-4">Application Settings</h1>
                    <p class="text-gray-600 dark:text-white/70 text-base leading-relaxed max-w-3xl">
                        Toggle verification requirements and manage outbound email credentials without leaving the admin panel.
                    </p>

                    @if (session('success'))
                        <div class="mt-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mt-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                            <ul class="list-disc space-y-1 pl-4">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mt-8 grid gap-6 lg:grid-cols-2">
                        <div class="rounded-2xl border border-gray-200 dark:border-white/10 bg-white dark:bg-white/5 p-6">
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Application Branding</h2>
                            <p class="mt-2 text-sm text-gray-600 dark:text-white/70">
                                Upload your logo and adjust visual accents used across authentication screens.
                            </p>

                            <form action="{{ route('admin.settings.branding') }}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-4">
                                @csrf
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Application Name</label>
                                    <input type="text" name="app_name" value="{{ old('app_name', $branding['app_name'] ?? config('app.name')) }}" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Primary Color</label>
                                    <input type="color" name="primary_color" value="{{ old('primary_color', $branding['primary_color'] ?? '#6366f1') }}" class="mt-1 h-12 w-24 cursor-pointer rounded-lg border border-gray-300 bg-white dark:border-white/10 dark:bg-transparent" required>
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Logo</label>
                                    <input type="file" name="logo" accept="image/*" class="block w-full text-sm text-gray-700 file:mr-4 file:rounded-md file:border-0 file:bg-primary/10 file:px-4 file:py-2 file:text-primary dark:text-white/80">
                                    <p class="text-xs text-gray-500 dark:text-white/50">PNG or SVG up to 5&nbsp;MB.</p>
                                    @if (!empty($branding['logo_url']))
                                        <div class="mt-2 flex items-center gap-3">
                                            <img src="{{ $branding['logo_url'] }}" alt="Current logo" class="h-12 w-12 rounded object-contain bg-white/80 p-2">
                                            <span class="text-xs text-gray-500 dark:text-white/60">Current logo preview</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Favicon</label>
                                    <input type="file" name="favicon" accept="image/png,image/svg+xml,image/x-icon" class="block w-full text-sm text-gray-700 file:mr-4 file:rounded-md file:border-0 file:bg-primary/10 file:px-4 file:py-2 file:text-primary dark:text-white/80">
                                    <p class="text-xs text-gray-500 dark:text-white/50">ICO, PNG, or SVG up to 2&nbsp;MB.</p>
                                    @if (!empty($branding['favicon_url']))
                                        <div class="mt-2 flex items-center gap-3">
                                            <img src="{{ $branding['favicon_url'] }}" alt="Current favicon" class="h-10 w-10 rounded object-contain bg-white/80 p-2">
                                            <span class="text-xs text-gray-500 dark:text-white/60">Current favicon preview</span>
                                        </div>
                                    @endif
                                </div>

                                <button type="submit" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-info mt-4">
                                    Save Branding
                                </button>
                            </form>
                        </div>
                        <div class="rounded-2xl border border-gray-200 dark:border-white/10 bg-white dark:bg-white/5 p-6">
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Email Verification</h2>
                            <p class="mt-2 text-sm text-gray-600 dark:text-white/70">
                                Decide which user roles must verify their email address before accessing the platform.
                            </p>

                            <form action="{{ route('admin.settings.email') }}" method="POST" class="mt-6 space-y-4">
                                @csrf
                                <fieldset class="space-y-3">
                                    @foreach ($roles as $role)
                                        <label class="flex items-center gap-3 text-sm font-medium text-gray-700 dark:text-white/80">
                                            <input
                                                type="checkbox"
                                                name="roles[]"
                                                value="{{ $role }}"
                                                class="rounded border-gray-300 text-primary focus:ring-primary"
                                                {{ in_array($role, $emailVerificationRoles, true) ? 'checked' : '' }}
                                            >
                                            <span>{{ ucfirst($role) }}</span>
                                        </label>
                                    @endforeach
                                </fieldset>

                                <button type="submit" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary mt-4">
                                    Save Email Verification
                                </button>
                            </form>
                        </div>

                        <div class="rounded-2xl border border-gray-200 dark:border-white/10 bg-white dark:bg-white/5 p-6">
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">SMTP Configuration</h2>
                            <p class="mt-2 text-sm text-gray-600 dark:text-white/70">
                                Update the mail server credentials used for transactional emails such as verification codes.
                            </p>

                            <form action="{{ route('admin.settings.smtp') }}" method="POST" class="mt-6 grid gap-4">
                                @csrf
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Host</label>
                                    <input type="text" name="host" value="{{ old('host', $smtp['host'] ?? '') }}" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent" required>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Port</label>
                                        <input type="number" name="port" value="{{ old('port', $smtp['port'] ?? '') }}" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent" required>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Encryption</label>
                                        <select name="encryption" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
                                            <option value="" {{ empty($smtp['encryption']) ? 'selected' : '' }}>None</option>
                                            <option value="tls" {{ ($smtp['encryption'] ?? '') === 'tls' ? 'selected' : '' }}>TLS</option>
                                            <option value="ssl" {{ ($smtp['encryption'] ?? '') === 'ssl' ? 'selected' : '' }}>SSL</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Username</label>
                                        <input type="text" name="username" value="{{ old('username', $smtp['username'] ?? '') }}" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Password</label>
                                        <input type="password" name="password" placeholder="••••••••" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
                                        <p class="mt-1 text-xs text-gray-500 dark:text-white/50">Leave blank to keep the current password.</p>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">From Email</label>
                                        <input type="email" name="from_address" value="{{ old('from_address', $smtp['from_address'] ?? '') }}" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent" required>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">From Name</label>
                                        <input type="text" name="from_name" value="{{ old('from_name', $smtp['from_name'] ?? '') }}" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent" required>
                                    </div>
                                </div>

                                <button type="submit" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-success mt-2">
                                    Save SMTP Settings
                                </button>
                            </form>
                        </div>

                        <div class="rounded-2xl border border-gray-200 dark:border-white/10 bg-white dark:bg-white/5 p-6">
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Twilio WhatsApp OTP</h2>
                            <p class="mt-2 text-sm text-gray-600 dark:text-white/70">
                                Configure Twilio credentials used for WhatsApp OTP logins.
                            </p>

                            <form action="{{ route('admin.settings.twilio') }}" method="POST" class="mt-6 grid gap-4">
                                @csrf
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Account SID</label>
                                    <input type="text" name="account_sid" value="{{ old('account_sid', $twilio['account_sid'] ?? '') }}" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Auth Token</label>
                                    <input type="password" name="auth_token" value="{{ old('auth_token', $twilio['auth_token'] ?? '') }}" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-white/80">From WhatsApp</label>
                                    <input type="text" name="from_whatsapp" value="{{ old('from_whatsapp', $twilio['from_whatsapp'] ?? '') }}" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent" placeholder="whatsapp:+1234567890" required>
                                </div>

                                <button type="submit" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary mt-2">
                                    Save Twilio Settings
                                </button>
                            </form>
                        </div>

                        <div class="rounded-2xl border border-gray-200 dark:border-white/10 bg-white dark:bg-white/5 p-6">
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Private API Allowlist</h2>
                            <p class="mt-2 text-sm text-gray-600 dark:text-white/70">
                                Control which client identifiers can call private, authenticated APIs (routes using the <code class="font-mono text-xs">api.client</code> middleware). Leave empty to allow all. Clients must send an <code class="font-mono text-xs">X-App-Client</code> header matching one of these values.
                            </p>

                            <form action="{{ route('admin.settings.api-clients') }}" method="POST" class="mt-6 space-y-4">
                                @csrf
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Allowed clients (one per line or comma separated)</label>
                                    <textarea name="clients" rows="6" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent" placeholder="e.g. mobile-app&#10;partner-portal">{{ old('clients', implode("\n", $apiClients ?? [])) }}</textarea>
                                </div>
                                <label class="flex items-center gap-3 text-sm font-medium text-gray-700 dark:text-white/80">
                                    <input type="checkbox" name="allow_http" value="1" class="rounded border-gray-300 text-primary focus:ring-primary" {{ old('allow_http', $apiAllowHttp ?? false) ? 'checked' : '' }}>
                                    <span>Allow HTTP (insecure) requests to private APIs</span>
                                </label>
                                <button type="submit" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-info">
                                    Save API Allowlist
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
