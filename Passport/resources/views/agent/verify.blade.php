<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Email</title>
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

        .shell {
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

        .shell::before,
        .shell::after {
            content: "";
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.32;
        }

        .shell::before {
            width: 200px;
            height: 200px;
            background: rgba(56, 189, 248, 0.55);
            top: -90px;
            right: -70px;
        }

        .shell::after {
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

        input[type="text"] {
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

        input[type="text"]:focus {
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

        .footer {
            margin-top: 1.4rem;
            font-size: 0.82rem;
            color: rgba(148, 163, 184, 0.78);
            text-align: center;
        }

        .footer a {
            color: rgba(165, 180, 252, 0.92);
            text-decoration: none;
            font-weight: 600;
        }

        @media (max-width: 540px) {
            body {
                padding: 1.5rem;
            }

            .shell {
                padding: 2.6rem 2.1rem;
                border-radius: 20px;
            }
        }
    </style>
</head>
<body>
    <section class="shell" aria-labelledby="heading">
        <header>
            <h1 id="heading">Verify your email</h1>
            <p class="subtitle">
                Enter the 6-digit code we sent to <strong>{{ $email ? \Illuminate\Support\Str::mask($email, '*', 2) : 'your email' }}</strong>.
                Once verified, we’ll review your agent request and notify you when it’s approved.
            </p>
        </header>

        @if (session('status'))
            <div class="status" role="status">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert" role="alert">
                <ul style="list-style: disc; padding-left: 1.2rem; display: grid; gap: 0.35rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('agent.verify.submit') }}" method="POST" novalidate>
            @csrf
            <div>
                <label for="code">Verification code</label>
                <input type="text" id="code" name="code" inputmode="numeric" pattern="[0-9]*" maxlength="6" required autofocus>
                <p class="form-hint">Codes expire after 15 minutes. Need a new one? <strong>Re-submit the sign-up form</strong> to resend.</p>
            </div>

            <button type="submit">Confirm email</button>
        </form>

        <p class="footer">
            Entered the wrong email? <a href="{{ route('agent.register') }}">Start over</a>
        </p>
    </section>
</body>
</html>
