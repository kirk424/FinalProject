<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-serif text-3xl font-bold gradient-text mb-2">Edit Book</h2>
                <p class="text-slate-400">Update book information in your library collection</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="text-sm text-slate-400 bg-slate-800/50 px-4 py-2 rounded-lg backdrop-blur-sm border border-slate-700/50">
                    <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Editing: {{ Str::limit($book->title, 30) }}
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto">
            <!-- Success/Error Messages -->
            @if ($errors->any())
                <div class="mb-6 p-4 rounded-lg bg-red-500/10 border border-red-500/20">
                    <div class="flex items-center gap-3 mb-3">
                        <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <h3 class="font-medium text-red-300">Please fix the following errors:</h3>
                    </div>
                    <ul class="text-sm text-red-400 list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Current Book Info -->
            <div class="glass-panel p-6 mb-6">
                <div class="flex items-start gap-4">
                    <div class="w-16 h-20 bg-gradient-to-br from-blue-500/20 to-purple-600/20 rounded-lg flex items-center justify-center border border-slate-700/50">
                        <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-serif text-xl font-bold text-white mb-1">{{ $book->title }}</h3>
                        <p class="text-slate-400 mb-2">by {{ $book->author }}</p>
                        <div class="flex flex-wrap gap-2">
                            <span class="text-xs px-3 py-1 rounded-full bg-slate-800/50 text-slate-300">
                                ISBN: {{ $book->isbn }}
                            </span>
                            @if($book->category)
                                <span class="text-xs px-3 py-1 rounded-full bg-blue-500/20 text-blue-300">
                                    {{ $book->category }}
                                </span>
                            @endif
                            <span class="text-xs px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-300">
                                {{ $book->quantity }} copies
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Card -->
            <div class="glass-panel overflow-hidden">
                <div class="p-8">
                    <form method="POST" action="{{ route('books.update', $book) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Book Icon -->
                        <div class="flex justify-center mb-8">
                            <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-amber-500/20 to-orange-600/20 flex items-center justify-center border border-slate-700/50">
                                <svg class="w-10 h-10 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </div>
                        </div>

                        <!-- Title -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-slate-300">
                                <span class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Title *
                                </span>
                            </label>
                            <input type="text" 
                                   name="title" 
                                   value="{{ old('title', $book->title) }}"
                                   class="glass-input w-full px-4 py-3 rounded-lg placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500/30"
                                   placeholder="Enter book title"
                                   required
                                   autofocus>
                            @error('title')
                                <p class="text-sm text-red-400 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Author -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-slate-300">
                                <span class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    Author *
                                </span>
                            </label>
                            <input type="text" 
                                   name="author" 
                                   value="{{ old('author', $book->author) }}"
                                   class="glass-input w-full px-4 py-3 rounded-lg placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500/30"
                                   placeholder="Enter author name"
                                   required>
                            @error('author')
                                <p class="text-sm text-red-400 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- ISBN -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-slate-300">
                                <span class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                    </svg>
                                    ISBN *
                                </span>
                            </label>
                            <input type="text" 
                                   name="isbn" 
                                   value="{{ old('isbn', $book->isbn) }}"
                                   class="glass-input w-full px-4 py-3 rounded-lg placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500/30"
                                   placeholder="Enter 13-digit ISBN"
                                   required>
                            @error('isbn')
                                <p class="text-sm text-red-400 mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-xs text-slate-400 mt-1">International Standard Book Number (e.g., 978-3-16-148410-0)</p>
                        </div>

                        <!-- Quantity -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-slate-300">
                                <span class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Quantity *
                                </span>
                            </label>
                            <input type="number" 
                                   name="quantity" 
                                   value="{{ old('quantity', $book->quantity) }}"
                                   class="glass-input w-full px-4 py-3 rounded-lg placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500/30"
                                   min="0"
                                   required>
                            @error('quantity')
                                <p class="text-sm text-red-400 mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-xs text-slate-400 mt-1">Number of copies available in the library</p>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-6 border-t border-slate-700/50">
                            <a href="{{ route('books.index') }}"
                               class="inline-flex items-center gap-2 px-6 py-3 rounded-lg bg-slate-800/50 text-slate-300 hover:bg-slate-700/50 border border-slate-700/50 transition-all duration-300 w-full sm:w-auto justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                                Back to Books
                            </a>

                            <div class="flex items-center gap-4 w-full sm:w-auto">
                                <button type="reset"
                                        class="inline-flex items-center gap-2 px-6 py-3 rounded-lg bg-amber-500/10 text-amber-300 hover:bg-amber-500/20 border border-amber-500/20 transition-all duration-300 w-full sm:w-auto justify-center">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    Reset Changes
                                </button>

                                <button type="submit"
                                        class="inline-flex items-center gap-2 px-6 py-3 rounded-lg bg-gradient-to-r from-emerald-500 to-emerald-600 text-white font-semibold hover:from-emerald-600 hover:to-emerald-700 transition-all duration-300 hover:scale-105 w-full sm:w-auto justify-center">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Update Book
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Help Text -->
            <div class="mt-6 text-center">
                <p class="text-sm text-slate-500">
                    <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Fields marked with * are required. ISBN must be unique.
                </p>
            </div>
        </div>
    </div>

    <script>
        // Form validation and enhancement
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const isbnInput = document.querySelector('input[name="isbn"]');
            
            // Format ISBN input
            isbnInput?.addEventListener('input', function(e) {
                let value = e.target.value.replace(/[^\d-]/g, '');
                
                // Auto-format as ISBN
                if (value.length > 3 && value[3] !== '-') {
                    value = value.slice(0, 3) + '-' + value.slice(3);
                }
                if (value.length > 5 && value[5] !== '-') {
                    value = value.slice(0, 5) + '-' + value.slice(5);
                }
                if (value.length > 10 && value[10] !== '-') {
                    value = value.slice(0, 10) + '-' + value.slice(10);
                }
                if (value.length > 15) {
                    value = value.slice(0, 17);
                }
                
                e.target.value = value;
            });
            
            // Form submission loading
            form?.addEventListener('submit', function(e) {
                const submitButton = form.querySelector('button[type="submit"]');
                const originalText = submitButton.innerHTML;
                submitButton.innerHTML = `
                    <svg class="w-4 h-4 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Updating Book...
                `;
                submitButton.disabled = true;
            });
            
            // Auto-focus title field
            const titleInput = document.querySelector('input[name="title"]');
            titleInput?.focus();
            
            // Reset form confirmation
            const resetButton = form.querySelector('button[type="reset"]');
            resetButton?.addEventListener('click', function(e) {
                if (!confirm('Are you sure you want to reset all changes? All unsaved edits will be lost.')) {
                    e.preventDefault();
                }
            });
        });
    </script>

    <style>
        /* Loading spinner */
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        .animate-spin {
            animation: spin 1s linear infinite;
        }
        
        /* Form input focus effects */
        .glass-input:focus {
            transform: translateY(-1px);
            box-shadow: 0 4px 20px rgba(245, 158, 11, 0.1);
        }
        
        /* Smooth transitions */
        * {
            transition: background-color 0.3s ease, border-color 0.3s ease, transform 0.2s ease;
        }
        
        /* Required field indicator */
        label span svg {
            color: #f87171;
        }
        
        /* Edit-specific styling */
        .gradient-text-edit {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</x-app-layout>