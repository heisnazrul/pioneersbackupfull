@php
    $branding = \App\Support\SystemSettings::branding();
    $appName = $branding['app_name'] ?? config('app.name');
    $primaryColor = $branding['primary_color'] ?? '#6366f1';
    $logoUrl = $branding['logo_url'] ?? asset('assets/logo.png');
    $faviconUrl = $branding['favicon_url'] ?? asset('assets/img/brand-logos/favicon.ico');
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $appName }} Login</title>
    <link rel="icon" href="{{ $faviconUrl }}">
    <style>
        :root {
            color-scheme: dark;
            --primary-color:
                {{ $primaryColor }}
            ;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            font-family: "Inter", "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: radial-gradient(circle at top left, #0f172a, #020617 55%, #000000 90%);
            color: #f8fafc;
        }

        .login-shell {
            position: relative;
            width: min(100%, 420px);
            background: linear-gradient(155deg, rgba(15, 23, 42, 0.98), rgba(15, 15, 26, 0.92));
            border-radius: 22px;
            padding: 3rem 2.75rem;
            box-shadow:
                0 30px 70px rgba(15, 23, 42, 0.65),
                0 18px 35px rgba(0, 0, 0, 0.45);
            border: 1px solid color-mix(in srgb, var(--primary-color), transparent 80%);
            overflow: hidden;
        }

        .login-shell::before,
        .login-shell::after {
            content: "";
            position: absolute;
            border-radius: 50%;
            filter: blur(70px);
            opacity: 0.32;
            transform: translateZ(0);
        }

        .login-shell::before {
            width: 180px;
            height: 180px;
            background: color-mix(in srgb, var(--primary-color) 60%, transparent 40%);
            top: -80px;
            right: -70px;
        }

        .login-shell::after {
            width: 190px;
            height: 190px;
            background: rgba(14, 165, 233, 0.48);
            bottom: -85px;
            left: -75px;
        }

        h1 {
            font-size: 2rem;
            font-weight: 700;
            color: #f1f5f9;
            letter-spacing: -0.02em;
        }

        p.subtitle {
            margin-top: 0.75rem;
            font-size: 0.95rem;
            color: rgba(148, 163, 184, 0.9);
            line-height: 1.6;
        }

        .alert {
            margin-top: 1.65rem;
            padding: 0.85rem 1rem;
            border-radius: 12px;
            font-size: 0.9rem;
            border: 1px solid rgba(248, 113, 113, 0.4);
            background: rgba(248, 113, 113, 0.12);
            color: #fecaca;
        }

        .status {
            margin-top: 1.65rem;
            padding: 0.85rem 1rem;
            border-radius: 12px;
            font-size: 0.9rem;
            border: 1px solid rgba(34, 197, 94, 0.35);
            background: rgba(34, 197, 94, 0.12);
            color: #bbf7d0;
        }

        form {
            margin-top: 2.4rem;
            display: grid;
            gap: 1.45rem;
        }

        label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: rgba(226, 232, 240, 0.92);
            margin-bottom: 0.5rem;
            letter-spacing: 0.01em;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            border: 1px solid rgba(148, 163, 184, 0.35);
            border-radius: 14px;
            padding: 0.9rem 1rem;
            font-size: 0.95rem;
            color: #f8fafc;
            background: rgba(15, 23, 42, 0.7);
            transition: border-color 0.2s ease, box-shadow 0.2s ease, background 0.2s ease, transform 0.2s ease;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: color-mix(in srgb, var(--primary-color) 80%, transparent 20%);
            background: rgba(30, 41, 59, 0.94);
            box-shadow:
                0 0 0 3px color-mix(in srgb, var(--primary-color) 25%, transparent 75%),
                0 12px 24px rgba(15, 23, 42, 0.45);
            transform: translateY(-1px);
        }

        .actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.85rem;
        }

        .actions label {
            margin: 0;
        }

        .actions a {
            color: color-mix(in srgb, var(--primary-color) 70%, white 30%);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s ease, opacity 0.2s ease;
        }

        .actions a:hover {
            color: color-mix(in srgb, var(--primary-color) 90%, white 10%);
            opacity: 0.92;
        }

        button[type="submit"] {
            margin-top: 0.6rem;
            width: 100%;
            border: none;
            border-radius: 16px;
            padding: 1rem 1rem;
            font-size: 1rem;
            font-weight: 600;
            color: #e2e8f0;
            background: linear-gradient(135deg, var(--primary-color), color-mix(in srgb, var(--primary-color) 80%, black 20%));
            box-shadow:
                0 22px 50px color-mix(in srgb, var(--primary-color) 45%, transparent 55%),
                0 12px 28px color-mix(in srgb, var(--primary-color) 35%, black 65%);
            cursor: pointer;
            transition: transform 0.18s ease, box-shadow 0.18s ease, filter 0.18s ease;
        }

        button[type="submit"]:hover {
            transform: translateY(-2px);
            box-shadow:
                0 26px 58px color-mix(in srgb, var(--primary-color) 50%, transparent 50%),
                0 16px 35px color-mix(in srgb, var(--primary-color) 40%, black 60%);
        }

        button[type="submit"]:active {
            transform: translateY(0);
            filter: brightness(0.96);
        }

        .alt-login {
            margin-top: 1.4rem;
            display: grid;
            gap: 0.75rem;
        }

        .secondary-button {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            padding: 0.85rem 1rem;
            border-radius: 14px;
            border: 1px solid rgba(148, 163, 184, 0.35);
            background: rgba(15, 23, 42, 0.45);
            color: #e2e8f0;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
        }

        @media (max-width: 540px) {
            body {
                padding: 1.5rem;
            }

            .login-shell {
                padding: 2.6rem 2.1rem;
                border-radius: 20px;
            }

            h1 {
                font-size: 1.75rem;
            }
        }
    </style>
</head>

<body>
    <div class="login-shell">
        @if ($logoUrl)
            <div class="mb-4 flex justify-center">
                <img src="{{ $logoUrl }}" alt="{{ $appName }} logo" class="h-14 object-contain">
            </div>
        @endif
        <h1>{{ $appName }} Login</h1>
        <p class="subtitle">Sign in with your credentials to access the dashboard.</p>
        @if (session('status'))
            <div class="status">
                {{ session('status') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert">
                {{ $errors->first() }}
            </div>
        @endif
        <form action="{{ route('login.attempt') }}" method="POST">
            @csrf
            <div>
                <label for="email">Email address</label>
                <input type="email" id="email" name="email" autocomplete="email" required placeholder="you@example.com">
            </div>
            <div>
                <div class="actions" style="margin-bottom: 0.5rem;">
                    <label for="password" style="margin: 0;">Password</label>
                    <a href="{{ route('password.request') }}">Forgot password?</a>
                </div>
                <input type="password" id="password" name="password" autocomplete="current-password" required
                    placeholder="Enter your password">
            </div>
            <button type="submit">Login</button>
        </form>
        <div class="alt-login">
            <a href="{{ route('login.google') }}" class="secondary-button"
                style="background: rgba(255, 255, 255, 0.1); border-color: rgba(255, 255, 255, 0.2);">
                <img src="https://www.google.com/favicon.ico" alt="Google" style="width: 16px; height: 16px;">
                Login with Google
            </a>
            <a href="{{ route('login.whatsapp') }}" class="secondary-button">
                Passwordless WhatsApp Login
            </a>
        </div>
    </div>
</body>

</html>