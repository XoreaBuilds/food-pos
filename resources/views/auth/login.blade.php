<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Gather & Ground — Login</title>

    <!-- Tailwind CSS (via Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js for Password Toggle (Optional) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="font-sans antialiased text-[#2D3B2D] min-h-screen bg-[#F7F4EB] flex">

    <div class="flex flex-col lg:flex-row w-full min-h-screen">

        <!-- LEFT SIDE: Branding & Hero Section -->
        <aside class="lg:w-1/2 bg-[#D5DCBF] p-8 lg:p-16 flex flex-col justify-between relative overflow-hidden">

            <!-- Top Logo -->
            <div class="flex items-center gap-2.5 z-10">
                <svg class="w-6 h-6 text-[#1A381E]" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17 8C8 10 59 16.17 3.83 12 2 12 2 8 2 8 2s4-2 10-2 10 2 10 2-2 6-5 8z" />
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14.5v-9l6 4.5-6 4.5z"
                        opacity="0.3" />
                </svg>
                <span class="font-bold text-xl tracking-tight text-[#1A381E]">Gather & Ground</span>
            </div>

            <!-- Hero Illustration -->
            <div class="my-auto py-12 flex justify-center items-center z-10">
                <div class="w-72 h-72 md:w-96 md:h-96 relative flex items-center justify-center">
                    <!-- Food Bowl Illustration Placeholder -->
                    <svg class="w-full h-full" viewBox="0 0 300 300" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <!-- Bowl Shadow/Base -->
                        <path d="M70 200 C70 250, 230 250, 230 200 Z" fill="#1A381E" opacity="0.1" />
                        <path d="M60 150 C60 220, 240 220, 240 150 Z" stroke="#1A381E" stroke-width="4"
                            fill="#FAF8F2" />
                        <!-- Leaves / Fruit Content -->
                        <circle cx="150" cy="120" r="30" fill="#E89B27" stroke="#1A381E" stroke-width="3" />
                        <circle cx="115" cy="130" r="18" fill="#E89B27" stroke="#1A381E" stroke-width="3" />
                        <circle cx="185" cy="130" r="18" fill="#E89B27" stroke="#1A381E" stroke-width="3" />
                        <!-- Green Leaves -->
                        <path d="M130 80 Q150 40 160 80 Q150 120 130 80 Z" fill="#2E5033" stroke="#1A381E"
                            stroke-width="3" />
                        <path d="M160 80 Q180 50 200 85 Q170 110 160 80 Z" fill="#2E5033" stroke="#1A381E"
                            stroke-width="3" />
                        <path d="M100 85 Q120 50 140 80 Q120 110 100 85 Z" fill="#2E5033" stroke="#1A381E"
                            stroke-width="3" />
                    </svg>
                </div>
            </div>

            <!-- Hero Typography -->
            <div class="max-w-md space-y-3 z-10">
                <span class="text-xs font-bold tracking-widest text-[#C85A32] uppercase">
                    Good Food. Better Company.
                </span>
                <h1 class="text-4xl md:text-5xl font-extrabold text-[#1A381E] leading-none tracking-tight">
                    Your place at the table is waiting.
                </h1>
                <p class="text-sm text-[#4A5D4A] leading-relaxed pt-2">
                    Sign in to save favorites, plan your next gathering, and keep every shared meal in one place.
                </p>
            </div>

        </aside>

        <!-- RIGHT SIDE: Login Card Section -->
        <main class="lg:w-1/2 bg-[#FAF8F2] p-6 md:p-12 lg:p-16 flex flex-col justify-between items-center">

            <div class="w-full max-w-md my-auto pt-8">

                <!-- Main Card Container -->
                <div
                    class="bg-[#FAF8F2] border border-[#DCD6C5] rounded-3xl p-8 md:p-10 shadow-[6px_6px_0px_0px_#E3DDCB] space-y-6">

                    <!-- Header -->
                    <div class="space-y-2">
                        <span class="text-xs font-bold tracking-widest text-[#C85A32] uppercase">
                            Welcome Back
                        </span>
                        <h2 class="text-3xl md:text-4xl font-extrabold text-[#1A381E] tracking-tight">
                            Come on in.
                        </h2>
                        <p class="text-xs text-[#6B7A6B]">
                            Use your details to continue to your account.
                        </p>
                    </div>

                    <!-- Laravel Auth Form -->
                    <form method="POST" action="{{ route('login') }}" class="space-y-5"
                        x-data="{ showPassword: false }">
                        @csrf

                        <!-- Email Field -->
                        <div class="space-y-1.5">
                            <label for="email" class="block text-xs font-bold text-[#1A381E]">
                                Email address
                            </label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                                class="w-full bg-[#FAF8F2] border border-[#C8C2B0] focus:border-[#1A381E] focus:ring-1 focus:ring-[#1A381E] rounded-xl px-4 py-3 text-sm text-[#1A381E] placeholder-[#A0A8A0] transition outline-none"
                                placeholder="you@example.com">
                            @error('email')
                                <p class="text-xs text-rose-600 font-medium pt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div class="space-y-1.5">
                            <div class="flex items-center justify-between">
                                <label for="password" class="block text-xs font-bold text-[#1A381E]">
                                    Password
                                </label>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}"
                                        class="text-xs font-bold text-[#C85A32] hover:underline">
                                        Forgot password?
                                    </a>
                                @endif
                            </div>

                            <div class="relative">
                                <input id="password" :type="showPassword ? 'text' : 'password'" name="password" required
                                    class="w-full bg-[#FAF8F2] border border-[#C8C2B0] focus:border-[#1A381E] focus:ring-1 focus:ring-[#1A381E] rounded-xl px-4 py-3 text-sm text-[#1A381E] placeholder-[#A0A8A0] transition outline-none pr-10"
                                    placeholder="Enter your password">

                                <!-- Eye Toggle Icon -->
                                <button type="button" @click="showPassword = !showPassword"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-[#7A887A] hover:text-[#1A381E]">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                            @error('password')
                                <p class="text-xs text-rose-600 font-medium pt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Checkbox -->
                        <div class="flex items-center gap-2 pt-1">
                            <input id="remember_me" type="checkbox" name="remember"
                                class="w-4 h-4 rounded border-[#C8C2B0] text-[#1A381E] focus:ring-0 bg-[#FAF8F2] cursor-pointer">
                            <label for="remember_me" class="text-xs text-[#5A685A] font-medium cursor-pointer">
                                Keep me signed in
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full bg-[#1A381E] hover:bg-[#122715] text-[#FAF8F2] font-bold py-3.5 px-4 rounded-xl shadow transition duration-150 text-sm">
                            Sign in
                        </button>
                    </form>

                    <!-- Divider -->
                    <div class="relative flex items-center justify-center pt-2">
                        <div class="border-t border-[#DCD6C5] w-full"></div>
                        <span
                            class="bg-[#FAF8F2] px-3 text-[10px] font-bold tracking-wider text-[#A0A8A0] uppercase absolute">
                            New to the table?
                        </span>
                    </div>

                    <!-- Create Account Link -->
                    @if (Route::has('register'))
                        <div>
                            <a href="{{ route('register') }}"
                                class="w-full flex justify-center items-center bg-[#FAF8F2] border border-[#C8C2B0] hover:bg-[#F2EDDF] text-[#1A381E] font-bold py-3 px-4 rounded-xl transition text-sm">
                                Create an account
                            </a>
                        </div>
                    @endif

                </div>

                <!-- Footer Terms Link -->
                <p class="text-[11px] text-[#7A887A] text-center mt-6">
                    By continuing, you agree to our
                    <a href="#" class="underline hover:text-[#1A381E]">Terms</a> and
                    <a href="#" class="underline hover:text-[#1A381E]">Privacy Policy</a>.
                </p>

            </div>

        </main>

    </div>

</body>

</html>