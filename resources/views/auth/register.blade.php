<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-6">
            <h2 class="font-serif text-2xl font-bold text-white mb-2">Join Our Library</h2>
            <p class="text-sm text-white/80 mb-6">Create an account to access books, make reservations, and manage your loans</p>
        </div>

        <!-- Name -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-white mb-2">
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
                class="glass-input w-full px-4 py-3 rounded-sm placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-white/30 text-sm transition-all"
                placeholder="John Smith"
            />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-300" />
        </div>

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-white mb-2">
                Email Address
            </label>
            <input
                id="email"
                type="email"
                name="email"
                :value="old('email')"
                required
                autocomplete="email"
                class="glass-input w-full px-4 py-3 rounded-sm placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-white/30 text-sm transition-all"
                placeholder="john@example.com"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-300" />
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-white mb-2">
                Password
            </label>
            <input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="new-password"
                class="glass-input w-full px-4 py-3 rounded-sm placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-white/30 text-sm transition-all"
                placeholder="••••••••"
            />
            <div class="mt-2 text-xs text-white/60">
                Use at least 8 characters with a mix of letters, numbers & symbols
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-300" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-6">
            <label for="password_confirmation" class="block text-sm font-medium text-white mb-2">
                Confirm Password
            </label>
            <input
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
                class="glass-input w-full px-4 py-3 rounded-sm placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-white/30 text-sm transition-all"
                placeholder="••••••••"
            />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-300" />
        </div>

        <!-- Library Card Information (Optional) -->
        <div class="mb-6 p-4 bg-white/10 backdrop-blur-sm rounded-sm border border-white/20">
            <h3 class="text-sm font-medium text-white mb-3">Library Card Preferences</h3>
            <div class="space-y-3">
                <div class="flex items-center">
                    <input
                        id="receive_newsletter"
                        type="checkbox"
                        name="receive_newsletter"
                        class="rounded border-white/30 bg-white/10 text-blue-400 focus:ring-blue-400/50"
                    />
                    <label for="receive_newsletter" class="ml-2 text-sm text-white/80">
                        Receive monthly newsletter about new arrivals
                    </label>
                </div>
                <div class="flex items-center">
                    <input
                        id="email_notifications"
                        type="checkbox"
                        name="email_notifications"
                        class="rounded border-white/30 bg-white/10 text-blue-400 focus:ring-blue-400/50"
                        checked
                    />
                    <label for="email_notifications" class="ml-2 text-sm text-white/80">
                        Receive email notifications for due dates
                    </label>
                </div>
            </div>
        </div>

        <!-- Terms & Conditions -->
        <div class="mb-6">
            <div class="flex items-start">
                <input
                    id="terms"
                    type="checkbox"
                    name="terms"
                    required
                    class="mt-1 rounded border-white/30 bg-white/10 text-blue-400 focus:ring-blue-400/50"
                />
                <label for="terms" class="ml-2 text-sm text-white/80">
                    I agree to the <a href="/terms" class="text-white hover:text-white/80 underline">Terms of Service</a> 
                    and <a href="/privacy" class="text-white hover:text-white/80 underline">Privacy Policy</a>
                </label>
            </div>
            <x-input-error :messages="$errors->get('terms')" class="mt-2 text-sm text-red-300" />
        </div>

        <!-- Submit Button -->
        <div class="mb-6">
            <button type="submit" class="w-full bg-white hover:bg-white/90 text-blue-600 font-medium py-3 px-4 rounded-sm text-sm leading-normal transition-colors focus:outline-none focus:ring-2 focus:ring-white/50 focus:ring-offset-2 focus:ring-offset-transparent">
                Create Library Account
            </button>
        </div>

        <!-- Divider -->
        <div class="relative mb-6">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-white/30"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-2 bg-transparent text-white/60">
                    Already have an account?
                </span>
            </div>
        </div>

        <!-- Login Link -->
        <div class="text-center">
            <a href="{{ route('login') }}" class="inline-block w-full bg-white/10 hover:bg-white/20 text-white font-medium py-3 px-4 rounded-sm text-sm leading-normal transition-colors focus:outline-none focus:ring-2 focus:ring-white/30 focus:ring-offset-2 focus:ring-offset-transparent border border-white/20">
                Sign In to Existing Account
            </a>
        </div>

        <!-- Membership Benefits -->
        <div class="mt-8 pt-6 border-t border-white/30">
            <h4 class="text-sm font-medium text-white mb-4">Membership Benefits</h4>
            <div class="grid grid-cols-2 gap-4">
                <div class="flex items-center gap-2">
                    <div class="w-6 h-6 rounded-full bg-white/20 flex items-center justify-center">
                        <svg class="w-3 h-3 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <span class="text-xs text-white/80">50+ Book Loans</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-6 h-6 rounded-full bg-white/20 flex items-center justify-center">
                        <svg class="w-3 h-3 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span class="text-xs text-white/80">24/7 Digital Access</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-6 h-6 rounded-full bg-white/20 flex items-center justify-center">
                        <svg class="w-3 h-3 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span class="text-xs text-white/80">Online Reservations</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-6 h-6 rounded-full bg-white/20 flex items-center justify-center">
                        <svg class="w-3 h-3 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <span class="text-xs text-white/80">Fast Checkout</span>
                </div>
            </div>
        </div>
    </form>
</x-guest-layout>