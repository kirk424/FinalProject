<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-serif text-3xl font-bold gradient-text mb-2">Manage Books</h2>
                <p class="text-slate-400">Browse and manage your library's book collection</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="text-sm text-slate-400 bg-slate-800/50 px-4 py-2 rounded-lg backdrop-blur-sm border border-slate-700/50">
                    <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                    {{ $books->count() }} Books Total
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto">
            <!-- Header Actions -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                <div class="flex items-center gap-4">
                    <a href="{{ route('books.create') }}"
                       class="btn-primary inline-flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Add New Book
                    </a>
                    
                    <!-- Search Box -->
                    <div class="relative">
                        <input type="text" 
                               placeholder="Search books..." 
                               class="glass-input pl-10 pr-4 py-2 rounded-lg text-sm w-64 focus:w-72 transition-all duration-300"
                               id="searchInput">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-slate-400" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </div>
                
                <!-- Filter Tabs -->
                <div class="flex items-center gap-2 bg-slate-800/50 backdrop-blur-sm rounded-lg p-1 border border-slate-700/50">
                    <button class="px-4 py-2 rounded-md text-sm font-medium text-slate-300 hover:text-white hover:bg-slate-700/50 transition-all">
                        All Books
                    </button>
                    <button class="px-4 py-2 rounded-md text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-700/50 transition-all">
                        Available
                    </button>
                    <button class="px-4 py-2 rounded-md text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-700/50 transition-all">
                        Borrowed
                    </button>
                </div>
            </div>

            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="mb-6 p-4 rounded-lg bg-emerald-500/10 border border-emerald-500/20 text-emerald-300">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 rounded-lg bg-red-500/10 border border-red-500/20 text-red-300">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            <!-- Books Table -->
            <div class="glass-panel overflow-hidden">
                <!-- Table Header -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gradient-to-r from-slate-800/50 to-slate-900/30 border-b border-slate-700/50">
                                <th class="p-6 text-left text-sm font-semibold text-slate-300 uppercase tracking-wider">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                        </svg>
                                        Title
                                    </div>
                                </th>
                                <th class="p-6 text-left text-sm font-semibold text-slate-300 uppercase tracking-wider">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        Author
                                    </div>
                                </th>
                                <th class="p-6 text-left text-sm font-semibold text-slate-300 uppercase tracking-wider">
                                    ISBN
                                </th>
                                <th class="p-6 text-left text-sm font-semibold text-slate-300 uppercase tracking-wider">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                        </svg>
                                        Quantity
                                    </div>
                                </th>
                                <th class="p-6 text-left text-sm font-semibold text-slate-300 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-700/30">
                            @forelse($books as $book)
                                <tr class="hover:bg-slate-800/30 transition-colors group">
                                    <td class="p-6">
                                        <div class="flex items-start gap-3">
                                            <div class="w-10 h-14 bg-gradient-to-br from-blue-500/20 to-purple-600/20 rounded-lg flex items-center justify-center border border-slate-700/50">
                                                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="font-medium text-white group-hover:text-blue-300 transition-colors">
                                                    {{ $book->title }}
                                                </div>
                                                <div class="text-xs text-slate-400 mt-1">
                                                    @if($book->category)
                                                        <span class="px-2 py-1 rounded-full bg-slate-800/50 text-slate-300">
                                                            {{ $book->category }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-6">
                                        <div class="text-slate-300">{{ $book->author }}</div>
                                        @if($book->published_year)
                                            <div class="text-xs text-slate-500 mt-1">{{ $book->published_year }}</div>
                                        @endif
                                    </td>
                                    <td class="p-6">
                                        <code class="text-sm font-mono bg-slate-800/50 px-2 py-1 rounded border border-slate-700 text-slate-300">
                                            {{ $book->isbn }}
                                        </code>
                                    </td>
                                    <td class="p-6">
                                        <div class="flex items-center gap-3">
                                            <div class="relative">
                                                <div class="w-24 h-2 bg-slate-700 rounded-full overflow-hidden">
                                                    @php
                                                        $available = isset($book->available) ? $book->available : $book->quantity;
                                                        $percentage = $book->quantity > 0 ? min(100, $available * 100 / $book->quantity) : 0;
                                                        $color = $percentage >= 70 ? 'bg-emerald-500' : ($percentage >= 30 ? 'bg-amber-500' : 'bg-red-500');
                                                    @endphp
                                                    <div class="h-full {{ $color }} rounded-full" style="width: {{ $percentage }}%"></div>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <div class="text-lg font-bold text-white">{{ $book->quantity }}</div>
                                                <div class="text-xs text-slate-400">available</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-6">
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('books.edit', $book) }}"
                                               class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-amber-500/10 text-amber-300 hover:bg-amber-500/20 border border-amber-500/20 transition-all duration-300 hover:scale-105">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                                Edit
                                            </a>

                                            <!-- Delete Form -->
                                            <form method="POST" 
                                                  action="{{ route('books.destroy', $book) }}"
                                                  id="delete-form-{{ $book->id }}"
                                                  class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                        onclick="confirmDelete({{ $book->id }}, '{{ addslashes($book->title) }}')"
                                                        class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-red-500/10 text-red-300 hover:bg-red-500/20 border border-red-500/20 transition-all duration-300 hover:scale-105">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                    Delete
                                                </button>
                                            </form>
                                            
                                            <!-- Quick View Button -->
                                            
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-12 text-center">
                                        <div class="flex flex-col items-center justify-center gap-4">
                                            <div class="w-20 h-20 rounded-full bg-slate-800/50 flex items-center justify-center border border-slate-700/50">
                                                <svg class="w-10 h-10 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <h3 class="text-lg font-semibold text-slate-300 mb-1">No books found</h3>
                                                <p class="text-slate-500 text-sm">Start by adding your first book to the library</p>
                                            </div>
                                            <a href="{{ route('books.create') }}" 
                                               class="btn-primary inline-flex items-center gap-2 mt-2">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                                </svg>
                                                Add First Book
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($books->hasPages())
                    <div class="px-6 py-4 border-t border-slate-700/50 bg-slate-900/30">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-slate-400">
                                Showing {{ $books->firstItem() ?? 1 }} to {{ $books->lastItem() ?? count($books) }} of {{ $books->total() ?? count($books) }} books
                            </div>
                            <div class="flex items-center gap-2">
                                {{ $books->links() }}
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Simple count display if no pagination -->
                    <div class="px-6 py-4 border-t border-slate-700/50 bg-slate-900/30">
                        <div class="text-sm text-slate-400 text-center">
                            Displaying {{ count($books) }} book/s
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(bookId, bookTitle) {
            // Simple confirmation dialog
            if (confirm(`Are you sure you want to delete "${bookTitle}"?\n\nThis action cannot be undone.`)) {
                // Show loading indicator
                const button = document.querySelector(`#delete-form-${bookId} button`);
                const originalText = button.innerHTML;
                button.innerHTML = '<svg class="w-4 h-4 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg> Deleting...';
                button.disabled = true;
                
                // Submit the form
                document.getElementById(`delete-form-${bookId}`).submit();
            }
        }

        // Search functionality
        document.getElementById('searchInput')?.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        });

        // Add animation to table rows
        document.addEventListener('DOMContentLoaded', () => {
            const rows = document.querySelectorAll('tbody tr');
            rows.forEach((row, index) => {
                row.style.animationDelay = `${index * 0.05}s`;
                row.classList.add('animate-fadeInUp');
            });
        });
    </script>

    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fadeInUp {
            animation: fadeInUp 0.3s ease-out forwards;
            opacity: 0;
        }
        
        /* Custom scrollbar for table */
        .overflow-x-auto::-webkit-scrollbar {
            height: 6px;
        }
        
        .overflow-x-auto::-webkit-scrollbar-track {
            background: rgba(15, 23, 42, 0.3);
            border-radius: 3px;
        }
        
        .overflow-x-auto::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.5) 0%, rgba(109, 40, 217, 0.5) 100%);
            border-radius: 3px;
        }
        
        .overflow-x-auto::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.8) 0%, rgba(109, 40, 217, 0.8) 100%);
        }
        
        /* Hover effects */
        tbody tr:hover {
            background: rgba(30, 41, 59, 0.5) !important;
        }
        
        /* Loading spinner */
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        .animate-spin {
            animation: spin 1s linear infinite;
        }
    </style>
</x-app-layout>