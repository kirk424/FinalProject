<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-serif text-3xl font-bold gradient-text mb-2">Borrow Records</h2>
                <p class="text-slate-400">Manage book borrowings and returns</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="text-sm text-slate-400 bg-slate-800/50 px-4 py-2 rounded-lg backdrop-blur-sm border border-slate-700/50">
                    <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    {{ $activeBorrows ?? $borrows->whereNull('returned_at')->count() }} Active Borrows
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto">
            <!-- New Borrow Form -->
            <div class="glass-panel p-8 mb-8">
                <h3 class="text-xl font-semibold text-white mb-6 flex items-center gap-2">
                    <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    New Book Borrow
                </h3>

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

                <form action="{{ route('borrows.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Borrower Selection -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-slate-300">
                                <span class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    Borrower *
                                </span>
                            </label>
                            <select name="borrower_id" 
                                    required
class="dark-blue-select w-full px-4 py-3 rounded-lg focus:ring-2 focus:ring-blue-500/50 focus:border-transparent transition-all appearance-none">                                <option value="">Select Borrower</option>
                                @foreach($borrowers as $borrower)
                                    <option value="{{ $borrower->id }}" {{ old('borrower_id') == $borrower->id ? 'selected' : '' }}>
                                        {{ $borrower->name }} (ID: {{ $borrower->id }})
                                    </option>
                                @endforeach
                            </select>
                            @error('borrower_id')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Book Selection -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-slate-300">
                                <span class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                    Book *
                                </span>
                            </label>
                            <select name="book_id" 
                                    required
class="dark-blue-select w-full px-4 py-3 rounded-lg focus:ring-2 focus:ring-blue-500/50 focus:border-transparent transition-all appearance-none">
                                <option value="">Select Book</option>
                                @foreach($availableBooks as $book)
                                    <option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }}>
                                        {{ $book->title }} by {{ $book->author }} ({{ $book->quantity }} available)
                                    </option>
                                @endforeach
                            </select>
                            @error('book_id')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="pt-4">
                        <button type="submit" 
                                class="btn-primary-emerald px-8 py-3 rounded-lg text-white font-medium transition-all duration-300 flex items-center gap-2 group">
                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                            </svg>
                            Borrow Book
                        </button>
                    </div>
                </form>
            </div>

            <!-- Borrow Records Table -->
            <div class="glass-panel overflow-hidden">
                <!-- Table Header -->
                <div class="px-8 py-6 border-b border-slate-700/50">
                    <h3 class="text-xl font-semibold text-white flex items-center gap-2">
                        <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        Borrow Records
                    </h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gradient-to-r from-slate-800/50 to-slate-900/30 border-b border-slate-700/50">
                                <th class="p-6 text-left text-sm font-semibold text-slate-300 uppercase tracking-wider">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                        </svg>
                                        Borrow ID
                                    </div>
                                </th>
                                <th class="p-6 text-left text-sm font-semibold text-slate-300 uppercase tracking-wider">
                                    Borrower
                                </th>
                                <th class="p-6 text-left text-sm font-semibold text-slate-300 uppercase tracking-wider">
                                    Book
                                </th>
                                <th class="p-6 text-left text-sm font-semibold text-slate-300 uppercase tracking-wider">
                                    Borrowed At
                                </th>
                                <th class="p-6 text-left text-sm font-semibold text-slate-300 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="p-6 text-left text-sm font-semibold text-slate-300 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-700/30">
                            @forelse($borrows as $borrow)
                                <tr class="hover:bg-slate-800/30 transition-colors group">
                                    <td class="p-6">
                                        <div class="flex items-center gap-2">
                                            <div class="w-8 h-8 bg-gradient-to-br from-blue-500/20 to-cyan-600/20 rounded-lg flex items-center justify-center border border-slate-700/50">
                                                <span class="text-sm font-bold text-blue-300">#{{ $borrow->id }}</span>
                                            </div>
                                            <div class="text-xs text-slate-400 font-mono">
                                                TRX-{{ str_pad($borrow->id, 6, '0', STR_PAD_LEFT) }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-6">
                                        <div class="flex items-start gap-3">
                                            <div class="w-8 h-8 bg-gradient-to-br from-purple-500/20 to-pink-600/20 rounded-full flex items-center justify-center border border-slate-700/50">
                                                <svg class="w-4 h-4 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="font-medium text-white group-hover:text-purple-300 transition-colors">
                                                    {{ $borrow->borrower->name }}
                                                </div>
                                                <div class="text-xs text-slate-500 mt-1">
                                                    ID: {{ $borrow->borrower->id }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-6">
                                        <div class="flex items-start gap-3">
                                            <div class="w-8 h-10 bg-gradient-to-br from-amber-500/20 to-orange-600/20 rounded flex items-center justify-center border border-slate-700/50">
                                                <svg class="w-4 h-4 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="font-medium text-white">{{ $borrow->book->title }}</div>
                                                <div class="text-xs text-slate-400 mt-1">
                                                    by {{ $borrow->book->author }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-6">
                                        <div class="space-y-1">
                                            <div class="text-slate-300 font-medium">
                                                {{ \Carbon\Carbon::parse($borrow->borrowed_at)->format('M d, Y') }}
                                            </div>
                                            <div class="text-xs text-slate-500">
                                                {{ \Carbon\Carbon::parse($borrow->borrowed_at)->format('h:i A') }}
                                            </div>
                                            @php
                                                $daysBorrowed = \Carbon\Carbon::parse($borrow->borrowed_at)->diffInDays(now());
                                            @endphp
                                            <div class="text-xs {{ $daysBorrowed > 14 ? 'text-red-400' : 'text-slate-400' }}">
                                                {{ $daysBorrowed }} day{{ $daysBorrowed !== 1 ? 's' : '' }} ago
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-6">
                                        @if($borrow->returned_at)
                                            <span class="px-3 py-1.5 rounded-full text-xs font-medium bg-emerald-500/10 text-emerald-300 border border-emerald-500/20 flex items-center gap-1 w-fit">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                Returned
                                            </span>
                                            <div class="text-xs text-slate-500 mt-1">
                                                {{ \Carbon\Carbon::parse($borrow->returned_at)->format('M d, Y') }}
                                            </div>
                                        @else
                                            <span class="px-3 py-1.5 rounded-full text-xs font-medium bg-amber-500/10 text-amber-300 border border-amber-500/20 flex items-center gap-1 w-fit">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                Active
                                            </span>
                                            @php
                                                $dueDate = \Carbon\Carbon::parse($borrow->borrowed_at)->addDays(14);
                                                $isOverdue = now()->greaterThan($dueDate);
                                            @endphp
                                            <div class="text-xs {{ $isOverdue ? 'text-red-400' : 'text-slate-400' }} mt-1">
                                                Due: {{ $dueDate->format('M d') }}
                                                @if($isOverdue)
                                                    <span class="ml-1">(Overdue)</span>
                                                @endif
                                            </div>
                                        @endif
                                    </td>
                                    <td class="p-6">
                                        <div class="flex items-center gap-2">
                                            @if(!$borrow->returned_at)
                                                <!-- Change from PUT to POST -->
<form method="POST" 
      action="{{ route('borrows.return', $borrow->id) }}"
      id="return-form-{{ $borrow->id }}"
      class="inline">
    @csrf
    <!-- Remove @method('PUT') or change to @method('POST') -->
    <button type="button"
            onclick="confirmReturn({{ $borrow->id }}, '{{ addslashes($borrow->book->title) }}')"
            class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-emerald-500/10 text-emerald-300 hover:bg-emerald-500/20 border border-emerald-500/20 transition-all duration-300 hover:scale-105">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
        Return
    </button>
</form>
                                            @else
                                                <span class="text-sm text-slate-500 italic">Completed</span>
                                            @endif

                                            <!-- Delete Button (Optional) -->
                                            <form method="POST" 
                                                  action="{{ route('borrows.destroy', $borrow->id) }}"
                                                  id="delete-form-{{ $borrow->id }}"
                                                  class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                        onclick="confirmDelete({{ $borrow->id }}, '{{ addslashes($borrow->book->title) }}')"
                                                        class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-red-500/10 text-red-300 hover:bg-red-500/20 border border-red-500/20 transition-all duration-300 hover:scale-105">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-12 text-center">
                                        <div class="flex flex-col items-center justify-center gap-4">
                                            <div class="w-20 h-20 rounded-full bg-slate-800/50 flex items-center justify-center border border-slate-700/50">
                                                <svg class="w-10 h-10 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <h3 class="text-lg font-semibold text-slate-300 mb-1">No borrow records found</h3>
                                                <p class="text-slate-500 text-sm">Start by borrowing a book to a borrower</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if(method_exists($borrows, 'hasPages') && $borrows->hasPages())
                    <div class="px-6 py-4 border-t border-slate-700/50 bg-slate-900/30">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-slate-400">
                                Showing {{ $borrows->firstItem() ?? 1 }} to {{ $borrows->lastItem() ?? count($borrows) }} of {{ $borrows->total() ?? count($borrows) }} records
                            </div>
                            <div class="flex items-center gap-2">
                                {{ $borrows->links() }}
                            </div>
                        </div>
                    </div>
                @elseif(count($borrows) > 0)
                    <div class="px-6 py-4 border-t border-slate-700/50 bg-slate-900/30">
                        <div class="text-sm text-slate-400 text-center">
                            Displaying {{ count($borrows) }} record/s
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        function confirmReturn(borrowId, bookTitle) {
            if (confirm(`Are you sure you want to return "${bookTitle}"?\n\nThis will mark the book as returned.`)) {
                const button = document.querySelector(`#return-form-${borrowId} button`);
                const originalText = button.innerHTML;
                button.innerHTML = '<svg class="w-4 h-4 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg> Returning...';
                button.disabled = true;
                
                document.getElementById(`return-form-${borrowId}`).submit();
            }
        }

        function confirmDelete(borrowId, bookTitle) {
            if (confirm(`Are you sure you want to delete this borrow record for "${bookTitle}"?\n\nThis action cannot be undone and will permanently delete the record.`)) {
                const button = document.querySelector(`#delete-form-${borrowId} button`);
                const originalText = button.innerHTML;
                button.innerHTML = '<svg class="w-4 h-4 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg> Deleting...';
                button.disabled = true;
                
                document.getElementById(`delete-form-${borrowId}`).submit();
            }
        }

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
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.5) 0%, rgba(59, 130, 246, 0.5) 100%);
            border-radius: 3px;
        }
        
        .overflow-x-auto::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.8) 0%, rgba(59, 130, 246, 0.8) 100%);
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
            color: #2c2fdf;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }
        
        .glass-input:focus {
            outline: none;
            border-color: rgba(16, 185, 129, 0.5);
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        /* Dark Blue Select Dropdown */
        .dark-blue-select {
            background: linear-gradient(135deg, rgba(30, 58, 138, 0.8) 0%, rgba(30, 64, 175, 0.8) 100%);
            border: 1px solid rgba(59, 130, 246, 0.3);
            color: #e2e8f0;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }
        
        .dark-blue-select:focus {
            outline: none;
            border-color: rgba(59, 130, 246, 0.5);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            background: linear-gradient(135deg, rgba(30, 58, 138, 0.9) 0%, rgba(30, 64, 175, 0.9) 100%);
        }
        
        .dark-blue-select option {
            background: rgba(15, 23, 42, 0.9);
            color: #cbd5e1;
            padding: 12px;
        }
        
        .dark-blue-select option:hover {
            background: rgba(30, 41, 59, 0.9);
        }
        
        .dark-blue-select option:checked {
            background: rgba(59, 130, 246, 0.3);
            color: white;
        }
        
        /* Remove default select styling */
        select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }
        
        /* Custom scrollbar for select dropdowns */
        select::-webkit-scrollbar {
            width: 8px;
        }
        
        select::-webkit-scrollbar-track {
            background: rgba(15, 23, 42, 0.5);
            border-radius: 4px;
        }
        
        select::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.5) 0%, rgba(30, 58, 138, 0.5) 100%);
            border-radius: 4px;
        }
        
        /* Gradient text for header */
        .gradient-text {
            background: linear-gradient(135deg, #10b981 0%, #3b82f6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* Emerald gradient button */
        .btn-primary-emerald {
            background: linear-gradient(135deg, #10b981 0%, #3b82f6 100%);
            color: rgb(30, 65, 237);
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
        
        .btn-primary-emerald:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.4);
        }
        
        /* Select dropdown styling */
        select.glass-input {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2364748b'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 1rem;
            padding-right: 2.5rem;
        }
        
        /* Loading spinner */
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        .animate-spin {
            animation: spin 1s linear infinite;
        }
        
        /* Hover effects */
        tbody tr:hover {
            background: rgba(30, 41, 59, 0.5) !important;
        }
        
        /* Status badge animations */
        .status-badge {
            position: relative;
            overflow: hidden;
        }
        
        .status-badge.active::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            animation: shine 2s infinite;
        }
        
        @keyframes shine {
            0% { left: -100%; }
            100% { left: 100%; }
        }
        
        /* Overdue warning animation */
        @keyframes pulse-red {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
        
        .text-red-400 {
            animation: pulse-red 2s infinite;
        }
    </style>
</x-app-layout>