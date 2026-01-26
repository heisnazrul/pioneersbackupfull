<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Become An Agent</title>
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
            background: radial-gradient(circle at top left, #0f172a, #020617 55%, #000000 90%);
            color: #f8fafc;
        }

        .shell {
            position: relative;
            width: min(100%, 480px);
            background: linear-gradient(155deg, rgba(15, 23, 42, 0.98), rgba(14, 14, 26, 0.92));
            border-radius: 24px;
            padding: 3rem 2.85rem;
            box-shadow:
                0 30px 70px rgba(15, 23, 42, 0.65),
                0 18px 35px rgba(0, 0, 0, 0.45);
            border: 1px solid rgba(59, 130, 246, 0.2);
            overflow: hidden;
        }

        .shell::before,
        .shell::after {
            content: "";
            position: absolute;
            border-radius: 50%;
            filter: blur(70px);
            opacity: 0.28;
        }

        .shell::before {
            width: 180px;
            height: 180px;
            background: rgba(99, 102, 241, 0.55);
            top: -80px;
            right: -70px;
        }

        .shell::after {
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
            font-size: 0.97rem;
            color: rgba(148, 163, 184, 0.9);
            line-height: 1.6;
        }

        .alert {
            margin-top: 1.6rem;
            padding: 0.9rem 1rem;
            border-radius: 12px;
            font-size: 0.9rem;
            border: 1px solid rgba(248, 113, 113, 0.4);
            background: rgba(248, 113, 113, 0.12);
            color: #fecaca;
        }

        form {
            margin-top: 2.4rem;
            display: grid;
            gap: 1.35rem;
        }

        .field {
            display: flex;
            flex-direction: column;
        }

        label {
            font-size: 0.83rem;
            font-weight: 600;
            color: rgba(226, 232, 240, 0.94);
            margin-bottom: 0.45rem;
            letter-spacing: 0.01em;
        }

        label span {
            font-weight: 500;
            color: rgba(148, 163, 184, 0.7);
            margin-left: 0.3rem;
            font-size: 0.75rem;
        }

        input[type="text"],
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

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: rgba(59, 130, 246, 0.8);
            background: rgba(30, 41, 59, 0.94);
            box-shadow:
                0 0 0 3px rgba(59, 130, 246, 0.25),
                0 12px 24px rgba(15, 23, 42, 0.45);
            transform: translateY(-1px);
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
            background: linear-gradient(135deg, #3b82f6, #6366f1);
            box-shadow:
                0 22px 50px rgba(59, 130, 246, 0.45),
                0 12px 28px rgba(99, 102, 241, 0.35);
            cursor: pointer;
            transition: transform 0.18s ease, box-shadow 0.18s ease, filter 0.18s ease;
        }

        button[type="submit"]:hover {
            transform: translateY(-2px);
            box-shadow:
                0 26px 58px rgba(59, 130, 246, 0.5),
                0 16px 35px rgba(99, 102, 241, 0.4);
        }

        button[type="submit"]:active {
            transform: translateY(0);
            filter: brightness(0.96);
        }

        .footer {
            margin-top: 1.6rem;
            text-align: center;
            font-size: 0.86rem;
            color: rgba(148, 163, 184, 0.85);
        }

        .footer a {
            color: rgba(165, 180, 252, 0.92);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s ease, opacity 0.2s ease;
        }

        .footer a:hover {
            color: rgba(209, 213, 252, 1);
            opacity: 0.92;
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
            <h1 id="heading">Join the Pioneers Agent Network</h1>
            <p class="subtitle">
                Create your agent account to access campaigns, resources, and dedicated support. We’ll verify your email and review your profile before activating access.
            </p>
        </header>

        @if ($errors->any())
            <div class="alert" role="alert">
                <ul style="list-style: disc; padding-left: 1.2rem; display: grid; gap: 0.35rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('agent.register.submit') }}" method="POST" novalidate>
            @csrf
            <div class="field">
                <label for="name">Full name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required autocomplete="name">
            </div>
            <div class="field">
                <label for="email">Work email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email">
            </div>
            <div class="field">
                <label for="phone">Phone <span>(optional)</span></label>
                <input type="text" id="phone" name="phone" value="{{ old('phone') }}" autocomplete="tel">
            </div>
            <div class="field">
                <label for="country">Country <span>(optional)</span></label>
                <input type="text" id="country" name="country" value="{{ old('country') }}" autocomplete="country-name">
            </div>
            <div class="field">
                <label for="password">Create password</label>
                <input type="password" id="password" name="password" required autocomplete="new-password">
            </div>
            <div class="field">
                <label for="password_confirmation">Confirm password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password">
            </div>
            <button type="submit">Create agent account</button>
        </form>

        <p class="footer">
            Already approved? <a href="{{ route('login') }}">Sign in here</a>
        </p>
    </section>
</body>
</html>
