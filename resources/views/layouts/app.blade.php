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
                --color-primary: 30, 64, 175;  /* Blue-800 */
                --color-secondary: 109, 40, 217; /* Violet-700 */
                --color-accent: 59, 130, 246;   /* Blue-500 */
            }
            
            body {
                font-feature-settings: 'ss01', 'ss02', 'cv01', 'cv02';
                background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #312e81 100%);
                background-attachment: fixed;
                color: #f1f5f9;
            }
            
            .font-serif {
                font-family: 'Playfair Display', serif;
            }
            
            .font-sans {
                font-family: 'Inter', sans-serif;
            }
            
            ::-webkit-scrollbar {
                width: 10px;
                height: 10px;
            }
            
            ::-webkit-scrollbar-track {
                background: rgba(15, 23, 42, 0.6);
            }
            
            ::-webkit-scrollbar-thumb {
                background: linear-gradient(135deg, rgba(59, 130, 246, 0.5) 0%, rgba(109, 40, 217, 0.5) 100%);
                border-radius: 5px;
                border: 2px solid rgba(15, 23, 42, 0.6);
            }
            
            ::-webkit-scrollbar-thumb:hover {
                background: linear-gradient(135deg, rgba(59, 130, 246, 0.8) 0%, rgba(109, 40, 217, 0.8) 100%);
            }
            
            .glass-panel {
                background: rgba(30, 41, 59, 0.7);
                backdrop-filter: blur(12px) saturate(180%);
                border: 1px solid rgba(255, 255, 255, 0.1);
                box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
                border-radius: 16px;
            }
            
            /* Glass Input - Default (White Text) */
            .glass-input {
                background: rgba(255, 255, 255, 0.05);
                border: 1px solid rgba(255, 255, 255, 0.1);
                color: #ffffff; /* White text */
                transition: all 0.3s ease;
                border-radius: 10px;
            }
            
            .glass-input:focus {
                background: rgba(255, 255, 255, 0.1);
                border-color: var(--color-accent);
                box-shadow: 0 0 0 3px rgba(var(--color-accent), 0.1);
                outline: none;
                color: #ffffff; /* Keep white on focus */
            }
            
            .glass-input::placeholder {
                color: rgba(255, 255, 255, 0.4);
            }
            
            /* Glass Input - Black Text Version */
            .glass-input-black {
                background: rgba(255, 255, 255, 0.9) !important;
                border: 1px solid rgba(0, 0, 0, 0.2) !important;
                color: #000000 !important; /* Black text */
                transition: all 0.3s ease;
                border-radius: 10px;
            }
            
            .glass-input-black:focus {
                background: rgba(255, 255, 255, 0.95) !important;
                border-color: #3b82f6 !important;
                box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2) !important;
                outline: none;
                color: #000000 !important;
            }
            
            .glass-input-black::placeholder {
                color: rgba(0, 0, 0, 0.6) !important;
            }
            
            /* Glass Input - Dark Gray Text Version (Better Readability) */
            .glass-input-dark {
                background: rgba(255, 255, 255, 0.1);
                border: 1px solid rgba(255, 255, 255, 0.2);
                color: #e2e8f0 !important; /* Light gray text */
                transition: all 0.3s ease;
                border-radius: 10px;
            }
            
            .glass-input-dark:focus {
                background: rgba(255, 255, 255, 0.15);
                border-color: var(--color-accent);
                box-shadow: 0 0 0 3px rgba(var(--color-accent), 0.1);
                outline: none;
                color: #ffffff !important; /* White on focus */
            }
            
            .glass-input-dark::placeholder {
                color: rgba(255, 255, 255, 0.5);
            }
            
            .gradient-text {
                background: linear-gradient(135deg, #3b82f6 0%, #7c3aed 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }
            
            .btn-primary {
                background: linear-gradient(135deg, #3b82f6 0%, #7c3aed 100%);
                color: white;
                font-weight: 600;
                border: none;
                border-radius: 10px;
                padding: 12px 24px;
                transition: all 0.3s ease;
            }
            
            .btn-primary:hover {
                transform: translateY(-2px);
                box-shadow: 0 10px 20px rgba(59, 130, 246, 0.3);
            }
            
            .btn-secondary {
                background: rgba(255, 255, 255, 0.1);
                color: white;
                border: 1px solid rgba(255, 255, 255, 0.2);
                border-radius: 10px;
                padding: 12px 24px;
                transition: all 0.3s ease;
            }
            
            .btn-secondary:hover {
                background: rgba(255, 255, 255, 0.15);
                border-color: rgba(255, 255, 255, 0.3);
            }
            
            .stat-card {
                background: rgba(255, 255, 255, 0.05);
                border-radius: 12px;
                padding: 16px;
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.05);
            }
        </style>
    </head>
    <body class="font-sans antialiased min-h-screen">
        <!-- Background Effects -->
        <div class="fixed inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-purple-500/10 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-blue-500/10 rounded-full blur-3xl"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-emerald-500/5 rounded-full blur-3xl"></div>
            
            <!-- Library pattern overlay -->
            <div class="absolute inset-0 opacity-5" style="background-image: url('data:image/svg+xml,<svg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"><path d=\"M12 3H6V57H12V3Z\" fill=\"white\"/><path d=\"M18 3H12V57H18V3Z\" fill=\"white\"/><path d=\"M24 3H18V57H24V3Z\" fill=\"white\"/><path d=\"M30 3H24V57H30V3Z\" fill=\"white\"/><path d=\"M36 3H30V57H36V3Z\" fill=\"white\"/><path d=\"M42 3H36V57H42V3Z\" fill=\"white\"/><path d=\"M48 3H42V57H48V3Z\" fill=\"white\"/><path d=\"M54 3H48V57H54V3Z\" fill=\"white\"/></svg>');"></div>
        </div>

        <!-- Main Content -->
        <div class="relative min-h-screen">
            @include('layouts.navigation')

            <!-- Page Header -->
            @isset($header)
                <header class="relative">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8">
                        <div class="glass-panel overflow-hidden">
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
            <footer class="relative border-t border-slate-800/50 mt-8">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                        <div class="text-sm text-slate-400">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-lg bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                </div>
                                <span class="font-bold text-slate-300">{{ config('app.name', 'Library Management System') }}</span> 
                                <span class="text-slate-500">© {{ date('Y') }} • All rights reserved</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-6 text-sm text-slate-400">
                            <a href="#" class="hover:text-slate-300 transition-colors">Privacy Policy</a>
                            <a href="#" class="hover:text-slate-300 transition-colors">Terms of Service</a>
                            <a href="#" class="hover:text-slate-300 transition-colors">Support</a>
                            <button onclick="toggleTheme()" class="p-2 rounded-lg hover:bg-slate-800/50 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

        <!-- Loading Indicator -->
        <div id="loading-indicator" class="fixed inset-0 bg-slate-900/80 backdrop-blur-sm z-50 hidden">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
                <div class="relative">
                    <div class="w-12 h-12 border-4 border-slate-700 border-t-blue-500 rounded-full animate-spin"></div>
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
                        <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                </div>
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
                
                // Initialize animations
                animateBookshelf();
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
            
            // Bookshelf animation for dashboard cards
            function animateBookshelf() {
                const books = document.querySelectorAll('.book-animation');
                books.forEach((book, index) => {
                    book.style.animationDelay = `${index * 0.2}s`;
                });
            }
            
            // Optional: Auto-switch input class based on theme
            function updateInputClasses() {
                const isDark = document.documentElement.classList.contains('dark');
                const inputs = document.querySelectorAll('.glass-input');
                
                if (isDark) {
                    // In dark mode, you might want darker text for better readability
                    inputs.forEach(input => {
                        if (!input.classList.contains('glass-input-black') && 
                            !input.classList.contains('glass-input-dark')) {
                            input.classList.add('glass-input-dark');
                        }
                    });
                }
            }
            
            // Run on load and theme change
            document.addEventListener('DOMContentLoaded', updateInputClasses);
            document.addEventListener('themeChange', updateInputClasses);
        </script>
    </body>
</html>