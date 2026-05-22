<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-display text-4xl font-semibold text-[var(--fg)] leading-tight">
                Welcome back, {{ Auth::user()->name }}
            </h2>
            <div class="text-sm text-[var(--fg-muted)]">
                {{ now()->format('l, F j, Y') }}
            </div>
        </div>
    </x-slot>

    <!-- Background Pattern -->
    <div class="bg-pattern"></div>

    <!-- Floating particles background -->
    <div class="fixed inset-0 pointer-events-none z-0">
        <div class="particle" style="top: 20%; left: 10%; animation-delay: 0s;"></div>
        <div class="particle" style="top: 60%; left: 80%; animation-delay: 5s;"></div>
        <div class="particle" style="top: 80%; left: 30%; animation-delay: 10s;"></div>
        <div class="particle" style="top: 40%; left: 70%; animation-delay: 15s;"></div>
        <div class="particle" style="top: 10%; left: 50%; animation-delay: 20s;"></div>
    </div>

    <div class="relative z-10 space-y-12">
        <!-- Quick Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Total Rooms -->
            <div class="luxury-card group">
                <div class="flex items-center justify-between mb-6">
                    <div class="w-12 h-12 bg-[var(--accent)]/10 rounded-lg flex items-center justify-center group-hover:bg-[var(--accent)]/20 transition-all duration-300">
                        <svg class="w-6 h-6 text-[var(--accent)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                </div>
                <div class="card-number">24</div>
                <div class="card-title">Total Rooms</div>
                <div class="card-text">Complete hotel capacity</div>
            </div>

            <!-- Available Rooms -->
            <div class="luxury-card group">
                <div class="flex items-center justify-between mb-6">
                    <div class="w-12 h-12 bg-green-400/10 rounded-lg flex items-center justify-center group-hover:bg-green-400/20 transition-all duration-300">
                        <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="card-number" style="color: #10b981;">18</div>
                <div class="card-title">Available</div>
                <div class="card-text">Ready for check-in</div>
            </div>

            <!-- Today's Bookings -->
            <div class="luxury-card group">
                <div class="flex items-center justify-between mb-6">
                    <div class="w-12 h-12 bg-[var(--accent)]/10 rounded-lg flex items-center justify-center group-hover:bg-[var(--accent)]/20 transition-all duration-300">
                        <svg class="w-6 h-6 text-[var(--accent)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
                <div class="card-number">3</div>
                <div class="card-title">Today's Check-ins</div>
                <div class="card-text">Scheduled arrivals</div>
            </div>

            <!-- Revenue -->
            <div class="luxury-card group">
                <div class="flex items-center justify-between mb-6">
                    <div class="w-12 h-12 bg-blue-400/10 rounded-lg flex items-center justify-center group-hover:bg-blue-400/20 transition-all duration-300">
                        <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                </div>
                <div class="card-number" style="color: #3b82f6;">₱24.5k</div>
                <div class="card-title">Monthly Revenue</div>
                <div class="card-text">Current month earnings</div>
            </div>
        </div>

        <!-- Available Services -->
        <div class="luxury-card">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h3 class="font-display text-2xl font-semibold text-[var(--fg)] mb-2">Available Services</h3>
                    <p class="text-[var(--fg-muted)] text-sm">Explore hotel services and guest experiences available to you.</p>
                </div>
                <a href="{{ route('facilities') }}" class="btn-luxury text-xs px-6 py-3">View All</a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="rounded-3xl border border-[var(--border)] bg-[var(--bg-elevated)] p-5">
                    <p class="text-[var(--accent)] text-xs uppercase tracking-[0.2em]">Spa & Wellness</p>
                    <p class="text-[var(--fg)] mt-3 text-sm leading-relaxed">Relax with premium treatments and wellness rituals.</p>
                </div>
                <div class="rounded-3xl border border-[var(--border)] bg-[var(--bg-elevated)] p-5">
                    <p class="text-[var(--accent)] text-xs uppercase tracking-[0.2em]">Dining Experiences</p>
                    <p class="text-[var(--fg)] mt-3 text-sm leading-relaxed">Reserve private dining, room service, or tasting menus.</p>
                </div>
                <div class="rounded-3xl border border-[var(--border)] bg-[var(--bg-elevated)] p-5">
                    <p class="text-[var(--accent)] text-xs uppercase tracking-[0.2em]">Airport Transfers</p>
                    <p class="text-[var(--fg)] mt-3 text-sm leading-relaxed">Book luxury arrivals and departures with ease.</p>
                </div>
                <div class="rounded-3xl border border-[var(--border)] bg-[var(--bg-elevated)] p-5">
                    <p class="text-[var(--accent)] text-xs uppercase tracking-[0.2em]">Concierge</p>
                    <p class="text-[var(--fg)] mt-3 text-sm leading-relaxed">Let our concierge arrange reservations and requests for you.</p>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Recent Bookings -->
            <div class="lg:col-span-2">
                <div class="luxury-card">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h3 class="font-display text-2xl font-semibold text-[var(--fg)] mb-2">Recent Bookings</h3>
                            <p class="text-[var(--fg-muted)] text-sm">Latest reservations and check-ins</p>
                        </div>
                        <div class="btn-luxury text-xs px-6 py-3">
                            View All
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-6 bg-[var(--bg-elevated)] rounded-lg border border-[var(--border)] hover:border-[var(--accent)]/30 transition-all duration-300 group">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-[var(--accent)]/10 rounded-lg flex items-center justify-center group-hover:bg-[var(--accent)]/20 transition-all duration-300">
                                    <svg class="w-6 h-6 text-[var(--accent)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-[var(--fg)] font-medium text-lg">John Smith</p>
                                    <p class="text-[var(--fg-muted)] text-sm">Room 201 - Deluxe Suite</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-[var(--accent)] font-semibold text-lg">₱299/night</p>
                                <p class="text-[var(--fg-muted)] text-sm">Check-in: Today</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-between p-6 bg-[var(--bg-elevated)] rounded-lg border border-[var(--border)] hover:border-[var(--accent)]/30 transition-all duration-300 group">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-[var(--accent)]/10 rounded-lg flex items-center justify-center group-hover:bg-[var(--accent)]/20 transition-all duration-300">
                                    <svg class="w-6 h-6 text-[var(--accent)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-[var(--fg)] font-medium text-lg">Sarah Johnson</p>
                                    <p class="text-[var(--fg-muted)] text-sm">Room 305 - Executive Room</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-[var(--accent)] font-semibold text-lg">₱189/night</p>
                                <p class="text-[var(--fg-muted)] text-sm">Check-in: Tomorrow</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-between p-6 bg-[var(--bg-elevated)] rounded-lg border border-[var(--border)] hover:border-[var(--accent)]/30 transition-all duration-300 group">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-[var(--accent)]/10 rounded-lg flex items-center justify-center group-hover:bg-[var(--accent)]/20 transition-all duration-300">
                                    <svg class="w-6 h-6 text-[var(--accent)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-[var(--fg)] font-medium text-lg">Michael Chen</p>
                                    <p class="text-[var(--fg-muted)] text-sm">Room 102 - Standard Room</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-[var(--accent)] font-semibold text-lg">₱129/night</p>
                                <p class="text-[var(--fg-muted)] text-sm">Check-out: Today</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions & Room Status -->
            <div class="space-y-8">
                <!-- Quick Actions -->
                <div class="luxury-card">
                    <h3 class="font-display text-2xl font-semibold text-[var(--fg)] mb-6">Quick Actions</h3>
                    <div class="space-y-4">
                        <button class="btn-luxury w-full justify-start text-left">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            New Booking
                        </button>

                        <button class="btn-luxury w-full justify-start text-left">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            Room Management
                        </button>

                        <button class="btn-luxury w-full justify-start text-left">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            Reports
                        </button>

                        <button class="btn-luxury w-full justify-start text-left">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Settings
                        </button>
                    </div>
                </div>

                <!-- Room Status -->
                <div class="luxury-card">
                    <h3 class="font-display text-2xl font-semibold text-[var(--fg)] mb-6">Room Status</h3>
                    <div class="space-y-6">
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-[var(--fg-muted)] font-medium">Occupied</span>
                                <span class="text-red-400 font-semibold text-lg">6 rooms</span>
                            </div>
                            <div class="w-full bg-[var(--border)] rounded-full h-3 overflow-hidden">
                                <div class="bg-red-400 h-full rounded-full transition-all duration-1000 ease-out" style="width: 25%"></div>
                            </div>
                        </div>

                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-[var(--fg-muted)] font-medium">Available</span>
                                <span class="text-green-400 font-semibold text-lg">18 rooms</span>
                            </div>
                            <div class="w-full bg-[var(--border)] rounded-full h-3 overflow-hidden">
                                <div class="bg-green-400 h-full rounded-full transition-all duration-1000 ease-out" style="width: 75%"></div>
                            </div>
                        </div>

                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-[var(--fg-muted)] font-medium">Maintenance</span>
                                <span class="text-yellow-400 font-semibold text-lg">0 rooms</span>
                            </div>
                            <div class="w-full bg-[var(--border)] rounded-full h-3 overflow-hidden">
                                <div class="bg-yellow-400 h-full rounded-full transition-all duration-1000 ease-out" style="width: 0%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Ultra-Elegant Hotel Color Scheme */
        :root {
            /* Background Colors - Deep Luxury */
            --bg: #0a0a0a; /* Ultra-deep charcoal */
            --bg-elevated: #121212; /* Elevated charcoal */
            --bg-card: #1a1a1a; /* Premium card background */

            /* Text Colors - Sophisticated */
            --fg: #fafafa; /* Pure white */
            --fg-muted: #b0b0b0; /* Elegant muted */
            --fg-accent: #e8e8e8; /* Premium accent */

            /* Primary Accent - Platinum Gold */
            --accent: #e8d5b7; /* Warm platinum */
            --accent-light: #f5e6c3; /* Light platinum */
            --accent-dark: #c4a875; /* Deep platinum */
            --accent-glow: rgba(232, 213, 183, 0.3); /* Subtle glow */

            /* Status Colors - Refined */
            --success: #4ade80; /* Emerald green */
            --warning: #fbbf24; /* Amber gold */
            --error: #ef4444; /* Ruby red */
            --info: #60a5fa; /* Sapphire blue */

            /* Borders and Dividers */
            --border: #2d2d2d; /* Soft border */
            --border-accent: rgba(232, 213, 183, 0.2); /* Accent border */
        }

        /* Floating particles animation */
        .particle {
            position: fixed;
            width: 2px;
            height: 2px;
            background: var(--accent);
            border-radius: 50%;
            opacity: 0.3;
            animation: float 20s infinite ease-in-out;
            pointer-events: none;
            z-index: 0;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) translateX(0); opacity: 0.3; }
            25% { transform: translateY(-100px) translateX(50px); opacity: 0.6; }
            50% { transform: translateY(-50px) translateX(-30px); opacity: 0.4; }
            75% { transform: translateY(-150px) translateX(20px); opacity: 0.5; }
        }

        /* Subtle background pattern */
        .bg-pattern {
            position: fixed;
            inset: 0;
            background-image:
                radial-gradient(ellipse 80% 50% at 50% -20%, rgba(232, 213, 183, 0.08), transparent),
                radial-gradient(ellipse 60% 40% at 100% 100%, rgba(26, 35, 50, 0.05), transparent);
            pointer-events: none;
            z-index: 0;
        }

        /* Luxury Card - Premium Enhancement */
        .luxury-card {
            background: linear-gradient(135deg, var(--bg-card) 0%, rgba(26, 26, 26, 0.9) 100%);
            border: 1px solid var(--border);
            padding: 40px;
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
            box-shadow:
                0 20px 60px rgba(0, 0, 0, 0.4),
                0 0 40px var(--accent-glow);
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
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            opacity: 0.6;
            line-height: 1;
            margin-bottom: 16px;
            transition: all 0.4s ease;
        }

        .luxury-card:hover .card-number {
            opacity: 1;
            transform: scale(1.1);
        }

        .card-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 28px;
            font-weight: 600;
            margin: 0 0 16px;
            color: var(--fg);
            transition: color 0.4s ease;
        }

        .luxury-card:hover .card-title {
            color: var(--accent);
        }

        .card-text {
            color: var(--fg-muted);
            line-height: 1.7;
            font-size: 15px;
            transition: color 0.4s ease;
        }

        .luxury-card:hover .card-text {
            color: var(--fg-accent);
        }

        /* Luxury Buttons - Premium Enhancement */
        .btn-luxury {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 18px 36px;
            background: transparent;
            border: 1px solid var(--accent);
            color: var(--accent);
            font-family: 'Montserrat', sans-serif;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            cursor: pointer;
            overflow: hidden;
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            border-radius: 12px;
            backdrop-filter: blur(10px);
        }

        .btn-luxury::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 50%, var(--accent) 100%);
            transform: translateY(100%) scaleX(0.8);
            transform-origin: center;
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: -1;
            border-radius: 12px;
        }

        .btn-luxury::after {
            content: '';
            position: absolute;
            inset: -1px;
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
            border-radius: 12px;
            opacity: 0;
            z-index: -2;
            transition: opacity 0.6s ease;
        }

        .btn-luxury:hover {
            color: var(--bg);
            border-color: var(--accent-light);
            box-shadow: 0 0 40px var(--accent-glow), 0 10px 30px rgba(0, 0, 0, 0.3);
            transform: translateY(-3px) scale(1.02);
        }

        .btn-luxury:hover::before {
            transform: translateY(0) scaleX(1);
        }

        .btn-luxury:hover::after {
            opacity: 1;
        }

        .btn-luxury:active {
            transform: scale(0.98) translateY(-1px);
        }
