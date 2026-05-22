<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SEIN HELIOS') }} - Facilities</title>

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
                --fg-accent: #e8e8e8;
                --accent: #c9a77c;
                --accent-light: #e8d5a7;
                --accent-dark: #8b6f3a;
                --accent-glow: rgba(201, 167, 124, 0.3);
                --card: #1a1a1a;
                --border: #2a2a2a;
                --border-accent: rgba(201, 167, 124, 0.2);
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
                overflow-x: hidden;
                position: relative;
            }

            .font-display {
                font-family: 'Cormorant Garamond', serif;
            }

            html {
                scroll-behavior: smooth;
            }

            .bg-pattern {
                position: fixed;
                inset: 0;
                background-image: radial-gradient(ellipse 80% 50% at 50% -20%, rgba(201, 167, 124, 0.08), transparent), radial-gradient(ellipse 60% 40% at 100% 100%, rgba(201, 167, 124, 0.05), transparent);
                pointer-events: none;
                z-index: 0;
            }

            .section {
                position: relative;
                z-index: 1;
                padding: 120px 0;
            }

            .section-header {
                text-align: center;
                margin-bottom: 80px;
            }

            .section-label {
                display: inline-block;
                font-size: 11px;
                font-weight: 500;
                letter-spacing: 0.3em;
                text-transform: uppercase;
                color: var(--accent);
                margin-bottom: 20px;
            }

            .section-title {
                font-family: 'Cormorant Garamond', serif;
                font-size: clamp(36px, 6vw, 56px);
                font-weight: 600;
                margin-bottom: 24px;
            }

            .section-text {
                color: var(--fg-muted);
                font-size: 16px;
                max-width: 600px;
                margin: 0 auto;
                line-height: 1.8;
            }

            .luxury-card {
                background: linear-gradient(135deg, var(--card) 0%, rgba(26, 26, 26, 0.9) 100%);
                border: 1px solid var(--border);
                padding: 56px;
                position: relative;
                overflow: hidden;
                transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
                backdrop-filter: blur(20px);
                border-radius: 20px;
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            }

            .luxury-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 2px;
                background: linear-gradient(90deg, transparent 0%, var(--accent) 50%, transparent 100%);
                opacity: 0;
                transition: all 0.6s ease;
                transform: scaleX(0);
                transform-origin: center;
            }

            .luxury-card::after {
                content: '';
                position: absolute;
                inset: 0;
                background: linear-gradient(135deg, rgba(232, 213, 183, 0.03) 0%, transparent 50%);
                opacity: 0;
                transition: opacity 0.6s ease;
                border-radius: 20px;
            }

            .luxury-card:hover {
                border-color: var(--border-accent);
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4), 0 0 40px var(--accent-glow);
                transform: translateY(-8px) scale(1.02);
            }

            .luxury-card:hover::before {
                opacity: 1;
                transform: scaleX(1);
            }

            .luxury-card:hover::after {
                opacity: 1;
            }

            .card-number {
                font-family: 'Cormorant Garamond', serif;
                font-size: 56px;
                font-weight: 300;
                color: var(--accent);
                opacity: 0.4;
                line-height: 1;
                margin-bottom: 24px;
                transition: all 0.4s ease;
            }

            .luxury-card:hover .card-number {
                opacity: 0.8;
                transform: scale(1.1);
            }

            .card-title {
                font-family: 'Cormorant Garamond', serif;
                font-size: 32px;
                font-weight: 600;
                margin: 0 0 20px;
                color: var(--fg);
                transition: color 0.4s ease;
            }

            .luxury-card:hover .card-title {
                color: var(--accent);
            }

            .card-text {
                color: var(--fg-muted);
                line-height: 1.8;
                font-size: 16px;
                transition: color 0.4s ease;
            }

            .luxury-card:hover .card-text {
                color: var(--fg-accent);
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .fade-in {
                animation: fadeIn 0.6s ease-out forwards;
            }

            @media (max-width: 768px) {
                .section {
                    padding: 60px 0;
                }

                .section-header {
                    margin-bottom: 40px;
                }

                .luxury-card {
                    padding: 40px;
                }
            }
        </style>
    </head>
    <body>
        <div class="bg-pattern"></div>
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
                            <a href="{{ route('facilities') }}" class="nav-link text-sm font-medium text-[#f5f5f0] transition-colors duration-300">FACILITIES</a>
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
            <div class="pt-20">
                <div class="max-w-7xl mx-auto px-6 py-8">
                    <!-- Curated Experiences Section -->
                    <section class="section">
                        <div class="max-w-6xl mx-auto px-6">
                            <div class="section-header">
                                <span class="section-label">Our Commitment</span>
                                <h2 class="section-title">Curated Experiences</h2>
                                <p class="section-text">
                                    Every detail has been thoughtfully considered to create an environment where you can truly unwind and rejuvenate.
                                </p>
                            </div>

                            <div class="grid md:grid-cols-3 gap-8">
                                <article class="luxury-card fade-in">
                                    <div class="card-number">01</div>
                                    <h3 class="card-title">Suites & Rooms</h3>
                                    <p class="card-text">
                                        Each room is individually designed with custom furnishings, premium linens, and cutting-edge amenities to ensure your utmost comfort.
                                    </p>
                                </article>

                                <article class="luxury-card fade-in" style="transition-delay: 0.2s">
                                    <div class="card-number">02</div>
                                    <h3 class="card-title">Dining</h3>
                                    <p class="card-text">
                                        Our award-winning restaurant features seasonal ingredients and innovative cuisine crafted by renowned culinary artists.
                                    </p>
                                </article>

                                <article class="luxury-card fade-in" style="transition-delay: 0.4s">
                                    <div class="card-number">03</div>
                                    <h3 class="card-title">Wellness</h3>
                                    <p class="card-text">
                                        The spa sanctuary offers holistic treatments, hydrotherapy experiences, and a state-of-the-art fitness center.
                                    </p>
                                </article>
                            </div>
                        </div>
                    </section>
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
