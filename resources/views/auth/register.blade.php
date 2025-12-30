<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <div class="mb-8">
            <h2 class="font-serif text-3xl font-bold text-white mb-3">Join Our Library</h2>
            <p class="text-gray-300">Create an account to access books, make reservations, and manage your loans</p>
        </div>

        <!-- Name -->
        <div class="space-y-2">
            <label for="name" class="block text-sm font-medium text-gray-300">
                Full Name
            </label>
            <input
                id="name"
                type="text"
                name="name"
                :value="old('name')"
                required
                autofocus
                autocomplete="name"
                class="glass-input w-full px-4 py-3 rounded-lg placeholder-gray-500 focus:outline-none text-base"
                placeholder="John Smith"
            />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-300" />
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
                autocomplete="email"
                class="glass-input w-full px-4 py-3 rounded-lg placeholder-gray-500 focus:outline-none text-base"
                placeholder="john@example.com"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-300" />
        </div>

        <!-- Password -->
        <div class="space-y-2">
            <label for="password" class="block text-sm font-medium text-gray-300">
                Password
            </label>
            <input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="new-password"
                class="glass-input w-full px-4 py-3 rounded-lg placeholder-gray-500 focus:outline-none text-base"
                placeholder="••••••••"
            />
            <div class="mt-2 text-xs text-gray-400">
                Use at least 8 characters with a mix of letters, numbers & symbols
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-300" />
        </div>

        <!-- Confirm Password -->
        <div class="space-y-2">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-300">
                Confirm Password
            </label>
            <input
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
                class="glass-input w-full px-4 py-3 rounded-lg placeholder-gray-500 focus:outline-none text-base"
                placeholder="••••••••"
            />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-300" />
        </div>

        <!-- Library Card Information (Optional) -->
        <div class="p-6 bg-gray-800/50 backdrop-blur-sm rounded-lg border border-gray-700 space-y-4">
            <h3 class="text-sm font-medium text-white mb-3">Library Card Preferences</h3>
            <div class="space-y-3">
                <div class="flex items-center">
                    <input
                        id="receive_newsletter"
                        type="checkbox"
                        name="receive_newsletter"
                        class="rounded border-gray-600 bg-gray-700 text-blue-500 focus:ring-blue-500/50"
                    />
                    <label for="receive_newsletter" class="ml-3 text-sm text-gray-300">
                        Receive monthly newsletter about new arrivals
                    </label>
                </div>
                <div class="flex items-center">
                    <input
                        id="email_notifications"
                        type="checkbox"
                        name="email_notifications"
                        class="rounded border-gray-600 bg-gray-700 text-blue-500 focus:ring-blue-500/50"
                        checked
                    />
                    <label for="email_notifications" class="ml-3 text-sm text-gray-300">
                        Receive email notifications for due dates
                    </label>
                </div>
            </div>
        </div>

        <!-- Terms & Conditions -->
        <div class="space-y-2">
            <div class="flex items-start">
                <input
                    id="terms"
                    type="checkbox"
                    name="terms"
                    required
                    class="mt-1 rounded border-gray-600 bg-gray-700 text-blue-500 focus:ring-blue-500/50"
                />
                <label for="terms" class="ml-3 text-sm text-gray-300">
                    I agree to the <a href="/terms" class="text-blue-300 hover:text-blue-200 underline">Terms of Service</a> 
                    and <a href="/privacy" class="text-blue-300 hover:text-blue-200 underline">Privacy Policy</a>
                </label>
            </div>
            <x-input-error :messages="$errors->get('terms')" class="mt-2 text-sm text-red-300" />
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn-primary w-full py-3 text-base font-semibold">
            Create Library Account
        </button>

        <!-- Divider -->
        <div class="relative my-8">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-700"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-4 bg-transparent text-gray-500">
                    Already have an account?
                </span>
            </div>
        </div>

        <!-- Login Link -->
        <a href="{{ route('login') }}" class="btn-secondary w-full py-3 text-base font-semibold text-center block">
            Sign In to Existing Account
        </a>

        <!-- Membership Benefits -->
        <div class="mt-8 pt-6 border-t border-gray-700">
            <h4 class="text-sm font-medium text-white mb-4">Membership Benefits</h4>
            <div class="grid grid-cols-2 gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-blue-500/20 flex items-center justify-center">
                        <svg class="w-4 h-4 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <span class="text-sm text-gray-300">50+ Book Loans</span>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-green-500/20 flex items-center justify-center">
                        <svg class="w-4 h-4 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span class="text-sm text-gray-300">24/7 Digital Access</span>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-purple-500/20 flex items-center justify-center">
                        <svg class="w-4 h-4 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span class="text-sm text-gray-300">Online Reservations</span>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-amber-500/20 flex items-center justify-center">
                        <svg class="w-4 h-4 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <span class="text-sm text-gray-300">Fast Checkout</span>
                </div>
            </div>
        </div>
    </form>
</x-guest-layout>