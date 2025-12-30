<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-serif text-3xl font-bold gradient-text mb-2">Manage Borrowers</h2>
                <p class="text-slate-400">Browse and manage library borrowers and members</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="text-sm text-slate-400 bg-slate-800/50 px-4 py-2 rounded-lg backdrop-blur-sm border border-slate-700/50">
                    <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    {{ $borrowers->count() }} Borrowers Total
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto">
            <!-- Header Actions -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                <div class="flex items-center gap-4">
                    <a href="{{ route('borrowers.create') }}"
                       class="btn-primary inline-flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                        Add New Borrower
                    </a>
                    
                    <!-- Search Box -->
                    <div class="relative">
                        <input type="text" 
                               placeholder="Search borrowers..." 
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
                        All Borrowers
                    </button>
                    <button class="px-4 py-2 rounded-md text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-700/50 transition-all">
                        Active
                    </button>
                    <button class="px-4 py-2 rounded-md text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-700/50 transition-all">
                        Inactive
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

            <!-- Borrowers Table -->
            <div class="glass-panel overflow-hidden">
                <!-- Table Header -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gradient-to-r from-slate-800/50 to-slate-900/30 border-b border-slate-700/50">
                                <th class="p-6 text-left text-sm font-semibold text-slate-300 uppercase tracking-wider">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        Borrower
                                    </div>
                                </th>
                                <th class="p-6 text-left text-sm font-semibold text-slate-300 uppercase tracking-wider">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89-3.955a2 2 0 011.763 0L21 8m-5 11v-5a2 2 0 00-2-2h-4a2 2 0 00-2 2v5m12-13.664V19a2 2 0 01-2 2H5a2 2 0 01-2-2V5.336"/>
                                        </svg>
                                        Contact
                                    </div>
                                </th>
                                <th class="p-6 text-left text-sm font-semibold text-slate-300 uppercase tracking-wider">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                        </svg>
                                        Phone
                                    </div>
                                </th>
                                <th class="p-6 text-left text-sm font-semibold text-slate-300 uppercase tracking-wider">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                        </svg>
                                        Status
                                    </div>
                                </th>
                                <th class="p-6 text-left text-sm font-semibold text-slate-300 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-700/30">
                            @forelse($borrowers as $borrower)
                                <tr class="hover:bg-slate-800/30 transition-colors group">
                                    <td class="p-6">
                                        <div class="flex items-start gap-3">
                                            <div class="w-10 h-10 bg-gradient-to-br from-purple-500/20 to-pink-600/20 rounded-full flex items-center justify-center border border-slate-700/50">
                                                <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="font-medium text-white group-hover:text-purple-300 transition-colors">
                                                    {{ $borrower->name }}
                                                </div>
                                                <div class="text-xs text-slate-400 mt-1">
                                                    ID: <span class="font-mono text-slate-300">{{ $borrower->id }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-6">
                                        <div class="flex flex-col gap-1">
                                            <div class="text-slate-300 flex items-center gap-2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89-3.955a2 2 0 011.763 0L21 8m-5 11v-5a2 2 0 00-2-2h-4a2 2 0 00-2 2v5m12-13.664V19a2 2 0 01-2 2H5a2 2 0 01-2-2V5.336"/>
                                                </svg>
                                                {{ $borrower->email }}
                                            </div>
                                            <div class="text-xs text-slate-500">
                                                Registered: {{ $borrower->created_at->format('M d, Y') }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-6">
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                            </svg>
                                            <code class="text-sm font-mono bg-slate-800/50 px-3 py-1 rounded border border-slate-700 text-slate-300">
                                                {{ $borrower->phone }}
                                            </code>
                                        </div>
                                    </td>
                                    <td class="p-6">
                                        <div class="flex items-center gap-3">
                                            <div class="relative">
                                                @php
                                                    // Mock status - you can replace with actual logic
                                                    $status = 'Active';
                                                    $statusColor = 'bg-emerald-500';
                                                    $loansCount = isset($borrower->loans_count) ? $borrower->loans_count : rand(0, 5);
                                                @endphp
                                                <div class="w-24 h-2 bg-slate-700 rounded-full overflow-hidden">
                                                    <div class="h-full {{ $statusColor }} rounded-full" style="width: {{ min(100, $loansCount * 20) }}%"></div>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <span class="px-3 py-1 rounded-full text-xs font-medium 
                                                    {{ $status === 'Active' ? 'bg-emerald-500/10 text-emerald-300 border border-emerald-500/20' : 'bg-slate-500/10 text-slate-300 border border-slate-500/20' }}">
                                                    {{ $status }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-6">
                                        <div class="flex items-center gap-2">
                                            

                                            <!-- Delete Form -->
                                            <form method="POST" 
                                                  action="{{ route('borrowers.destroy', $borrower) }}"
                                                  id="delete-form-{{ $borrower->id }}"
                                                  class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                        onclick="confirmDelete({{ $borrower->id }}, '{{ addslashes($borrower->name) }}')"
                                                        class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-red-500/10 text-red-300 hover:bg-red-500/20 border border-red-500/20 transition-all duration-300 hover:scale-105">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                    Delete
                                                </button>
                                            </form>
                                            
                                            <!-- View Details Button -->
                                            
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-12 text-center">
                                        <div class="flex flex-col items-center justify-center gap-4">
                                            <div class="w-20 h-20 rounded-full bg-slate-800/50 flex items-center justify-center border border-slate-700/50">
                                                <svg class="w-10 h-10 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <h3 class="text-lg font-semibold text-slate-300 mb-1">No borrowers found</h3>
                                                <p class="text-slate-500 text-sm">Start by adding your first borrower to the library</p>
                                            </div>
                                            <a href="{{ route('borrowers.create') }}" 
                                               class="btn-primary inline-flex items-center gap-2 mt-2">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                                                </svg>
                                                Add First Borrower
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if(method_exists($borrowers, 'hasPages') && $borrowers->hasPages())
                    <div class="px-6 py-4 border-t border-slate-700/50 bg-slate-900/30">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-slate-400">
                                Showing {{ $borrowers->firstItem() ?? 1 }} to {{ $borrowers->lastItem() ?? count($borrowers) }} of {{ $borrowers->total() ?? count($borrowers) }} borrowers
                            </div>
                            <div class="flex items-center gap-2">
                                {{ $borrowers->links() }}
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Simple count display if no pagination -->
                    <div class="px-6 py-4 border-t border-slate-700/50 bg-slate-900/30">
                        <div class="text-sm text-slate-400 text-center">
                            Displaying {{ count($borrowers) }} borrower/s
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(borrowerId, borrowerName) {
            if (confirm(`Are you sure you want to delete "${borrowerName}"?\n\nThis will permanently remove all borrower data.`)) {
                // Show loading indicator
                const button = document.querySelector(`#delete-form-${borrowerId} button`);
                const originalText = button.innerHTML;
                button.innerHTML = '<svg class="w-4 h-4 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg> Deleting...';
                button.disabled = true;
                
                // Submit the form
                document.getElementById(`delete-form-${borrowerId}`).submit();
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
            background: linear-gradient(135deg, rgba(139, 92, 246, 0.5) 0%, rgba(236, 72, 153, 0.5) 100%);
            border-radius: 3px;
        }
        
        .overflow-x-auto::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, rgba(139, 92, 246, 0.8) 0%, rgba(236, 72, 153, 0.8) 100%);
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
        
        .status-badge::before {
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
        
        /* Loading spinner */
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        .animate-spin {
            animation: spin 1s linear infinite;
        }
        
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
        }
        
        .glass-input:focus {
            outline: none;
            border-color: rgba(139, 92, 246, 0.5);
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
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
    </style>
</x-app-layout>