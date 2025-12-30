<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-serif text-3xl font-bold gradient-text mb-2">Add New Borrower</h2>
                <p class="text-slate-400">Register a new library member</p>
            </div>
            <div class="text-sm text-slate-400 bg-slate-800/50 px-4 py-2 rounded-lg backdrop-blur-sm border border-slate-700/50">
                <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
                New Borrower Registration
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto">
            <!-- Form Container -->
            <div class="glass-panel p-8">
                <!-- Success/Error Messages -->
                @if(session('success'))
                    <div class="mb-6 p-4 rounded-lg bg-emerald-500/10 border border-emerald-500/20 text-emerald-300">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 01118 0z"/>
                            </svg>
                            <span>{{ session('success') }}</span>
                        </div>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 p-4 rounded-lg bg-red-500/10 border border-red-500/20 text-red-300">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div>
                                <p class="font-medium mb-1">Please fix the following errors:</p>
                                <ul class="text-sm list-disc list-inside space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <form action="{{ route('borrowers.store') }}" method="POST" class="space-y-8">
                    @csrf

                    <!-- Borrower Information Section -->
                    <div class="space-y-6">
                        <div class="border-b border-slate-700/50 pb-4">
                            <h3 class="text-xl font-semibold text-white mb-3 flex items-center gap-2">
                                <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Borrower Information
                            </h3>
                            <p class="text-slate-400 text-sm">Enter the personal details of the new borrower</p>
                        </div>

                        <!-- Name Field -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-slate-300">
                                Full Name *
                                <span class="text-xs text-slate-500 ml-2">Required</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <input type="text" 
                                       name="name" 
                                       value="{{ old('name') }}"
                                       required
                                       class="glass-input w-full pl-10 pr-4 py-3 rounded-lg focus:ring-2 focus:ring-purple-500/50 focus:border-transparent transition-all"
                                       placeholder="Enter borrower's full name"
                                       autofocus>
                            </div>
                            @error('name')
                                <p class="text-red-400 text-sm mt-1 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Email Field -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-slate-300">
                                Email Address *
                                <span class="text-xs text-slate-500 ml-2">Required, must be unique</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89-3.955a2 2 0 011.763 0L21 8m-5 11v-5a2 2 0 00-2-2h-4a2 2 0 00-2 2v5m12-13.664V19a2 2 0 01-2 2H5a2 2 0 01-2-2V5.336"/>
                                    </svg>
                                </div>
                                <input type="email" 
                                       name="email" 
                                       value="{{ old('email') }}"
                                       required
                                       class="glass-input w-full pl-10 pr-4 py-3 rounded-lg focus:ring-2 focus:ring-purple-500/50 focus:border-transparent transition-all"
                                       placeholder="borrower@example.com">
                            </div>
                            @error('email')
                                <p class="text-red-400 text-sm mt-1 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Phone Field -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-slate-300">
                                Phone Number *
                                <span class="text-xs text-slate-500 ml-2">Required for contact</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </div>
                                <input type="text" 
                                       name="phone" 
                                       value="{{ old('phone') }}"
                                       required
                                       class="glass-input w-full pl-10 pr-4 py-3 rounded-lg focus:ring-2 focus:ring-purple-500/50 focus:border-transparent transition-all"
                                       placeholder="+1 (555) 123-4567">
                            </div>
                            @error('phone')
                                <p class="text-red-400 text-sm mt-1 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="pt-6 border-t border-slate-700/50">
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                            <div class="text-sm text-slate-400">
                                <p class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Fields marked with * are required
                                </p>
                            </div>
                            
                            <div class="flex items-center gap-3">
                                <a href="{{ route('borrowers.index') }}" 
                                   class="px-6 py-3 rounded-lg border border-slate-600 text-slate-300 hover:bg-slate-700/50 hover:text-white transition-all duration-300 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                    </svg>
                                    Cancel
                                </a>
                                
                                <button type="submit" 
                                        class="btn-primary px-8 py-3 rounded-lg text-white font-medium transition-all duration-300 flex items-center gap-2 group">
                                    <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                    Create Borrower
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Help/Info Section -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="glass-panel p-6">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-full bg-purple-500/10 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-white mb-2">About Borrower Registration</h4>
                            <p class="text-sm text-slate-400">
                                Borrowers are registered members who can check out books from the library. 
                                Each borrower must have a unique email address.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="glass-panel p-6">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-full bg-blue-500/10 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-white mb-2">Data Privacy</h4>
                            <p class="text-sm text-slate-400">
                                Borrower information is stored securely and only used for library management purposes.
                                Personal data is never shared with third parties.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Gradient text for header */
        .gradient-text {
            background: linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* Glass effect */
        .glass-panel {
            background: rgba(15, 23, 42, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(148, 163, 184, 0.2);
            border-radius: 1rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }
        
        .glass-input {
            background: rgba(15, 23, 42, 0.5);
            border: 1px solid rgba(148, 163, 184, 0.2);
            color: #cbd5e1;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }
        
        .glass-input:focus {
            outline: none;
            border-color: rgba(139, 92, 246, 0.5);
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
            background: rgba(15, 23, 42, 0.7);
        }
        
        .glass-input::placeholder {
            color: #64748b;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(139, 92, 246, 0.4);
        }
        
        .btn-primary:active {
            transform: translateY(0);
        }
        
        /* Smooth transitions */
        * {
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }
        
        /* Form field focus animation */
        .glass-input:focus {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(139, 92, 246, 0.1);
            }
            70% {
                box-shadow: 0 0 0 6px rgba(139, 92, 246, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(139, 92, 246, 0);
            }
        }
        
        /* Error state styling */
        .glass-input:invalid {
            border-color: rgba(239, 68, 68, 0.5);
        }
        
        .glass-input:invalid:focus {
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }
        
        /* Responsive adjustments */
        @media (max-width: 640px) {
            .glass-panel {
                padding: 1.5rem;
            }
            
            .flex-col {
                flex-direction: column;
            }
            
            .flex-col > * {
                width: 100%;
            }
        }
    </style>
</x-app-layout>