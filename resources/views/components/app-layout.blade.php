<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SEIN HELIOS') }} - Hotel Management</title>

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

            /* Smooth scroll */
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
                background: var(--border);
                border-radius: 4px;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: var(--accent);
            }

            /* Focus styles */
            *:focus {
                outline: 2px solid var(--accent);
                outline-offset: 2px;
            }

            .focus-ring {
                transition: box-shadow 0.2s ease;
            }

            .focus-ring:focus {
                box-shadow: 0 0 0 3px rgba(201, 167, 124, 0.3);
            }

            /* Reduced motion */
            @media (prefers-reduced-motion: reduce) {
                *, *::before, *::after {
                    animation-duration: 0.01ms !important;
                    animation-iteration-count: 1 !important;
                    transition-duration: 0.01ms !important;
                }
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="min-h-screen bg-[#0f0f0f]">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="border-b border-[#2a2a2a] bg-[#1a1a1a]">
                    <div class="max-w-7xl mx-auto py-6 px-6">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
