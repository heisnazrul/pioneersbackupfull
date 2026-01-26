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
    <title>{{ $appName }} WhatsApp Login</title>
    <link rel="icon" href="{{ $faviconUrl }}">
    <style>
        :root {
            color-scheme: dark;
            --primary-color: {{ $primaryColor }};
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
            width: min(100%, 460px);
            background: linear-gradient(155deg, rgba(15, 23, 42, 0.98), rgba(15, 15, 26, 0.92));
            border-radius: 22px;
            padding: 3rem 2.75rem;
            box-shadow:
                0 30px 70px rgba(15, 23, 42, 0.65),
                0 18px 35px rgba(0, 0, 0, 0.45);
            border: 1px solid color-mix(in srgb, var(--primary-color), transparent 80%);
            overflow: hidden;
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

        .alert, .status {
            margin-top: 1.65rem;
            padding: 0.85rem 1rem;
            border-radius: 12px;
            font-size: 0.9rem;
        }

        .alert {
            border: 1px solid rgba(248, 113, 113, 0.4);
            background: rgba(248, 113, 113, 0.12);
            color: #fecaca;
        }

        .status {
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

        input[type="text"] {
            width: 100%;
            border: 1px solid rgba(148, 163, 184, 0.35);
            border-radius: 14px;
            padding: 0.9rem 1rem;
            font-size: 0.95rem;
            color: #f8fafc;
            background: rgba(15, 23, 42, 0.7);
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
            cursor: pointer;
        }

        .back-link {
            margin-top: 1.5rem;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            color: color-mix(in srgb, var(--primary-color) 80%, white 20%);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="login-shell">
        <img src="{{ $logoUrl }}" alt="{{ $appName }}" style="height:40px;">
        <h1>WhatsApp OTP Login</h1>
        <p class="subtitle">Enter your WhatsApp number to receive a login code.</p>

        @if ($errors->any())
            <div class="alert">{{ $errors->first() }}</div>
        @endif

        @if (session('status'))
            <div class="status">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login.whatsapp.send') }}">
            @csrf
            <div>
                <label for="phone">WhatsApp Number (E.164)</label>
                <input type="text" name="phone" id="phone" value="{{ $phone }}" placeholder="+15551234567" required>
            </div>
            <button type="submit">Send OTP</button>
        </form>

        @if ($otpSent)
            <form method="POST" action="{{ route('login.whatsapp.verify') }}">
                @csrf
                <div>
                    <label for="code">OTP Code</label>
                    <input type="text" name="code" id="code" placeholder="123456" required>
                </div>
                <button type="submit">Verify & Login</button>
            </form>
        @endif

        <a class="back-link" href="{{ route('login') }}">Back to password login</a>
    </div>
</body>
</html>
