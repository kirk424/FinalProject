<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Library Management System - {{ $title ?? 'Login' }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700|inter:400,500,600" rel="stylesheet" />
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            :root {
                --primary: #1a365d;
                --secondary: #2d3748;
                --accent: #4299e1;
                --glass-bg: rgba(26, 54, 93, 0.7);
                --glass-border: rgba(255, 255, 255, 0.1);
            }
            
            body {
                font-family: 'Inter', sans-serif;
                background: linear-gradient(135deg, #0f172a 0%, #1a365d 50%, #2d3748 100%);
                min-height: 100vh;
                color: #e2e8f0;
            }
            
            .font-serif {
                font-family: 'Poppins', sans-serif;
            }
            
            .glass-panel {
                background: var(--glass-bg);
                backdrop-filter: blur(12px) saturate(180%);
                border: 1px solid var(--glass-border);
                box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
                border-radius: 16px;
            }
            
            .glass-input {
                background: rgba(255, 255, 255, 0.05);
                border: 1px solid rgba(255, 255, 255, 0.1);
                color: white;
                transition: all 0.3s ease;
                border-radius: 10px;
            }
            
            .glass-input:focus {
                background: rgba(255, 255, 255, 0.1);
                border-color: var(--accent);
                box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.1);
                outline: none;
            }
            
            .glass-input::placeholder {
                color: rgba(255, 255, 255, 0.4);
            }
            
            .btn-primary {
                background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%);
                color: white;
                font-weight: 600;
                border: none;
                border-radius: 10px;
                padding: 12px 24px;
                transition: all 0.3s ease;
            }
            
            .btn-primary:hover {
                background: linear-gradient(135deg, #3182ce 0%, #2b6cb0 100%);
                transform: translateY(-2px);
                box-shadow: 0 10px 20px rgba(66, 153, 225, 0.2);
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
            
            .gradient-text {
                background: linear-gradient(135deg, #4299e1 0%, #9f7aea 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }
            
            .library-icon {
                width: 80px;
                height: 80px;
                background: linear-gradient(135deg, #4299e1 0%, #9f7aea 100%);
                border-radius: 20px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 20px;
            }
            
            .bookshelf {
                position: relative;
                width: 160px;
                height: 80px;
                margin: 40px auto 0;
            }
            
            .bookshelf-shelf {
                position: absolute;
                bottom: 0;
                width: 100%;
                height: 12px;
                background: linear-gradient(135deg, #744210 0%, #975a16 100%);
                border-radius: 6px;
            }
            
            .bookshelf-books {
                position: absolute;
                bottom: 12px;
                left: 0;
                display: flex;
                gap: 6px;
                padding: 0 10px;
            }
            
            .book {
                width: 20px;
                height: 60px;
                border-radius: 4px;
                transform: rotate(0deg);
                animation: float 3s ease-in-out infinite;
            }
            
            @keyframes float {
                0%, 100% { transform: translateY(0) rotate(0deg); }
                50% { transform: translateY(-10px) rotate(0deg); }
            }
            
            .book:nth-child(1) {
                background: linear-gradient(135deg, #e53e3e 0%, #c53030 100%);
                animation-delay: 0s;
            }
            
            .book:nth-child(2) {
                background: linear-gradient(135deg, #38b2ac 0%, #319795 100%);
                animation-delay: 0.5s;
            }
            
            .book:nth-child(3) {
                background: linear-gradient(135deg, #d69e2e 0%, #b7791f 100%);
                animation-delay: 1s;
            }
            
            .book:nth-child(4) {
                background: linear-gradient(135deg, #805ad5 0%, #6b46c1 100%);
                animation-delay: 1.5s;
            }
        </style>
    </head>
    <body class="flex flex-col min-h-screen p-4 md:p-6 lg:p-8">
        <header class="w-full max-w-6xl mx-auto mb-8">
            <nav class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="library-icon">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <div>
                        <span class="font-serif text-2xl font-bold text-white">Library</span>
                        <span class="font-serif text-2xl font-bold gradient-text">System</span>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <a href="/" class="btn-secondary text-sm px-4 py-2">
                        Home
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-primary text-sm px-4 py-2">
                            Join Library
                        </a>
                    @endif
                </div>
            </nav>
        </header>

        <main class="flex-1 w-full max-w-6xl mx-auto">
            <div class="glass-panel overflow-hidden">
                <div class="flex flex-col lg:flex-row">
                    <!-- Left side - Library illustration -->
                    <div class="lg:w-2/5 bg-gradient-to-br from-blue-900/30 to-purple-900/30 p-8 md:p-12">
                        <div class="text-center h-full flex flex-col justify-center">
                            <div class="library-icon">
                                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <h3 class="font-serif text-2xl font-bold text-white mb-3">Librarian Access</h3>
                            <p class="text-gray-300 mb-8">Secure login for library staff and members</p>
                            
                            <!-- Animated bookshelf -->
                            <div class="bookshelf">
                                <div class="bookshelf-books">
                                    <div class="book"></div>
                                    <div class="book"></div>
                                    <div class="book"></div>
                                    <div class="book"></div>
                                    <div class="book"></div>
                                </div>
                                <div class="bookshelf-shelf"></div>
                            </div>
                            
                            <!-- Stats -->
                            <div class="grid grid-cols-3 gap-4 mt-12">
                                <div class="stat-card">
                                    <div class="text-2xl font-bold gradient-text">50K+</div>
                                    <div class="text-sm text-gray-400">Books</div>
                                </div>
                                <div class="stat-card">
                                    <div class="text-2xl font-bold gradient-text">5K+</div>
                                    <div class="text-sm text-gray-400">Members</div>
                                </div>
                                <div class="stat-card">
                                    <div class="text-2xl font-bold gradient-text">99%</div>
                                    <div class="text-sm text-gray-400">Uptime</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right side - Form -->
                    <div class="lg:w-3/5 p-8 md:p-12">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </main>

        <footer class="w-full max-w-6xl mx-auto mt-8 text-center">
            <p class="text-gray-400 text-sm">© {{ date('Y') }} Library Management System. All rights reserved.</p>
            <div class="mt-4 flex justify-center gap-6">
                <a href="/about" class="text-gray-400 hover:text-white transition-colors text-sm">About</a>
                <a href="/contact" class="text-gray-400 hover:text-white transition-colors text-sm">Contact</a>
                <a href="/help" class="text-gray-400 hover:text-white transition-colors text-sm">Help</a>
                <a href="/privacy" class="text-gray-400 hover:text-white transition-colors text-sm">Privacy</a>
            </div>
        </footer>
    </body>
</html>