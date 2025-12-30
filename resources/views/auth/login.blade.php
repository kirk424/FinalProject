<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-6 p-4 bg-green-500/10 border border-green-500/20 rounded-lg text-green-300" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <div class="mb-8">
            <h2 class="font-serif text-3xl font-bold text-white mb-3">Welcome Back</h2>
            <p class="text-gray-300">Sign in to access the library management dashboard</p>
        </div>

        <!-- Email Address -->
        <div class="space-y-2">
            <label for="email" class="block text-sm font-medium text-gray-300">
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
                class="glass-input w-full px-4 py-3 rounded-lg placeholder-gray-500 focus:outline-none text-base"
                placeholder="librarian@example.com"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-300" />
        </div>

        <!-- Password -->
        <div class="space-y-2">
            <div class="flex items-center justify-between">
                <label for="password" class="block text-sm font-medium text-gray-300">
                    Password
                </label>
                @if (Route::has('password.request'))
                    <a class="text-sm text-blue-300 hover:text-blue-200 transition-colors" href="{{ route('password.request') }}">
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
                class="glass-input w-full px-4 py-3 rounded-lg placeholder-gray-500 focus:outline-none text-base"
                placeholder="••••••••"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-300" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input
                id="remember_me"
                type="checkbox"
                name="remember"
                class="rounded border-gray-600 bg-gray-700 text-blue-500 focus:ring-blue-500/50 transition-all"
            />
            <label for="remember_me" class="ml-3 text-sm text-gray-300">
                Remember me on this device
            </label>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn-primary w-full py-3 text-base font-semibold">
            Sign In to Dashboard
        </button>

        <!-- Divider -->
        <div class="relative my-8">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-700"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-4 bg-transparent text-gray-500">
                    New to the library?
                </span>
            </div>
        </div>

        <!-- Register Link -->
        @if (Route::has('register'))
            <a href="{{ route('register') }}" class="btn-secondary w-full py-3 text-base font-semibold text-center block">
                Create New Library Account
            </a>
        @endif
    </form>
</x-guest-layout>