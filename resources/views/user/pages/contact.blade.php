<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SEIN HELIOS') }} - Contact Us</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            :root {
                --bg: #0f0f0f;
                --bg-elevated: #1a1a1a;
                --fg: #f5f5f0;
                --fg-muted: #8a8a8a;
                --accent: #c9a77c;
                --accent-light: #e8d5a7;
                --accent-dark: #8b6f3a;
                --card: #1a1a1a;
                --border: #2a2a2a;
            }

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'Montserrat', sans-serif;
                background: var(--bg);
                color: var(--fg);
                min-height: 100vh;
            }

            .font-display {
                font-family: 'Cormorant Garamond', serif;
            }

            html {
                scroll-behavior: smooth;
            }
        </style>
    </head>
    <body>
        <div class="min-h-screen bg-[#0f0f0f]">
            <!-- Navigation -->
            <nav class="fixed top-0 left-0 right-0 z-50 bg-[#0f0f0f]/80 backdrop-blur-xl border-b border-[#2a2a2a]">
                <div class="max-w-7xl mx-auto px-6">
                    <div class="flex items-center justify-between h-16 lg:h-20">
                        <!-- Logo -->
                        <a href="/" class="flex items-center gap-3">
                            <img src="{{ asset('images/logo.svg') }}" alt="SEIN HELIOS" class="h-8 lg:h-10 w-auto">
                            <span class="font-display text-lg lg:text-xl font-semibold tracking-wider" style="color: var(--accent);">SEIN HELIOS</span>
                        </a>

                        <!-- Site Navigation -->
                        <div class="flex flex-wrap items-center justify-end gap-4 lg:gap-6">
                            <a href="{{ route('home') }}" class="nav-link text-sm font-medium text-[#8a8a8a] hover:text-[#f5f5f0] transition-colors duration-300">HOME</a>
                            <a href="{{ route('rooms.browse') }}" class="nav-link text-sm font-medium text-[#8a8a8a] hover:text-[#f5f5f0] transition-colors duration-300">ROOMS</a>
                            <a href="{{ route('facilities') }}" class="nav-link text-sm font-medium text-[#8a8a8a] hover:text-[#f5f5f0] transition-colors duration-300">FACILITIES</a>
                            <a href="{{ route('about') }}" class="nav-link text-sm font-medium text-[#8a8a8a] hover:text-[#f5f5f0] transition-colors duration-300">ABOUT US</a>
                            @guest
                                <a href="#modal-login" class="px-5 py-2.5 bg-[#c9a77c] text-[#0f0f0f] text-sm font-medium rounded-lg hover:bg-[#e8d5a7] transition-colors duration-300">
                                    Sign In
                                </a>
                            @else
                                <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 bg-[#c9a77c] text-[#0f0f0f] text-sm font-medium rounded-lg hover:bg-[#e8d5a7] transition-colors duration-300">
                                    Dashboard
                                </a>
                            @endguest
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Main Content -->
            <div class="pt-24">
                <div class="max-w-7xl mx-auto px-6 py-8">
                    <button onclick="history.back()" class="inline-flex items-center gap-2 px-4 py-2 bg-[#0f0f0f] border border-[#2a2a2a] text-[#f5f5f0] rounded-xl hover:border-[#c9a77c] hover:bg-[#c9a77c]/10 transition-colors duration-300 text-sm font-medium mb-6">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Go Back
                    </button>

                    <div class="mb-8">
                        <h1 class="font-serif text-3xl text-[#f5f5f0]">Contact Us</h1>
                        <p class="text-[#8a8a8a] text-sm mt-1">Reach out to our concierge team for reservations, guest services, or enquiries.</p>
                    </div>

                    <div class="grid gap-6 lg:grid-cols-2">
                        <div class="bg-[#1a1a1a] border border-[#2a2a2a] rounded-lg p-6">
                            <h2 class="font-serif text-xl text-[#f5f5f0] mb-3">Guest Services</h2>
                            <p class="text-[#8a8a8a] text-sm">Email: <a href="mailto:hello@seinhotel.com" class="text-[#c9a77c] hover:text-[#e8d5a7]">hello@seinhotel.com</a></p>
                            <p class="text-[#8a8a8a] text-sm">Phone: <a href="tel:+1234567890" class="text-[#c9a77c] hover:text-[#e8d5a7]">+1 (234) 567-890</a></p>
                            <p class="text-[#8a8a8a] text-sm mt-4">Our concierge team is available 24/7 to assist with bookings, requests, and guest needs.</p>
                        </div>
                        <div class="bg-[#1a1a1a] border border-[#2a2a2a] rounded-lg p-6">
                            <h2 class="font-serif text-xl text-[#f5f5f0] mb-3">Location</h2>
                            <p class="text-[#8a8a8a] text-sm">123 Luxury Avenue, City Center</p>
                            <p class="text-[#8a8a8a] text-sm">Open daily for exclusive stays and experiences.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            (function () {
                const homeUrl = '{{ route('home') }}';
                const homePath = new URL(homeUrl, window.location.origin).pathname.replace(/\/$/, '') || '/';
                const originalBack = window.history.back.bind(window.history);

                const isHomeReferrer = () => {
                    if (!document.referrer) {
                        return false;
                    }
                    try {
                        const ref = new URL(document.referrer);
                        if (ref.origin !== window.location.origin) {
                            return false;
                        }
                        const path = ref.pathname.replace(/\/$/, '') || '/';
                        return path === homePath || path === '/';
                    } catch (error) {
                        return false;
                    }
                };

                window.history.back = function () {
                    if (isHomeReferrer()) {
                        window.location.href = homeUrl;
                        return;
                    }
                    originalBack();
                };
            })();
        </script>

        <!-- Auth Modals -->
        @include('components.auth-modals')
    </body>
</html>
