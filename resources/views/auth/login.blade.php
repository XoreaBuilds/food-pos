<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Food POS') }} - Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#F7F4EB] font-sans text-[#2D3B2D]">
    <main class="flex min-h-screen flex-col lg:flex-row">
        <section class="flex flex-col justify-between bg-[#D5DCBF] p-8 lg:w-1/2 lg:p-16">
            <a href="{{ route('home') }}" class="text-xl font-bold tracking-tight text-[#1A381E]">Gather &amp; Ground</a>
            <div class="my-12 max-w-lg">
                <p class="text-xs font-bold uppercase tracking-widest text-[#C85A32]">Good Food. Better Company.</p>
                <h1 class="mt-3 text-4xl font-extrabold leading-tight tracking-tight text-[#1A381E] md:text-5xl">Your place at the table is waiting.</h1>
                <p class="mt-4 text-sm leading-relaxed text-[#4A5D4A]">Sign in to continue to your account.</p>
            </div>
            <p class="text-xs text-[#4A5D4A]">Gather &amp; Ground</p>
        </section>

        <section class="flex items-center justify-center bg-[#FAF8F2] p-6 md:p-12 lg:w-1/2 lg:p-16">
            <div class="w-full max-w-md rounded-3xl border border-[#DCD6C5] p-8 shadow-[6px_6px_0px_0px_#E3DDCB] md:p-10">
                <p class="text-xs font-bold uppercase tracking-widest text-[#C85A32]">Welcome Back</p>
                <h2 class="mt-2 text-3xl font-extrabold tracking-tight text-[#1A381E]">Come on in.</h2>
                <p class="mt-2 text-sm text-[#6B7A6B]">Use your details to continue to your account.</p>

                @if (session('status'))
                    <p class="mt-5 rounded-lg bg-green-50 p-3 text-sm text-green-700">{{ session('status') }}</p>
                @endif

                <form method="POST" action="{{ route('login.store') }}" class="mt-7 space-y-5">
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-bold text-[#1A381E]">Email address</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                            class="mt-1 w-full rounded-xl border border-[#C8C2B0] bg-transparent px-4 py-3 text-sm outline-none focus:border-[#1A381E] focus:ring-1 focus:ring-[#1A381E]">
                        @error('email') <p class="mt-1 text-xs font-medium text-rose-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <div class="flex items-center justify-between">
                            <label for="password" class="block text-sm font-bold text-[#1A381E]">Password</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-xs font-bold text-[#C85A32] hover:underline">Forgot password?</a>
                            @endif
                        </div>
                        <input id="password" name="password" type="password" required autocomplete="current-password"
                            class="mt-1 w-full rounded-xl border border-[#C8C2B0] bg-transparent px-4 py-3 text-sm outline-none focus:border-[#1A381E] focus:ring-1 focus:ring-[#1A381E]">
                        @error('password') <p class="mt-1 text-xs font-medium text-rose-600">{{ $message }}</p> @enderror
                    </div>

                    <label for="remember" class="flex cursor-pointer items-center gap-2 text-sm text-[#5A685A]">
                        <input id="remember" name="remember" type="checkbox" value="1" @checked(old('remember')) class="h-4 w-4 rounded border-[#C8C2B0] text-[#1A381E] focus:ring-[#1A381E]">
                        Keep me signed in
                    </label>

                    <button type="submit" class="w-full rounded-xl bg-[#1A381E] px-4 py-3.5 text-sm font-bold text-[#FAF8F2] transition hover:bg-[#122715]">Sign in</button>
                </form>

                @if (Route::has('register'))
                    <div class="mt-6 border-t border-[#DCD6C5] pt-6 text-center">
                        <span class="text-sm text-[#6B7A6B]">New to the table?</span>
                        <a href="{{ route('register') }}" class="ml-1 text-sm font-bold text-[#C85A32] hover:underline">Create an account</a>
                    </div>
                @endif
            </div>
        </section>
    </main>
</body>
</html>
