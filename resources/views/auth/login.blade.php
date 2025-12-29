<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-sm text-red-300" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-6">
            <h2 class="font-serif text-2xl font-bold text-white mb-2">Welcome Back</h2>
            <p class="text-sm text-white/80 mb-6">Sign in to access the library management dashboard</p>
        </div>

        <!-- Email Address -->
        <div class="mb-6">
            <label for="email" class="block text-sm font-medium text-white mb-2">
                Email Address
            </label>
            <input
                id="email"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
                autocomplete="username"
                class="glass-input w-full px-4 py-3 rounded-sm placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-white/30 text-sm transition-all"
                placeholder="librarian@example.com"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-300" />
        </div>

        <!-- Password -->
        <div class="mb-6">
            <div class="flex items-center justify-between mb-2">
                <label for="password" class="block text-sm font-medium text-white">
                    Password
                </label>
                @if (Route::has('password.request'))
                    <a class="text-sm text-white hover:text-white/80 transition-colors underline" href="{{ route('password.request') }}">
                        Forgot password?
                    </a>
                @endif
            </div>
            <input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                class="glass-input w-full px-4 py-3 rounded-sm placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-white/30 text-sm transition-all"
                placeholder="••••••••"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-300" />
        </div>

        <!-- Remember Me -->
        <div class="mb-6">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input
                    id="remember_me"
                    type="checkbox"
                    name="remember"
                    class="rounded border-white/30 bg-white/10 text-blue-400 focus:ring-blue-400/50 transition-all"
                />
                <span class="ms-2 text-sm text-white/80">Remember me on this device</span>
            </label>
        </div>

        <!-- Submit Button -->
        <div class="mb-6">
            <button type="submit" class="w-full bg-white hover:bg-white/90 text-blue-600 font-medium py-3 px-4 rounded-sm text-sm leading-normal transition-colors focus:outline-none focus:ring-2 focus:ring-white/50 focus:ring-offset-2 focus:ring-offset-transparent">
                Sign In to Dashboard
            </button>
        </div>

        <!-- Divider -->
        <div class="relative mb-6">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-white/30"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-2 bg-transparent text-white/60">
                    New to the library?
                </span>
            </div>
        </div>

        <!-- Register Link -->
        @if (Route::has('register'))
            <div class="text-center">
                <a href="{{ route('register') }}" class="inline-block w-full bg-white/10 hover:bg-white/20 text-white font-medium py-3 px-4 rounded-sm text-sm leading-normal transition-colors focus:outline-none focus:ring-2 focus:ring-white/30 focus:ring-offset-2 focus:ring-offset-transparent border border-white/20">
                    Create New Library Account
                </a>
            </div>
        @endif

        <!-- Stats -->
        <div class="mt-8 pt-6 border-t border-white/30">
            <div class="grid grid-cols-3 gap-4 text-center">
                <div>
                    <div class="text-lg font-bold text-white">50K+</div>
                    <div class="text-xs text-white/80">Books</div>
                </div>
                <div>
                    <div class="text-lg font-bold text-white">5K+</div>
                    <div class="text-xs text-white/80">Members</div>
                </div>
                <div>
                    <div class="text-lg font-bold text-white">99%</div>
                    <div class="text-xs text-white/80">Uptime</div>
                </div>
            </div>
        </div>
    </form>
</x-guest-layout>