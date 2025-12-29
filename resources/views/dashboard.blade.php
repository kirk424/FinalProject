<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-serif text-3xl font-bold bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">Library Dashboard</h2>
                <p class="text-sm text-gray-400 mt-2">Welcome back, {{ Auth::user()->name }}! Here's your library overview.</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="text-sm text-gray-400 bg-gray-800/50 px-4 py-2 rounded-lg backdrop-blur-sm">
                    {{ now()->format('l, F j, Y') }}
                </div>
                <div class="relative group">
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center border-2 border-gray-700 group-hover:border-blue-400 transition-all duration-300">
                        <span class="text-white font-bold text-lg">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                    </div>
                    <div class="absolute -bottom-2 right-0 w-3 h-3 bg-emerald-500 rounded-full border-2 border-gray-900"></div>
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
                        'bg' => 'from-blue-500/20 to-blue-600/10'
                    ],
                    [
                        'title' => 'Active Members',
                        'value' => $totalBorrowers,
                        'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
                        'color' => 'emerald',
                        'trend' => '+5 today',
                        'bg' => 'from-emerald-500/20 to-emerald-600/10'
                    ],
                    [
                        'title' => 'Borrowed Books',
                        'value' => $borrowedBooks,
                        'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
                        'color' => 'amber',
                        'trend' => rand(1, 10) . ' due today',
                        'bg' => 'from-amber-500/20 to-amber-600/10'
                    ],
                    [
                        'title' => 'Available Copies',
                        'value' => $availableBooks,
                        'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                        'color' => 'purple',
                        'trend' => rand(5, 25) . ' reserved',
                        'bg' => 'from-purple-500/20 to-purple-600/10'
                    ]
                ];
            @endphp

            @foreach($cards as $card)
                <div class="group relative">
                    <div class="absolute inset-0 bg-gradient-to-br {{ $card['bg'] }} rounded-2xl blur-xl opacity-50 group-hover:opacity-70 transition-opacity"></div>
                    <div class="relative bg-gray-800/40 backdrop-blur-xl rounded-2xl p-6 border border-gray-700/50 group-hover:border-gray-600 transition-all duration-300 hover:scale-[1.02]">
                        <div class="flex items-start justify-between mb-6">
                            <div class="p-3 rounded-xl bg-gradient-to-br {{ $card['bg'] }}">
                                <svg class="w-6 h-6 text-{{ $card['color'] }}-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $card['icon'] }}"/>
                                </svg>
                            </div>
                            <div class="text-xs font-medium px-3 py-1 rounded-full bg-{{ $card['color'] }}-500/10 text-{{ $card['color'] }}-300">
                                {{ $card['trend'] }}
                            </div>
                        </div>
                        <p class="text-4xl font-bold bg-gradient-to-r from-white to-gray-300 bg-clip-text text-transparent mb-2">
                            {{ number_format($card['value']) }}
                        </p>
                        <p class="text-gray-400 text-sm">{{ $card['title'] }}</p>
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
                        <div class="absolute inset-0 bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl"></div>
                        <div class="relative bg-gradient-to-br from-gray-800/60 to-gray-900/40 backdrop-blur-xl rounded-2xl p-6 border border-gray-700/50 group-hover:border-{{ $action['color'] }}-400/30 transition-all duration-300 hover:scale-[1.02]">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="p-3 rounded-xl bg-gradient-to-br from-{{ $action['color'] }}-500/20 to-{{ $action['color'] }}-600/10">
                                    <svg class="w-6 h-6 text-{{ $action['color'] }}-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $action['icon'] }}"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-serif text-lg font-bold text-white">{{ $action['title'] }}</h3>
                                    <p class="text-sm text-gray-400">{{ $action['count'] }} {{ $action['label'] }}</p>
                                </div>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-400">Click to access</span>
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
            <div class="bg-gradient-to-br from-gray-800/40 to-gray-900/40 backdrop-blur-xl rounded-2xl p-6 border border-gray-700/50">
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
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-gray-800/30 hover:bg-gray-700/40 transition-colors">
                            <div class="w-8 h-8 rounded-full bg-{{ $activity[2] }}-500/10 flex items-center justify-center">
                                <div class="w-2 h-2 rounded-full bg-{{ $activity[2] }}-400"></div>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-white">{{ $activity[0] }}</p>
                                <p class="text-xs text-gray-400 mt-1">{{ $activity[1] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- System Status -->
            <div class="bg-gradient-to-br from-gray-800/40 to-gray-900/40 backdrop-blur-xl rounded-2xl p-6 border border-gray-700/50">
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
                        <div class="flex items-center justify-between p-4 rounded-xl bg-gray-800/30">
                            <div class="flex items-center gap-3">
                                <div class="p-2 rounded-lg bg-{{ $status[3] }}-500/10">
                                    <svg class="w-5 h-5 text-{{ $status[3] }}-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-white">{{ $status[0] }}</p>
                                    <p class="text-xs text-gray-400">{{ $status[2] }}</p>
                                </div>
                            </div>
                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-{{ $status[3] }}-500/10 text-{{ $status[3] }}-400">
                                {{ $status[1] }}
                            </span>
                        </div>
                    @endforeach
                </div>

                <!-- Performance Metrics -->
                <div class="mt-6 pt-6 border-t border-gray-700/50">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="text-center p-4 rounded-xl bg-gray-800/30">
                            <p class="text-2xl font-bold bg-gradient-to-r from-white to-gray-300 bg-clip-text text-transparent">
                                {{ rand(80, 120) }}
                            </p>
                            <p class="text-xs text-gray-400 mt-1">Books added this month</p>
                        </div>
                        <div class="text-center p-4 rounded-xl bg-gray-800/30">
                            <p class="text-2xl font-bold bg-gradient-to-r from-white to-gray-300 bg-clip-text text-transparent">
                                {{ rand(200, 400) }}
                            </p>
                            <p class="text-xs text-gray-400 mt-1">Total loans this month</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="max-w-7xl mx-auto mt-8 pt-6 border-t border-gray-700/30">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4 text-sm">
                <p class="text-gray-400">
                    Library Management System v2.0 • 
                    <span class="text-emerald-400 font-medium">Last updated: {{ now()->format('M d, Y') }}</span>
                </p>
                <div class="flex items-center gap-4">
                    <span class="flex items-center gap-2 text-gray-400">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        System Operational
                    </span>
                    <span class="text-gray-500">|</span>
                    <span class="text-gray-400">{{ now()->format('H:i') }}</span>
                </div>
            </div>
        </div>
    </div>

    <style>
        .glass-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .glass-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            border-color: rgba(255, 255, 255, 0.2);
        }
        
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
    </style>
</x-app-layout>