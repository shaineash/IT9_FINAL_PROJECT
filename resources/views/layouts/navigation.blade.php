<nav x-data="{ open: false }" class="fixed top-0 left-0 right-0 z-50 bg-[#0f0f0f]/95 backdrop-blur-xl border-b border-[#2a2a2a] shadow-[0_18px_60px_-40px_rgba(0,0,0,0.9)]">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center gap-8">
                <!-- Logo -->
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.svg') }}" alt="SEIN HELIOS" class="h-9 w-auto object-contain" />
                    <span class="font-display text-xs tracking-[0.35em] uppercase text-[#e8d5b7]">SEIN HELIOS</span>
                </a>

                <!-- Navigation Links -->
                <div class="hidden sm:flex sm:items-center sm:space-x-6">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            @auth
                <div class="hidden sm:flex sm:items-center sm:gap-4">
                    <x-dropdown align="right" width="48" contentClasses="py-1 bg-[#121212] border border-[#2a2a2a] shadow-[0_25px_70px_-30px_rgba(0,0,0,0.9)]">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center gap-2 rounded-full border border-[#2a2a2a] bg-[#121212] px-4 py-2 text-sm font-semibold text-[#f5f5f0] hover:border-[#c9a77c] hover:text-[#e8d5b7] focus:outline-none focus:ring-2 focus:ring-[#c9a77c]/30 transition duration-200">
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="h-4 w-4 text-[#c9a77c]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <button type="submit" class="block w-full px-4 py-2 text-start text-sm leading-5 text-[#e8e8e8] hover:text-[#f5f5f0] hover:bg-[#1f1f1f] focus:outline-none focus:bg-[#1f1f1f] transition duration-150 ease-in-out">
                                    {{ __('Log Out') }}
                                </button>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            @endauth

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-[#b0b0b0] hover:text-[#f5f5f0] hover:bg-[#1f1f1f] focus:outline-none focus:bg-[#1f1f1f] focus:text-[#f5f5f0] transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-[#0f0f0f] border-t border-[#2a2a2a]">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        @auth
            <div class="pt-4 pb-1 border-t border-[#2a2a2a]">
                <div class="px-4">
                    <div class="font-medium text-base text-[#f5f5f0]">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-[#b0b0b0]">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit" class="block w-full px-4 py-2 text-start text-sm leading-5 text-[#e8e8e8] hover:text-[#f5f5f0] hover:bg-[#1f1f1f] focus:outline-none focus:bg-[#1f1f1f] transition duration-150 ease-in-out">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</nav>
