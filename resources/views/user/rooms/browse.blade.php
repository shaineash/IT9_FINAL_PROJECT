<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'SEIN HELIOS') }} — Our Rooms</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --bg: #0f0f0f; --fg: #f5f5f0; --fg-muted: #8a8a8a;
            --accent: #c9a77c; --accent-light: #e8d5a7;
            --border: #2a2a2a;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Montserrat', sans-serif; background: var(--bg); color: var(--fg); min-height: 100vh; }
        .font-display { font-family: 'Cormorant Garamond', serif; }

        .room-card {
            border-radius: 1.5rem;
            border: 1px solid var(--border);
            background: linear-gradient(180deg, #111111 0%, #1a1a1a 100%);
            overflow: hidden;
            transition: transform 0.4s ease, border-color 0.4s ease, box-shadow 0.4s ease;
            display: flex; flex-direction: column;
        }
        .room-card:hover {
            border-color: var(--accent);
            transform: translateY(-6px);
            box-shadow: 0 24px 50px rgba(0,0,0,0.4), 0 0 30px rgba(201,167,124,0.1);
        }
        .room-card:hover .card-title { color: var(--accent); }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .fade-up { opacity: 0; animation: fadeUp 0.6s ease forwards; }
        .fade-up:nth-child(1) { animation-delay: 0.05s; }
        .fade-up:nth-child(2) { animation-delay: 0.15s; }
        .fade-up:nth-child(3) { animation-delay: 0.25s; }
        .fade-up:nth-child(4) { animation-delay: 0.35s; }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-[#0f0f0f]/80 backdrop-blur-xl border-b border-[#2a2a2a]">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center justify-between h-16 lg:h-20">
                <a href="/" class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.svg') }}" alt="SEIN HELIOS" class="h-8 lg:h-10 w-auto">
                    <span class="font-display text-lg lg:text-xl font-semibold tracking-wider" style="color:var(--accent)">SEIN HELIOS</span>
                </a>
                <!-- Desktop links -->
                <div class="hidden md:flex items-center gap-4 lg:gap-6">
                    <a href="{{ route('home') }}"         class="text-sm font-medium text-[#8a8a8a] hover:text-[#f5f5f0] transition-colors">HOME</a>
                    <a href="{{ route('rooms.browse') }}" class="text-sm font-medium text-[#f5f5f0]">ROOMS</a>
                    <a href="{{ route('facilities') }}"   class="text-sm font-medium text-[#8a8a8a] hover:text-[#f5f5f0] transition-colors">FACILITIES</a>
                    <a href="{{ route('about') }}"        class="text-sm font-medium text-[#8a8a8a] hover:text-[#f5f5f0] transition-colors">ABOUT US</a>
                    @guest
                        <a href="#modal-login" class="px-5 py-2.5 bg-[#c9a77c] text-[#0f0f0f] text-sm font-medium rounded-lg hover:bg-[#e8d5a7] transition-colors">Sign In</a>
                    @else
                        <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 bg-[#c9a77c] text-[#0f0f0f] text-sm font-medium rounded-lg hover:bg-[#e8d5a7] transition-colors">Dashboard</a>
                    @endguest
                </div>
                <!-- Mobile hamburger -->
                <button id="mobile-menu-btn" class="md:hidden flex flex-col gap-1.5 p-2" aria-label="Open menu">
                    <span class="block w-6 h-0.5 bg-[#f5f5f0]"></span>
                    <span class="block w-6 h-0.5 bg-[#f5f5f0]"></span>
                    <span class="block w-6 h-0.5 bg-[#f5f5f0]"></span>
                </button>
            </div>
        </div>
        <!-- Mobile drawer -->
        <div id="mobile-menu" class="hidden md:hidden bg-[#0f0f0f] border-t border-[#2a2a2a] px-6 py-4 space-y-3">
            <a href="{{ route('home') }}"         class="block text-sm font-medium text-[#8a8a8a] hover:text-[#f5f5f0] py-2 transition-colors">HOME</a>
            <a href="{{ route('rooms.browse') }}" class="block text-sm font-medium text-[#f5f5f0] py-2">ROOMS</a>
            <a href="{{ route('facilities') }}"   class="block text-sm font-medium text-[#8a8a8a] hover:text-[#f5f5f0] py-2 transition-colors">FACILITIES</a>
            <a href="{{ route('about') }}"        class="block text-sm font-medium text-[#8a8a8a] hover:text-[#f5f5f0] py-2 transition-colors">ABOUT US</a>
            @guest
                <a href="#modal-login" class="block w-full text-center px-5 py-2.5 bg-[#c9a77c] text-[#0f0f0f] text-sm font-medium rounded-lg hover:bg-[#e8d5a7] transition-colors">Sign In</a>
            @else
                <a href="{{ url('/dashboard') }}" class="block w-full text-center px-5 py-2.5 bg-[#c9a77c] text-[#0f0f0f] text-sm font-medium rounded-lg hover:bg-[#e8d5a7] transition-colors">Dashboard</a>
            @endguest
        </div>
    </nav>
    <script>
        document.getElementById('mobile-menu-btn').addEventListener('click',function(){
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>

    <div class="pt-24 pb-20">
        <div class="max-w-7xl mx-auto px-6">

            <!-- Header -->
            <div class="text-center mb-14">
                <p class="text-xs font-semibold tracking-[0.35em] uppercase mb-4" style="color:var(--accent)">Accommodations</p>
                <h1 class="font-display text-5xl lg:text-6xl font-semibold text-[#f5f5f0] mb-4">Our Rooms &amp; Suites</h1>
                <p class="text-[#8a8a8a] text-base max-w-xl mx-auto leading-relaxed">
                    Curated luxury accommodations, each crafted for an exceptional stay.
                </p>
            </div>

            <!-- Room Grid -->
            @if($roomTypes->isEmpty())
                <div class="rounded-2xl border border-[#2a2a2a] bg-[#111111] p-16 text-center">
                    <p class="text-[#8a8a8a] text-lg font-display">No rooms have been configured yet.</p>
                    <p class="text-[#8a8a8a] text-sm mt-2">Please check back soon or contact the front desk.</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($roomTypes as $group)
                        @php
                            $availableCount = $group->available_rooms->count();
                            $totalCount     = $group->rooms->count();
                            $hasAvailable   = $availableCount > 0;
                            $firstRoom      = $group->first_available ?? $group->representative;
                            $initial        = strtoupper(substr($group->label, 0, 1));
                        @endphp

                        <div class="room-card fade-up">
                            <!-- Image -->
                            <div class="relative h-56 bg-[#111111] flex-shrink-0 overflow-hidden">
                                @if($group->image)
                                    <img src="{{ asset('storage/' . $group->image) }}"
                                         alt="{{ $group->label }}"
                                         class="h-full w-full object-cover transition-transform duration-500 hover:scale-105">
                                @else
                                    <div class="h-full w-full flex items-center justify-center bg-gradient-to-br from-[#111111] to-[#1a1a1a]">
                                        <span class="font-display text-8xl uppercase tracking-[0.2em] text-[#c9a77c]/20">{{ $initial }}</span>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>

                                <!-- Availability badge -->
                                <div class="absolute top-4 right-4">
                                    @if($hasAvailable)
                                        <span class="text-xs font-semibold px-3 py-1 rounded-full bg-green-500/10 text-green-400">
                                            {{ $availableCount }} Available
                                        </span>
                                    @else
                                        <span class="text-xs font-semibold px-3 py-1 rounded-full bg-red-500/10 text-red-400">
                                            Fully Booked
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Body -->
                            <div class="p-6 flex flex-col flex-1">
                                <!-- Stars -->
                                <div class="flex gap-1 mb-3">
                                    @for($i = 0; $i < 5; $i++)
                                        <svg class="w-3.5 h-3.5 text-[#c9a77c]" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                        </svg>
                                    @endfor
                                </div>

                                <h3 class="card-title font-display text-2xl text-[#f5f5f0] font-semibold leading-tight transition-colors duration-300 mb-1">
                                    {{ $group->label }}
                                </h3>
                                <p class="text-xs uppercase tracking-[0.15em] text-[#c9a77c] mb-3">Room Type: {{ $group->type }}</p>

                                <div class="flex items-center gap-4 text-sm text-[#8a8a8a] mb-4">
                                    <span>Up to {{ $group->capacity }} guests</span>
                                    <span class="text-[#c9a77c] font-semibold">
                                        ₱{{ number_format($group->price_per_night, 0) }}<span class="text-[#8a8a8a] font-normal">/night</span>
                                    </span>
                                </div>

                                @if($group->description)
                                    <p class="text-[#8a8a8a] text-sm leading-relaxed mb-5 line-clamp-2">{{ $group->description }}</p>
                                @endif

                                <!-- CTA -->
                                <div class="mt-auto">
                                    @if($hasAvailable && $firstRoom)
                                        @auth
                                            <a href="{{ route('rooms.show', $firstRoom) }}"
                                               class="block w-full text-center px-5 py-3 bg-[#c9a77c] text-[#0f0f0f] text-sm font-semibold rounded-xl hover:bg-[#e8d5a7] transition-colors duration-300">
                                                Book Now
                                            </a>
                                        @else
                                            <a href="#modal-login"
                                               class="block w-full text-center px-5 py-3 bg-[#c9a77c] text-[#0f0f0f] text-sm font-semibold rounded-xl hover:bg-[#e8d5a7] transition-colors duration-300">
                                                Sign In to Book
                                            </a>
                                        @endauth
                                    @else
                                        <span class="block w-full text-center px-5 py-3 border border-[#2a2a2a] text-[#8a8a8a] text-sm rounded-xl cursor-not-allowed">
                                            Fully Booked
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>

    @include('components.auth-modals')
</body>
</html>
