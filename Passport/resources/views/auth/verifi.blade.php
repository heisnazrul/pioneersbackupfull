<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification</title>
    <style>
        :root {
            color-scheme: dark;
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
            background: radial-gradient(circle at top left, #020617, #010103 65%, #000000 95%);
            color: #e2e8f0;
        }

        .verify-shell {
            position: relative;
            width: min(100%, 460px);
            background: linear-gradient(155deg, rgba(15, 23, 42, 0.96), rgba(12, 12, 20, 0.95));
            border-radius: 24px;
            padding: 3.2rem 2.9rem;
            box-shadow:
                0 32px 80px rgba(15, 23, 42, 0.65),
                0 18px 40px rgba(0, 0, 0, 0.48);
            border: 1px solid rgba(56, 189, 248, 0.24);
            overflow: hidden;
        }

        .verify-shell::before,
        .verify-shell::after {
            content: "";
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.32;
        }

        .verify-shell::before {
            width: 200px;
            height: 200px;
            background: rgba(56, 189, 248, 0.55);
            top: -90px;
            right: -70px;
        }

        .verify-shell::after {
            width: 220px;
            height: 220px;
            background: rgba(129, 140, 248, 0.5);
            bottom: -100px;
            left: -80px;
        }

        h1 {
            font-size: 2.05rem;
            font-weight: 700;
            color: #f8fafc;
            letter-spacing: -0.018em;
        }

        p.subtitle {
            margin-top: 0.75rem;
            font-size: 0.96rem;
            color: rgba(148, 163, 184, 0.92);
            line-height: 1.65;
        }

        .status,
        .alert {
            margin-top: 1.6rem;
            padding: 0.9rem 1.05rem;
            border-radius: 12px;
            font-size: 0.92rem;
        }

        .status {
            border: 1px solid rgba(34, 197, 94, 0.4);
            background: rgba(34, 197, 94, 0.12);
            color: #bbf7d0;
        }

        .alert {
            border: 1px solid rgba(248, 113, 113, 0.4);
            background: rgba(248, 113, 113, 0.12);
            color: #fecaca;
        }

        form {
            margin-top: 2.4rem;
            display: grid;
            gap: 1.55rem;
        }

        label {
            display: block;
            font-size: 0.86rem;
            font-weight: 600;
            color: rgba(226, 232, 240, 0.95);
            margin-bottom: 0.55rem;
            letter-spacing: 0.012em;
        }

        label span.optional {
            font-size: 0.78rem;
            font-weight: 500;
            color: rgba(148, 163, 184, 0.8);
            margin-left: 0.4rem;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            border: 1px solid rgba(148, 163, 184, 0.35);
            border-radius: 14px;
            padding: 0.95rem 1.05rem;
            font-size: 0.98rem;
            color: #f8fafc;
            background: rgba(15, 23, 42, 0.72);
            transition:
                border-color 0.2s ease,
                box-shadow 0.2s ease,
                background 0.2s ease,
                transform 0.2s ease;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: rgba(56, 189, 248, 0.82);
            background: rgba(30, 41, 59, 0.94);
            box-shadow:
                0 0 0 3px rgba(56, 189, 248, 0.25),
                0 14px 26px rgba(8, 145, 178, 0.32);
            transform: translateY(-1px);
        }

        .form-hint {
            margin-top: 0.35rem;
            font-size: 0.78rem;
            color: rgba(148, 163, 184, 0.75);
        }

        button[type="submit"] {
            margin-top: 0.6rem;
            width: 100%;
            border: none;
            border-radius: 16px;
            padding: 1rem 1.1rem;
            font-size: 1rem;
            font-weight: 600;
            color: #e2e8f0;
            background: linear-gradient(135deg, #38bdf8, #6366f1);
            box-shadow:
                0 24px 52px rgba(14, 165, 233, 0.45),
                0 14px 32px rgba(99, 102, 241, 0.35);
            cursor: pointer;
            transition: transform 0.18s ease, box-shadow 0.18s ease, filter 0.18s ease;
        }

        button[type="submit"]:hover {
            transform: translateY(-2px);
            box-shadow:
                0 28px 60px rgba(56, 189, 248, 0.5),
                0 16px 38px rgba(99, 102, 241, 0.4);
        }

        button[type="submit"]:active {
            transform: translateY(0);
            filter: brightness(0.96);
        }

        .back-link {
            display: inline-flex;
            margin-top: 1.4rem;
            font-size: 0.85rem;
            font-weight: 600;
            color: rgba(129, 140, 248, 0.92);
            text-decoration: none;
            transition: color 0.2s ease, opacity 0.2s ease;
        }

        .back-link:hover {
            color: rgba(165, 180, 252, 1);
            opacity: 0.92;
        }

        @media (max-width: 540px) {
            body {
                padding: 1.5rem;
            }

            .verify-shell {
                padding: 2.7rem 2.2rem;
                border-radius: 20px;
            }

            h1 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>
    @php
        use Illuminate\Support\Str;
        $isPasswordReset = ($purpose ?? null) === 'password_reset';
        $maskedEmail = isset($email)
            ? Str::mask($email, '•', 2, max(strlen($email) - 4, 0))
            : null;
    @endphp
    <div class="verify-shell">
        <h1>Verification</h1>
        <p class="subtitle">
            @if ($isPasswordReset)
                Enter the verification code we emailed to {{ $maskedEmail ?? 'your address' }} and choose your new password.
            @else
                Enter the verification code we just sent to {{ $maskedEmail ?? 'your address' }} to finish signing in.
            @endif
        </p>

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

        <form action="{{ route('auth.verify.submit') }}" method="POST">
            @csrf
            <input type="hidden" name="purpose" value="{{ $purpose }}">
            <div>
                <label for="code">Verification code</label>
                <input type="text" id="code" name="code" placeholder="6-digit code" required inputmode="numeric" pattern="\d*" maxlength="6" value="{{ old('code') }}">
            </div>
            @if ($isPasswordReset)
            <div>
                <label for="password">New password</label>
                <input type="password" id="password" name="password" placeholder="Create a new password">
                <p class="form-hint">Use at least 8 characters.</p>
            </div>
            <div>
                <label for="password_confirmation">Confirm password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Repeat the new password">
            </div>
            @endif
            <button type="submit">Continue</button>
        </form>

        <a href="{{ route('login') }}" class="back-link">Back to login</a>
    </div>
</body>
</html>
