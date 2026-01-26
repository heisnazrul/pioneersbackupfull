<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Password</title>
    <style>
        :root { color-scheme: dark; }
        * { box-sizing: border-box; margin: 0; padding: 0; }
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
        .shell {
            width: min(100%, 440px);
            background: linear-gradient(155deg, rgba(15, 23, 42, 0.96), rgba(12, 12, 20, 0.95));
            border-radius: 24px;
            padding: 3rem 2.6rem;
            box-shadow:
                0 32px 80px rgba(15, 23, 42, 0.65),
                0 18px 40px rgba(0, 0, 0, 0.48);
            border: 1px solid rgba(56, 189, 248, 0.24);
        }
        h1 { font-size: 2rem; font-weight: 700; color: #f8fafc; }
        p { margin-top: 0.75rem; color: rgba(148, 163, 184, 0.9); line-height: 1.6; }
        form { margin-top: 2rem; display: grid; gap: 1.35rem; }
        label { font-size: 0.84rem; font-weight: 600; color: rgba(226, 232, 240, 0.95); }
        input[type="email"], input[type="password"] {
            width: 100%;
            border: 1px solid rgba(148, 163, 184, 0.35);
            border-radius: 14px;
            padding: 0.9rem 1rem;
            font-size: 0.95rem;
            color: #f8fafc;
            background: rgba(15, 23, 42, 0.7);
        }
        input:focus {
            outline: none;
            border-color: rgba(56, 189, 248, 0.82);
            background: rgba(30, 41, 59, 0.94);
            box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.25);
        }
        .alert {
            padding: 0.85rem 1rem;
            border-radius: 12px;
            font-size: 0.9rem;
        }
        .alert-errors {
            border: 1px solid rgba(248, 113, 113, 0.4);
            background: rgba(248, 113, 113, 0.12);
            color: #fecaca;
        }
        button {
            border: none;
            border-radius: 16px;
            padding: 1rem;
            font-size: 1rem;
            font-weight: 600;
            color: #e2e8f0;
            background: linear-gradient(135deg, #38bdf8, #6366f1);
            cursor: pointer;
        }
        button:hover { filter: brightness(1.05); }
        @media (max-width: 540px) {
            body { padding: 1.5rem; }
            .shell { padding: 2.5rem 2rem; }
        }
    </style>
</head>
<body>
    <section class="shell" aria-labelledby="reset-heading">
        <header>
            <h1 id="reset-heading">Set your password</h1>
            <p>Choose a secure password to activate your account.</p>
        </header>

        @if ($errors->any())
            <div class="alert alert-errors" role="alert">
                <ul style="list-style: disc; padding-left: 1.2rem; display: grid; gap: 0.35rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div>
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email', $email) }}" required autocomplete="email">
            </div>

            <div>
                <label for="password">New password</label>
                <input id="password" type="password" name="password" required autocomplete="new-password" minlength="8">
            </div>

            <div>
                <label for="password_confirmation">Confirm password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" minlength="8">
            </div>

            <button type="submit">Save password</button>
        </form>
    </section>
</body>
</html>
