<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Library Management System - {{ $title ?? 'Login' }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            .font-serif { font-family: 'Merriweather', serif; }
            /* Full page blue gradient background */
            .full-page-gradient {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                min-height: 100vh;
            }
            .dark .full-page-gradient {
                background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%);
            }
            .glass-card {
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }
            .glass-input {
                background: rgba(255, 255, 255, 0.1);
                border: 1px solid rgba(255, 255, 255, 0.2);
                color: white;
            }
            .glass-input::placeholder {
                color: rgba(255, 255, 255, 0.6);
            }
            .glass-input:focus {
                background: rgba(255, 255, 255, 0.15);
                border-color: rgba(255, 255, 255, 0.3);
                outline: none;
                box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.1);
            }
        </style>
    </head>
    <body class="full-page-gradient text-white flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
        <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6">
            <nav class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center border border-white/30">
                        <span class="text-white font-bold">LMS</span>
                    </div>
                    <span class="font-serif font-bold text-lg text-white">Library<span class="text-blue-200">System</span></span>
                </div>
                <div class="flex items-center gap-4">
                    <a href="/" class="inline-block px-5 py-1.5 text-white hover:bg-white/10 rounded-sm text-sm leading-normal transition-colors border border-white/20">
                        Home
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="inline-block px-5 py-1.5 bg-white text-blue-600 hover:bg-blue-50 rounded-sm text-sm leading-normal transition-colors">
                            Join Library
                        </a>
                    @endif
                </div>
            </nav>
        </header>

        <div class="w-full lg:max-w-4xl max-w-[335px]">
            <div class="glass-card shadow-lg rounded-lg overflow-hidden">
                <div class="flex flex-col lg:flex-row">
                    <!-- Left side - Library illustration -->
                    <div class="lg:w-1/3 bg-white/10 p-8 flex items-center justify-center">
                        <div class="text-center">
                            <div class="w-20 h-20 rounded-full bg-white/20 flex items-center justify-center mx-auto mb-4 border border-white/30">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <h3 class="font-serif text-xl font-bold text-white mb-2">Librarian Access</h3>
                            <p class="text-sm text-white/80">Secure login for library staff</p>
                            
                            <!-- Mini bookshelf -->
                            <div class="mt-6 relative h-20">
                                <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-32 h-12 bg-amber-800/70 backdrop-blur-sm rounded-t-lg border border-amber-700/50">
                                    <div class="absolute -top-6 left-2 flex space-x-1">
                                        <div class="w-6 h-12 bg-red-600/80 rounded-sm shadow-md transform -rotate-2"></div>
                                        <div class="w-6 h-12 bg-blue-600/80 rounded-sm shadow-md"></div>
                                        <div class="w-6 h-12 bg-green-600/80 rounded-sm shadow-md transform rotate-2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right side - Form -->
                    <div class="lg:w-2/3 p-8">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>

        <footer class="w-full lg:max-w-4xl max-w-[335px] mt-8 text-center text-sm text-white/80">
            <p>© {{ date('Y') }} Library Management System. All rights reserved.</p>
            <div class="mt-2 flex justify-center gap-4">
                <a href="/about" class="hover:text-white transition-colors">About</a>
                <a href="/contact" class="hover:text-white transition-colors">Contact</a>
                <a href="/help" class="hover:text-white transition-colors">Help</a>
                <a href="/privacy" class="hover:text-white transition-colors">Privacy</a>
            </div>
        </footer>
    </body>
</html>