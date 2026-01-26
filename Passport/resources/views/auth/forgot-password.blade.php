<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.4/dist/tailwind.min.css">
</head>
<body class="min-h-screen bg-slate-900 flex items-center justify-center px-4">
    <div class="w-full max-w-md rounded-3xl bg-white p-10 shadow-2xl">
        <h1 class="text-2xl font-bold text-slate-900">Forgot your password?</h1>
        <p class="mt-2 text-sm text-slate-500">Enter the email address associated with your account and we’ll send you a link to reset your password.</p>
        @if (session('status'))
            <div class="rounded-xl border border-emerald-100 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                {{ session('status') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-600 mt-4">
                {{ $errors->first() }}
            </div>
        @endif
        <form action="{{ route('password.email') }}" method="POST" class="mt-6 space-y-6">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-slate-700">Email address</label>
                <input type="email" id="email" name="email" class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/40" placeholder="you@example.com" required>
            </div>
            <button type="submit" class="inline-flex w-full items-center justify-center rounded-xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-600/30 transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/50">
                Send reset link
            </button>
        </form>
        <p class="mt-6 text-center text-sm text-slate-500">
            Remembered your password?
            <a href="{{ route('login') }}" class="font-semibold text-indigo-600 hover:text-indigo-500">Back to login</a>
        </p>
    </div>
</body>
</html>
