<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SEIN HELIOS') }} - Our Rooms</title>

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

            /* Section Styling */
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

            .section-header {
                text-align: center;
                margin-bottom: 80px;
            }

            .reserve-now-section {
                padding-top: 4rem;
                padding-bottom: 4rem;
            }

            .luxury-room-card {
                border-radius: 2rem;
                border: 1px solid var(--border);
                background: linear-gradient(180deg, rgba(15, 15, 15, 0.95) 0%, rgba(22, 22, 22, 0.95) 100%);
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
                overflow: hidden;
                transition: transform 0.4s ease, border-color 0.4s ease, box-shadow 0.4s ease;
                cursor: pointer;
            }

            .luxury-room-card:hover {
                border-color: var(--accent);
                transform: translateY(-6px);
                box-shadow: 0 26px 50px rgba(0, 0, 0, 0.35), 0 0 30px rgba(201, 167, 124, 0.12);
            }

            .luxury-room-card .card-title {
                color: var(--fg);
                transition: color 0.4s ease;
            }

            .luxury-room-card:hover .card-title {
                color: var(--accent);
            }

            /* Card Animations */
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
                            <a href="{{ route('rooms.browse') }}" class="nav-link text-sm font-medium text-[#f5f5f0] transition-colors duration-300">ROOMS</a>
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
            <div class="pt-20">
                <div class="max-w-7xl mx-auto px-6 py-8">
                    <!-- Luxury Accommodations Showcase -->
                    <section class="reserve-now-section">
                        <div class="max-w-7xl relative z-10">
                            <div class="section-header">
                                <h2 class="section-title">Luxury Accommodations</h2>
                                <p class="section-text">
                                    Four signature room collections, curated by admin control and rendered with elegant balance.
                                </p>
                            </div>

                            @php
                                $featuredRooms = collect();
                                if ($roomCategories->isNotEmpty()) {
                                    $featuredRooms = $roomCategories->take(4);
                                    if ($featuredRooms->count() < 4 && $uncategorizedRooms->isNotEmpty()) {
                                        $featuredRooms = $featuredRooms->concat($uncategorizedRooms->take(4 - $featuredRooms->count()));
                                    }
                                } elseif ($uncategorizedRooms->isNotEmpty()) {
                                    $featuredRooms = $uncategorizedRooms->take(4);
                                }
                            @endphp

                            <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                                @if($featuredRooms->isEmpty())
                                    <div class="col-span-1 sm:col-span-2 lg:col-span-4 rounded-[2rem] border border-[#2a2a2a] bg-[#0f0f0f] p-12 text-center text-[#8a8a8a]">
                                        Administrators can configure the four luxury room types in the admin panel. Changes to names and images appear here automatically.
                                    </div>
                                @else
                                    @foreach($featuredRooms as $item)
                                        @if($item instanceof \App\Models\RoomCategory)
                                            @php
                                                $previewRoom = $item->rooms->firstWhere('image', '!=', null) ?? $item->rooms->first();
                                                $roomName = $previewRoom ? $previewRoom->name : ucfirst(strtolower($item->name)) . ' Room';
                                                $roomInitial = strtoupper(substr($roomName, 0, 1));
                                                $roomTypeLabel = ucfirst(strtolower($item->name)) . ' Room';
                                                $roomDisplayName = preg_replace('/\b(?:Room\s*(?:No\.?\s*)?|#)\s*\d+\b/i', '', $roomName);
                                                $roomDisplayName = trim($roomDisplayName);
                                                if ($roomDisplayName === '') {
                                                    $roomDisplayName = $roomTypeLabel;
                                                }
                                            @endphp
                                            @if($previewRoom)
                                                <a href="{{ route('rooms.show', $previewRoom) }}" class="group luxury-room-card overflow-hidden border border-[#2a2a2a] bg-[#0f0f0f] shadow-[0_20px_40px_rgba(0,0,0,0.25)] transition duration-300 hover:border-[#c9a77c]/80 flex flex-col">
                                            @else
                                                <div class="group luxury-room-card overflow-hidden border border-[#2a2a2a] bg-[#0f0f0f] shadow-[0_20px_40px_rgba(0,0,0,0.25)] transition duration-300 hover:border-[#c9a77c]/80 flex flex-col">
                                            @endif
                                                <div class="relative h-64 overflow-hidden bg-[#111111] flex-shrink-0">
                                                    @if($previewRoom && $previewRoom->image)
                                                        <img src="{{ asset('storage/' . $previewRoom->image) }}" alt="{{ $roomDisplayName }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105" />
                                                    @else
                                                        <div class="h-full w-full flex items-center justify-center bg-gradient-to-br from-[#111111] to-[#1a1a1a]">
                                                            <span class="text-8xl font-serif uppercase tracking-[0.2em] text-[#c9a77c]/20">{{ $roomInitial }}</span>
                                                        </div>
                                                    @endif
                                                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                                                </div>

                                                <div class="p-6 flex-1 flex flex-col justify-between">
                                                    <div>
                                                        <h3 class="card-title mt-2 font-serif text-3xl text-[#f5f5f0] leading-tight">{{ $roomDisplayName }}</h3>
                                                    </div>
                                                    <div class="flex items-center justify-between text-sm mt-3">
                                                        <span class="text-[#8a8a8a]">{{ $item->capacity ?? '—' }} guests</span>
                                                        <span class="text-[#c9a77c] font-medium">{{ ucfirst(strtolower($item->name ?? 'Room')) }}</span>
                                                    </div>
                                                </div>
                                            @if($previewRoom)
                                                </a>
                                            @else
                                                </div>
                                            @endif
                                        @else
                                            @php
                                                $roomName = $item->name;
                                                $roomInitial = strtoupper(substr($roomName, 0, 1));
                                                $roomDisplayName = preg_replace('/\b(?:Room\s*(?:No\.?\s*)?|#)\s*\d+\b/i', '', $roomName);
                                                $roomDisplayName = trim($roomDisplayName);
                                                if ($roomDisplayName === '') {
                                                    $roomDisplayName = ucfirst(strtolower($item->type)) . ' Room';
                                                }
                                            @endphp
                                            <a href="{{ route('rooms.show', $item) }}" class="group luxury-room-card overflow-hidden border border-[#2a2a2a] bg-[#0f0f0f] shadow-[0_20px_40px_rgba(0,0,0,0.25)] transition duration-300 hover:border-[#c9a77c]/80 flex flex-col">
                                                <div class="relative h-64 overflow-hidden bg-[#111111] flex-shrink-0">
                                                    @if($item->image)
                                                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $roomDisplayName }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105" />
                                                    @else
                                                        <div class="h-full w-full flex items-center justify-center bg-gradient-to-br from-[#111111] to-[#1a1a1a]">
                                                            <span class="text-8xl font-serif uppercase tracking-[0.2em] text-[#c9a77c]/20">{{ $roomInitial }}</span>
                                                        </div>
                                                    @endif
                                                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                                                </div>

                                                <div class="p-6 flex-1 flex flex-col justify-between">
                                                    <div>
                                                        <h3 class="card-title mt-2 font-serif text-3xl text-[#f5f5f0] leading-tight">{{ $roomDisplayName }}</h3>
                                                    </div>
                                                    <div class="flex items-center justify-between text-sm mt-3">
                                                        <span class="text-[#8a8a8a]">{{ $item->capacity ?? '—' }} guests</span>
                                                        <span class="text-[#c9a77c] font-medium">{{ ucfirst(strtolower($item->type ?? 'Room')) }}</span>
                                                    </div>
                                                </div>
                                            </a>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </section>

                    <!-- Call to Action -->
                    <section class="py-12 text-center">
                        @guest
                            <p class="text-[#8a8a8a] mb-6">Ready to experience true luxury? Sign in to book your stay.</p>
                            <a href="#modal-login" class="inline-block px-8 py-3 bg-[#c9a77c] text-[#0f0f0f] font-medium rounded-lg hover:bg-[#e8d5a7] transition-colors duration-300">
                                Book Now
                            </a>
                        @else
                            <p class="text-[#8a8a8a] mb-6">Ready to complete your booking?</p>
                            <a href="{{ route('rooms.browse') }}" class="inline-block px-8 py-3 bg-[#c9a77c] text-[#0f0f0f] font-medium rounded-lg hover:bg-[#e8d5a7] transition-colors duration-300">
                                View Booking Details
                            </a>
                        @endguest
                    </section>
                </div>
            </div>
        </div>

        <!-- Auth Modals -->
        @include('components.auth-modals')
    </body>
</html>
