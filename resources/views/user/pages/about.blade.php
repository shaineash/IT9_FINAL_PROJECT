<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SEIN HELIOS') }} - About</title>

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
                --copy: #e6e1d9;
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

            /* ABOUT page editorial column */
            .about-editorial {
                max-width: 62ch;
                margin: 0 auto;
                font-family: 'Cormorant Garamond', serif;
                color: var(--copy);
                line-height: 1.9;
                font-size: 1.125rem;
                letter-spacing: 0.0025em;
                text-align: center;
            }

            .about-editorial p {
                margin-top: 1.5rem;
                margin-bottom: 0;
                color: var(--copy);
            }

            .about-editorial .lead {
                font-size: clamp(1.45rem, 2vw, 1.85rem);
                color: var(--fg);
                line-height: 1.75;
                margin-bottom: 1.3rem;
                letter-spacing: 0.01em;
            }

            .brand {
                color: var(--accent-light);
                font-weight: 600;
                letter-spacing: 0.03em;
                text-shadow: 0 1px 6px rgba(201,167,124,0.18);
            }

            .page-intro {
                max-width: 52rem;
                margin: 0 auto;
                padding-bottom: 1.75rem;
            }

            .page-intro h1 {
                font-size: clamp(2.75rem, 5vw, 4.5rem);
                line-height: 1.03;
                letter-spacing: -0.04em;
                color: #f4efe7;
            }

            .page-intro p {
                color: #d9d3c7;
                line-height: 1.85;
                margin-top: 1.25rem;
            }

            .about-panel {
                background: rgba(255,255,255,0.02);
                border: 1px solid rgba(201,167,124,0.12);
                box-shadow: 0 32px 80px rgba(0, 0, 0, 0.22);
                border-radius: 2rem;
                padding: 2.5rem;
                backdrop-filter: blur(11px);
            }

            .about-grid {
                display: grid;
                grid-template-columns: 1.45fr 0.95fr;
                gap: 3rem;
                align-items: start;
            }

            .fade-in {
                opacity: 0;
                transform: translateY(24px);
                transition: opacity 0.8s ease, transform 0.8s ease;
            }

            .fade-in.visible {
                opacity: 1;
                transform: translateY(0);
            }

            .contact-card {
                background: rgba(15,15,15,0.82);
                border: 1px solid rgba(201,167,124,0.14);
                box-shadow: 0 18px 40px rgba(0, 0, 0, 0.22);
                padding: 1.75rem;
                border-radius: 1.75rem;
            }

            .quote-card {
                background: rgba(20,20,20,0.95);
                border: 1px solid rgba(201,167,124,0.12);
                border-radius: 1.75rem;
                padding: 2rem;
                box-shadow: 0 18px 40px rgba(0, 0, 0, 0.18);
                text-align: center;
            }

            @media (max-width: 1024px) {
                .about-grid {
                    grid-template-columns: 1fr;
                }

                .about-panel {
                    padding: 2rem;
                }
            }

            @media (max-width: 640px) {
                .page-intro h1 {
                    font-size: 2.6rem;
                }

                .about-editorial {
                    max-width: 100%;
                }
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
                            <a href="{{ route('about') }}" class="nav-link text-sm font-medium text-[#f5f5f0] transition-colors duration-300">ABOUT US</a>
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
                    <div class="p-6 lg:p-10 fade-in">
                        <div class="max-w-5xl mx-auto">
                            <div class="mb-12 text-center page-intro">
                                <p class="text-xs uppercase tracking-[0.35em] text-[#c9a77c] mb-4">About SEIN HELIOS</p>
                                <h1 class="font-display font-semibold tracking-tight">A sanctuary of refined comfort by Margarita Bay</h1>
                                <p class="mt-4">Discover a story of exquisite design, attentive service, and unforgettable island escapes at SEIN HELIOS.</p>
                            </div>

                            <div class="about-panel about-grid">
                                <div class="about-editorial">
                                    <p class="lead">
                                        Welcome to <span class="brand">SEIN HELIOS</span>, where luxury meets serenity along the breathtaking shores of Margarita Bay in Davao City. Inspired by the brilliance and warmth of the sun, <span class="brand">SEIN HELIOS</span> was created to offer guests an experience defined by elegance, comfort, and exceptional hospitality.
                                    </p>

                                    <p>
                                        From exquisitely designed rooms and refined interiors to personalized services crafted with care, every detail is thoughtfully curated to provide a stay that feels both sophisticated and relaxing. Awaken to sweeping views of the beach and neighboring islands, unwind in an atmosphere of tranquil refinement, and experience world-class comfort tailored for every kind of traveler.
                                    </p>

                                    <p>
                                        Whether you are visiting for leisure, celebration, business, or a peaceful escape, <span class="brand">SEIN HELIOS</span> welcomes every guest with timeless luxury and unforgettable experiences.
                                    </p>

                                    <p>
                                        For reservations, inquiries, and personalized assistance, our team is always ready to serve you with warmth and professionalism.
                                    </p>
                                </div>

                                <div class="space-y-6">
                                    <aside class="contact-card rounded-3xl p-8">
                                        <p class="text-[var(--accent)] text-sm tracking-[0.18em] uppercase">Contact Information</p>
                                        <div class="mt-5 space-y-3 text-[var(--copy)] text-sm leading-7">
                                            <p>📞 09709084589</p>
                                            <p>✉️ seinhelios@gmail.com</p>
                                            <p>📍 Margarita Bay, Davao City</p>
                                        </div>
                                    </aside>

                                    <div class="quote-card">
                                        <p class="text-[var(--fg)] text-2xl lg:text-3xl leading-9 font-display">“Where the warmth of the sun meets timeless luxury.”</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('visible');
                            observer.unobserve(entry.target);
                        }
                    });
                }, {
                    threshold: 0.12
                });

                document.querySelectorAll('.fade-in').forEach((section) => {
                    observer.observe(section);
                });
            });
        </script>

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
