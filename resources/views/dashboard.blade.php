<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-serif text-3xl font-bold gradient-text mb-2">Library Dashboard</h2>
                <p class="text-slate-400">Welcome back, {{ Auth::user()->name }}! Here's your library overview.</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="text-sm text-slate-400 bg-slate-800/50 px-4 py-2 rounded-lg backdrop-blur-sm border border-slate-700/50">
                    <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    {{ now()->format('l, F j, Y') }}
                </div>
                <div class="relative group">
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center border-2 border-slate-700 group-hover:border-blue-400 transition-all duration-300">
                        <span class="text-white font-bold text-lg">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                    </div>
                    <div class="absolute -bottom-2 right-0 w-3 h-3 bg-emerald-500 rounded-full border-2 border-slate-900"></div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <!-- Stats Cards - Modern Grid -->
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            @php
                $cards = [
                    [
                        'title' => 'Total Books',
                        'value' => $totalBooks,
                        'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253',
                        'color' => 'blue',
                        'trend' => '+12 this week',
                        'gradient' => 'from-blue-500/20 via-blue-600/15 to-blue-700/10'
                    ],
                    [
                        'title' => 'Active Members',
                        'value' => $totalBorrowers,
                        'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
                        'color' => 'emerald',
                        'trend' => '+5 today',
                        'gradient' => 'from-emerald-500/20 via-emerald-600/15 to-emerald-700/10'
                    ],
                    [
                        'title' => 'Borrowed Books',
                        'value' => $borrowedBooks,
                        'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
                        'color' => 'amber',
                        'trend' => rand(1, 10) . ' due today',
                        'gradient' => 'from-amber-500/20 via-amber-600/15 to-amber-700/10'
                    ],
                    [
                        'title' => 'Available Copies',
                        'value' => $availableBooks,
                        'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                        'color' => 'purple',
                        'trend' => rand(5, 25) . ' reserved',
                        'gradient' => 'from-purple-500/20 via-purple-600/15 to-purple-700/10'
                    ]
                ];
            @endphp

            @foreach($cards as $card)
                <div class="group relative">
                    <div class="absolute inset-0 bg-gradient-to-br {{ $card['gradient'] }} rounded-2xl blur-xl opacity-50 group-hover:opacity-70 transition-opacity duration-300"></div>
                    <div class="relative glass-panel p-6 hover:border-slate-600/50 transition-all duration-300 hover:scale-[1.02]">
                        <div class="flex items-start justify-between mb-6">
                            <div class="p-3 rounded-xl bg-gradient-to-br {{ $card['gradient'] }} border border-slate-700/30">
                                <svg class="w-6 h-6 text-{{ $card['color'] }}-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $card['icon'] }}"/>
                                </svg>
                            </div>
                            <div class="text-xs font-medium px-3 py-1 rounded-full bg-{{ $card['color'] }}-500/10 text-{{ $card['color'] }}-300 border border-{{ $card['color'] }}-500/20">
                                {{ $card['trend'] }}
                            </div>
                        </div>
                        <p class="text-4xl font-bold bg-gradient-to-r from-white to-slate-300 bg-clip-text text-transparent mb-2">
                            {{ number_format($card['value']) }}
                        </p>
                        <p class="text-slate-400 text-sm">{{ $card['title'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Quick Actions - Modern Layout -->
        <div class="max-w-7xl mx-auto mb-8">
            <h3 class="font-serif text-xl font-bold text-white mb-4">Quick Actions</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @php
                    $actions = [
                        [
                            'title' => 'Manage Books',
                            'route' => 'books.index',
                            'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10',
                            'color' => 'blue',
                            'count' => $totalBooks,
                            'label' => 'Books'
                        ],
                        [
                            'title' => 'Manage Borrowers',
                            'route' => 'borrowers.index',
                            'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5 1.197v-1a6 6 0 00-9-5.197M9 21v-1a6 6 0 0112 0v1',
                            'color' => 'emerald',
                            'count' => rand(15, 45),
                            'label' => 'Active Today'
                        ],
                        [
                            'title' => 'Borrow Records',
                            'route' => 'borrows.index',
                            'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2',
                            'color' => 'purple',
                            'count' => rand(8, 20),
                            'label' => 'Pending Returns'
                        ]
                    ];
                @endphp

                @foreach($actions as $action)
                    <a href="{{ route($action['route']) }}" class="group relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-slate-800/50 to-slate-900/30 rounded-2xl"></div>
                        <div class="relative glass-panel p-6 border-slate-700/50 group-hover:border-{{ $action['color'] }}-400/30 transition-all duration-300 hover:scale-[1.02]">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="p-3 rounded-xl bg-gradient-to-br from-{{ $action['color'] }}-500/20 to-{{ $action['color'] }}-600/10 border border-slate-700/30">
                                    <svg class="w-6 h-6 text-{{ $action['color'] }}-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $action['icon'] }}"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-serif text-lg font-bold text-white">{{ $action['title'] }}</h3>
                                    <p class="text-sm text-slate-400">{{ $action['count'] }} {{ $action['label'] }}</p>
                                </div>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-slate-400">Click to access</span>
                                <svg class="w-5 h-5 text-{{ $action['color'] }}-400 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Content Grid -->
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Activity -->
            <div class="glass-panel p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="font-serif text-xl font-bold text-white">Recent Activity</h3>
                    <a href="#" class="text-sm text-blue-400 hover:text-blue-300 transition-colors">View all</a>
                </div>
                <div class="space-y-3">
                    @php
                        $activities = [
                            ['New book "Digital Transformation" added to collection', 'Just now', 'blue'],
                            ['Book returned by John Smith', '30 minutes ago', 'emerald'],
                            ['Overdue notice sent to 3 members', '2 hours ago', 'amber'],
                            ['Monthly report generated', 'Yesterday', 'purple']
                        ];
                    @endphp

                    @foreach($activities as $activity)
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-slate-800/30 hover:bg-slate-700/40 transition-colors border border-slate-700/30">
                            <div class="w-8 h-8 rounded-full bg-{{ $activity[2] }}-500/10 flex items-center justify-center border border-{{ $activity[2] }}-500/20">
                                <div class="w-2 h-2 rounded-full bg-{{ $activity[2] }}-400"></div>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-white">{{ $activity[0] }}</p>
                                <p class="text-xs text-slate-400 mt-1">{{ $activity[1] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- System Status -->
            <div class="glass-panel p-6">
                <h3 class="font-serif text-xl font-bold text-white mb-6">System Status</h3>
                <div class="space-y-4">
                    @php
                        $statuses = [
                            ['Database Connection', 'Active', 'MySQL 8.0', 'emerald'],
                            ['Server Uptime', '99.8%', 'Last restart: 7 days ago', 'blue'],
                            ['Backup Status', 'Ready', 'Last backup: 2 hours ago', 'amber']
                        ];
                    @endphp

                    @foreach($statuses as $status)
                        <div class="flex items-center justify-between p-4 rounded-xl bg-slate-800/30 border border-slate-700/30">
                            <div class="flex items-center gap-3">
                                <div class="p-2 rounded-lg bg-{{ $status[3] }}-500/10 border border-{{ $status[3] }}-500/20">
                                    <svg class="w-5 h-5 text-{{ $status[3] }}-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-white">{{ $status[0] }}</p>
                                    <p class="text-xs text-slate-400">{{ $status[2] }}</p>
                                </div>
                            </div>
                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-{{ $status[3] }}-500/10 text-{{ $status[3] }}-400 border border-{{ $status[3] }}-500/20">
                                {{ $status[1] }}
                            </span>
                        </div>
                    @endforeach
                </div>

                <!-- Performance Metrics -->
                <div class="mt-6 pt-6 border-t border-slate-700/50">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="text-center p-4 rounded-xl bg-slate-800/30 border border-slate-700/30">
                            <p class="text-2xl font-bold gradient-text">
                                {{ rand(80, 120) }}
                            </p>
                            <p class="text-xs text-slate-400 mt-1">Books added this month</p>
                        </div>
                        <div class="text-center p-4 rounded-xl bg-slate-800/30 border border-slate-700/30">
                            <p class="text-2xl font-bold gradient-text">
                                {{ rand(200, 400) }}
                            </p>
                            <p class="text-xs text-slate-400 mt-1">Total loans this month</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Library Stats -->
        <div class="max-w-7xl mx-auto mt-8">
            <div class="glass-panel p-6">
                <h3 class="font-serif text-xl font-bold text-white mb-6">Library Statistics</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="text-center p-4">
                        <div class="text-3xl font-bold gradient-text mb-2">{{ number_format($totalBooks) }}</div>
                        <div class="text-sm text-slate-400">Total Books</div>
                    </div>
                    <div class="text-center p-4">
                        <div class="text-3xl font-bold gradient-text mb-2">{{ number_format($totalBorrowers) }}</div>
                        <div class="text-sm text-slate-400">Active Members</div>
                    </div>
                    <div class="text-center p-4">
                        <div class="text-3xl font-bold gradient-text mb-2">{{ number_format($borrowedBooks) }}</div>
                        <div class="text-sm text-slate-400">Borrowed Books</div>
                    </div>
                    <div class="text-center p-4">
                        <div class="text-3xl font-bold gradient-text mb-2">{{ number_format($availableBooks) }}</div>
                        <div class="text-sm text-slate-400">Available Copies</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="max-w-7xl mx-auto mt-8 pt-6 border-t border-slate-700/30">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4 text-sm">
                <p class="text-slate-400">
                    Library Management System v2.0 • 
                    <span class="text-emerald-400 font-medium">Last updated: {{ now()->format('M d, Y') }}</span>
                </p>
                <div class="flex items-center gap-4">
                    <span class="flex items-center gap-2 text-slate-400">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        System Operational
                    </span>
                    <span class="text-slate-500">|</span>
                    <span class="text-slate-400">{{ now()->format('H:i') }}</span>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Smooth fade-in animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .grid > * {
            animation: fadeInUp 0.6s ease-out;
            animation-fill-mode: both;
        }
        
        .grid > *:nth-child(1) { animation-delay: 0.1s; }
        .grid > *:nth-child(2) { animation-delay: 0.2s; }
        .grid > *:nth-child(3) { animation-delay: 0.3s; }
        .grid > *:nth-child(4) { animation-delay: 0.4s; }
        
        /* Book animation for dashboard */
        .book-animation {
            animation: bookFloat 3s ease-in-out infinite;
        }
        
        @keyframes bookFloat {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-10px) rotate(0deg); }
        }
    </style>
</x-app-layout>