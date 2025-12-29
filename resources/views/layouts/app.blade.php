<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Library Management System') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|playfair-display:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Favicon -->
        <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>📚</text></svg>">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Theme Script -->
        <script>
            if (localStorage.getItem('dark-mode') === 'false' || (!('dark-mode' in localStorage) && window.matchMedia('(prefers-color-scheme: light)').matches)) {
                document.documentElement.classList.remove('dark');
            } else {
                document.documentElement.classList.add('dark');
            }
        </script>

        <style>
            :root {
                --color-primary: 59 130 246;
                --color-secondary: 139 92 246;
            }
            
            body {
                font-feature-settings: 'ss01', 'ss02', 'cv01', 'cv02';
            }
            
            ::-webkit-scrollbar {
                width: 10px;
                height: 10px;
            }
            
            ::-webkit-scrollbar-track {
                background: rgba(0, 0, 0, 0.2);
            }
            
            ::-webkit-scrollbar-thumb {
                background: rgba(255, 255, 255, 0.1);
                border-radius: 5px;
            }
            
            ::-webkit-scrollbar-thumb:hover {
                background: rgba(255, 255, 255, 0.2);
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-gradient-to-br from-gray-900 via-gray-900 to-gray-800 min-h-screen text-gray-100">
        <!-- Background Effects -->
        <div class="fixed inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-purple-500/10 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-blue-500/10 rounded-full blur-3xl"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-emerald-500/5 rounded-full blur-3xl"></div>
        </div>

        <!-- Main Content -->
        <div class="relative min-h-screen">
            @include('layouts.navigation')

            <!-- Page Header -->
            @isset($header)
                <header class="relative">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8">
                        <div class="bg-gradient-to-br from-gray-800/40 to-gray-900/40 backdrop-blur-xl rounded-2xl border border-gray-700/50 shadow-2xl">
                            <div class="px-8 py-8">
                                {{ $header }}
                            </div>
                        </div>
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="relative">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    {{ $slot }}
                </div>
            </main>

            <!-- Footer -->
            <footer class="relative border-t border-gray-800/50 mt-8">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                        <div class="text-sm text-gray-400">
                            <span class="font-semibold text-gray-300">{{ config('app.name', 'Library Management System') }}</span> 
                            © {{ date('Y') }} • All rights reserved
                        </div>
                        <div class="flex items-center gap-6 text-sm text-gray-400">
                            <a href="#" class="hover:text-gray-300 transition-colors">Privacy Policy</a>
                            <a href="#" class="hover:text-gray-300 transition-colors">Terms of Service</a>
                            <a href="#" class="hover:text-gray-300 transition-colors">Support</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

        <!-- Loading Indicator -->
        <div id="loading-indicator" class="fixed inset-0 bg-gray-900/80 backdrop-blur-sm z-50 hidden">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
                <div class="w-12 h-12 border-4 border-gray-700 border-t-blue-500 rounded-full animate-spin"></div>
            </div>
        </div>

        <script>
            // Smooth page transitions
            document.addEventListener('DOMContentLoaded', () => {
                // Form submission loading
                document.querySelectorAll('form').forEach(form => {
                    form.addEventListener('submit', () => {
                        document.getElementById('loading-indicator').classList.remove('hidden');
                    });
                });

                // Link click loading for non-Vite handled navigation
                document.querySelectorAll('a:not([target="_blank"])').forEach(link => {
                    if (link.href && !link.href.includes('javascript:') && 
                        !link.href.startsWith('#') && 
                        !link.href.includes('mailto:') && 
                        !link.href.includes('tel:')) {
                        link.addEventListener('click', (e) => {
                            if (!e.metaKey && !e.ctrlKey) {
                                document.getElementById('loading-indicator').classList.remove('hidden');
                                setTimeout(() => {
                                    document.getElementById('loading-indicator').classList.add('hidden');
                                }, 1000);
                            }
                        });
                    }
                });

                // Remove loading indicator after page load
                setTimeout(() => {
                    document.getElementById('loading-indicator').classList.add('hidden');
                }, 500);

                // Add subtle animation to page content
                const mainContent = document.querySelector('main > div');
                if (mainContent) {
                    mainContent.style.opacity = '0';
                    mainContent.style.transform = 'translateY(10px)';
                    mainContent.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
                    
                    setTimeout(() => {
                        mainContent.style.opacity = '1';
                        mainContent.style.transform = 'translateY(0)';
                    }, 100);
                }
            });

            // Theme toggle
            function toggleTheme() {
                const html = document.documentElement;
                if (html.classList.contains('dark')) {
                    html.classList.remove('dark');
                    localStorage.setItem('dark-mode', 'false');
                } else {
                    html.classList.add('dark');
                    localStorage.setItem('dark-mode', 'true');
                }
            }
        </script>
    </body>
</html>