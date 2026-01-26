<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Received</title>
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
            background: radial-gradient(circle at top left, #111827, #020617 60%, #000000 95%);
            color: #f8fafc;
        }

        .shell {
            position: relative;
            width: min(100%, 500px);
            background: linear-gradient(165deg, rgba(15, 23, 42, 0.98), rgba(12, 20, 33, 0.92));
            border-radius: 26px;
            padding: 3.2rem 3rem;
            box-shadow:
                0 36px 90px rgba(15, 23, 42, 0.65),
                0 20px 42px rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(16, 185, 129, 0.24);
            overflow: hidden;
            text-align: center;
        }

        .shell::before,
        .shell::after {
            content: "";
            position: absolute;
            border-radius: 50%;
            filter: blur(90px);
            opacity: 0.28;
        }

        .shell::before {
            width: 220px;
            height: 220px;
            background: rgba(16, 185, 129, 0.5);
            top: -110px;
            right: -90px;
        }

        .shell::after {
            width: 230px;
            height: 230px;
            background: rgba(99, 102, 241, 0.45);
            bottom: -110px;
            left: -80px;
        }

        h1 {
            font-size: 2.1rem;
            font-weight: 700;
            color: #f1f5f9;
            letter-spacing: -0.02em;
        }

        p.lead {
            margin-top: 1rem;
            font-size: 1rem;
            color: rgba(226, 232, 240, 0.75);
            line-height: 1.7;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin: 1.8rem auto 0;
            padding: 0.65rem 1.3rem;
            border-radius: 999px;
            font-size: 0.85rem;
            font-weight: 600;
            background: rgba(16, 185, 129, 0.18);
            border: 1px solid rgba(16, 185, 129, 0.35);
            color: #bbf7d0;
        }

        .cta {
            margin-top: 2.4rem;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            font-size: 0.88rem;
            color: rgba(203, 213, 225, 0.78);
        }

        .cta a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.35rem;
            padding: 0.75rem 1.2rem;
            border-radius: 999px;
            text-decoration: none;
            font-weight: 600;
            color: rgba(165, 180, 252, 0.92);
            background: rgba(79, 70, 229, 0.14);
            border: 1px solid rgba(79, 70, 229, 0.32);
            transition: transform 0.18s ease, box-shadow 0.18s ease, opacity 0.18s ease;
        }

        .cta a:hover {
            transform: translateY(-1px);
            box-shadow:
                0 16px 30px rgba(79, 70, 229, 0.28),
                0 12px 24px rgba(30, 64, 175, 0.18);
            opacity: 0.95;
        }

        .cta small {
            display: block;
            color: rgba(148, 163, 184, 0.75);
        }

        @media (max-width: 560px) {
            body {
                padding: 1.5rem;
            }

            .shell {
                padding: 2.6rem 2.2rem;
                border-radius: 22px;
            }
        }
    </style>
</head>
<body>
    <section class="shell" aria-labelledby="heading">
        <header>
            <h1 id="heading">We’re reviewing your profile</h1>
            <p class="lead">
                Thanks for verifying your email{{ $email ? ' (' . $email . ')' : '' }}. Our partnerships team reviews every agent request to keep the network trusted and high-impact.
            </p>
            <span class="badge">Status · Pending approval</span>
            @if (session('success'))
                <p class="mt-4 text-sm text-emerald-200">{{ session('success') }}</p>
            @endif
        </header>

        <div class="cta">
            <p>We’ll email you as soon as your account is activated. While you wait you can:</p>
            <a href="{{ route('login') }}">Return to sign in</a>
            <small>Trying to log in already? You’ll get access as soon as an administrator marks your account as active.</small>
        </div>
    </section>
</body>
</html>
