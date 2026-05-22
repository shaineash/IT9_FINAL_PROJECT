<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=cormorant+garamond:400,500,600,700&display=swap" rel="stylesheet" />
        <link href="https://fonts.bunny.net/css?family=montserrat:300,400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* Ultra-Elegant Hotel Color Scheme */
            :root {
                /* Background Colors - Deep Luxury */
                --bg: #0a0a0a; /* Ultra-deep charcoal */
                --bg-elevated: #121212; /* Elevated charcoal */
                --bg-card: #1a1a1a; /* Premium card background */
                --bg-overlay: rgba(10, 10, 10, 0.95); /* Glass effect */

                /* Text Colors - Sophisticated */
                --fg: #fafafa; /* Pure white */
                --fg-muted: #b0b0b0; /* Elegant muted */
                --fg-accent: #e8e8e8; /* Premium accent */
                --fg-subtle: #808080; /* Subtle text */

                /* Primary Accent - Platinum Gold */
                --accent: #e8d5b7; /* Warm platinum */
                --accent-light: #f5e6c3; /* Light platinum */
                --accent-dark: #c4a875; /* Deep platinum */
                --accent-glow: rgba(232, 213, 183, 0.3); /* Subtle glow */

                /* Secondary Accents - Royal Navy */
                --secondary: #1a2332; /* Deep navy */
                --secondary-light: #2a3441; /* Light navy */
                --secondary-accent: #3e4c5e; /* Navy accent */

                /* Status Colors - Refined */
                --success: #4ade80; /* Emerald green */
                --warning: #fbbf24; /* Amber gold */
                --error: #ef4444; /* Ruby red */
                --info: #60a5fa; /* Sapphire blue */

                /* Borders and Dividers - Minimalist */
                --border: #2d2d2d; /* Soft border */
                --border-light: #404040; /* Light border */
                --border-accent: rgba(232, 213, 183, 0.2); /* Accent border */

                /* Cards and Surfaces - Premium */
                --card: var(--bg-card);
                --card-hover: #202020;
                --card-border: var(--border);
                --card-shadow: rgba(0, 0, 0, 0.4);

                /* Gradients - Luxury */
                --gradient-primary: linear-gradient(135deg, var(--accent) 0%, var(--accent-dark) 100%);
                --gradient-secondary: linear-gradient(135deg, var(--secondary) 0%, var(--secondary-light) 100%);
                --gradient-accent: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
                --gradient-glass: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.05) 100%);

                /* Special Effects */
                --glow-primary: 0 0 20px var(--accent-glow);
                --glow-secondary: 0 0 15px rgba(42, 52, 65, 0.3);
                --shadow-luxury: 0 20px 40px var(--card-shadow);
            }

            /* Typography */
            .font-display {
                font-family: 'Cormorant Garamond', serif;
            }

            .font-body {
                font-family: 'Montserrat', sans-serif;
            }

            /* Smooth scrolling */
            html {
                scroll-behavior: smooth;
            }

            /* Custom scrollbar */
            ::-webkit-scrollbar {
                width: 8px;
            }

            ::-webkit-scrollbar-track {
                background: var(--bg);
            }

            ::-webkit-scrollbar-thumb {
                background: var(--accent);
                border-radius: 4px;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: var(--accent-light);
            }

            /* Global body styling */
            body {
                background: var(--bg);
                color: var(--fg);
                font-family: 'Montserrat', sans-serif;
            }
        </style>
    </head>
    <body class="font-body antialiased bg-[var(--bg)] text-[var(--fg)]">
        <div class="min-h-screen bg-[var(--bg)]">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-[var(--bg-elevated)] border-b border-[var(--border)] shadow-lg">
                    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="bg-[var(--bg)]">
                {{ $slot }}
            </main>
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
    </body>
</html>
