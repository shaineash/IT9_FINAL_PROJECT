<x-app-layout>
    <div class="max-w-7xl mx-auto px-6 py-8">
        <div class="mb-8 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-xs uppercase tracking-[0.3em] text-[#c9a77c]">Guest Dashboard</p>
                <h1 class="font-serif text-4xl text-[#f5f5f0] mt-3">Welcome back, {{ auth()->user()->name }}</h1>
                <p class="text-[#8a8a8a] mt-2 max-w-2xl">View your upcoming journeys, manage bookings, and access your profile control center.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-8 mb-8">
            <div class="bg-[#1a1a1a] border border-[#2a2a2a] rounded-3xl p-8 shadow-[0_20px_40px_rgba(0,0,0,0.25)]">
                <div class="flex gap-6 items-center flex-wrap">
                    <div class="relative">
                        <div class="w-28 h-28 rounded-[2rem] bg-[#0f0f0f] border border-[#2a2a2a] overflow-hidden flex items-center justify-center text-4xl text-[#c9a77c]">
                            @if(auth()->user()->profile_photo)
                                <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" alt="Profile" class="w-full h-full object-cover" />
                            @else
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            @endif
                        </div>
                    </div>
                    <div class="flex-1 min-w-[220px]">
                        <p class="text-[#8a8a8a] uppercase tracking-[0.2em] text-xs">Your profile</p>
                        <h2 class="font-serif text-3xl text-[#f5f5f0] mt-3">{{ auth()->user()->name }}</h2>
                        <p class="text-[#8a8a8a] mt-2">{{ auth()->user()->email }}</p>
                        <div class="mt-5 grid gap-3 sm:grid-cols-2">
                            <a href="{{ route('user.bookings.index') }}" class="px-4 py-3 rounded-2xl border border-[#2a2a2a] bg-[#0f0f0f] text-[#f5f5f0] hover:border-[#c9a77c] hover:bg-[#c9a77c]/10 transition-colors duration-300">My Bookings</a>
                            <a href="{{ route('user.rooms.index') }}" class="px-4 py-3 rounded-2xl border border-[#2a2a2a] bg-[#0f0f0f] text-[#f5f5f0] hover:border-[#c9a77c] hover:bg-[#c9a77c]/10 transition-colors duration-300">Browse Rooms</a>
                        </div>
                    </div>
                </div>

                <div class="mt-8 grid gap-4 sm:grid-cols-2">
                    <div class="rounded-3xl border border-[#2a2a2a] bg-[#0f0f0f] p-5">
                        <p class="text-[#8a8a8a] text-xs uppercase tracking-[0.2em]">Upcoming stays</p>
                        <p class="font-serif text-3xl text-[#c9a77c] mt-3">{{ $upcomingBookings->count() }}</p>
                    </div>
                    <div class="rounded-3xl border border-[#2a2a2a] bg-[#0f0f0f] p-5">
                        <p class="text-[#8a8a8a] text-xs uppercase tracking-[0.2em]">Past stays</p>
                        <p class="font-serif text-3xl text-[#c9a77c] mt-3">{{ $pastBookings->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-[#1a1a1a] border border-[#2a2a2a] rounded-3xl p-6 mb-8 shadow-[0_20px_40px_rgba(0,0,0,0.25)]">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <p class="text-[#8a8a8a] text-xs uppercase tracking-[0.2em]">Available Services</p>
                    <h2 class="font-serif text-2xl text-[#f5f5f0] mt-2">Enhance your stay</h2>
                </div>

            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="rounded-3xl border border-[#2a2a2a] bg-[#0f0f0f] p-5">
                    <p class="text-[#c9a77c] text-sm uppercase tracking-[0.2em]">Spa & Wellness</p>
                    <p class="text-[#f5f5f0] mt-3 text-sm leading-relaxed">Relax with premium massage treatments and wellness rituals designed for luxury comfort.</p>
                </div>
                <div class="rounded-3xl border border-[#2a2a2a] bg-[#0f0f0f] p-5">
                    <p class="text-[#c9a77c] text-sm uppercase tracking-[0.2em]">Dining Experiences</p>
                    <p class="text-[#f5f5f0] mt-3 text-sm leading-relaxed">Enjoy curated menus, private dining, and room service tailored to your preferences.</p>
                </div>
                <div class="rounded-3xl border border-[#2a2a2a] bg-[#0f0f0f] p-5">
                    <p class="text-[#c9a77c] text-sm uppercase tracking-[0.2em]">Room & Accommodation Services</p>
                    <p class="text-[#f5f5f0] mt-3 text-sm leading-relaxed">Experience refined comfort in our luxury suites and premium accommodations, thoughtfully designed with elegant interiors, daily housekeeping, high-speed Wi-Fi, smart entertainment systems, minibar amenities, and breathtaking private balconies or serene sea views for a truly relaxing stay.</p>
                </div>
                <div class="rounded-3xl border border-[#2a2a2a] bg-[#0f0f0f] p-5">
                    <p class="text-[#c9a77c] text-sm uppercase tracking-[0.2em]">Concierge</p>
                    <p class="text-[#f5f5f0] mt-3 text-sm leading-relaxed">Let our concierge handle reservations, activities, and special requests for you.</p>
                    <div class="mt-6 grid gap-3">
                        <button id="emailConciergeBtn" type="button" class="w-full rounded-3xl border border-[#2a2a2a] bg-[#111111] px-4 py-3 text-left text-[#f5f5f0] hover:border-[#c9a77c] hover:bg-[#121212] transition-colors duration-300">
                            <span class="block text-sm text-[#8a8a8a] uppercase tracking-[0.2em]">Email Concierge</span>
                            <span class="mt-2 block text-[#c9a77c] font-semibold">seinhelios@gmail.com</span>
                        </button>
                        <button id="callConciergeBtn" type="button" class="w-full rounded-3xl border border-[#2a2a2a] bg-[#111111] px-4 py-3 text-left text-[#f5f5f0] hover:border-[#c9a77c] hover:bg-[#121212] transition-colors duration-300">
                            <span class="block text-sm text-[#8a8a8a] uppercase tracking-[0.2em]">Call Guest Services</span>
                            <span class="mt-2 block text-[#c9a77c] font-semibold">+63 970 908 4589</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div id="conciergePopupOverlay" class="hidden fixed inset-0 z-50 bg-black/70 backdrop-blur-sm p-4 flex items-center justify-center">
            <div id="conciergePopupCard" class="relative max-w-md w-full rounded-[2rem] border border-[#2a2a2a] bg-[#111111] p-8 shadow-[0_30px_80px_rgba(0,0,0,0.5)]">
                <button id="conciergePopupClose" type="button" class="absolute right-4 top-4 text-[#8a8a8a] hover:text-[#c9a77c]">×</button>
                <h2 id="conciergePopupTitle" class="font-serif text-2xl text-[#f5f5f0] mb-2"></h2>
                <p id="conciergePopupSubtitle" class="text-[#8a8a8a] text-sm mb-6"></p>
                <div id="conciergePopupContent" class="space-y-3 text-[#f5f5f0] text-sm"></div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-8">
            <!-- Upcoming Bookings -->
            <div class="bg-[#1a1a1a] border border-[#2a2a2a] rounded-lg p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="font-serif text-xl text-[#f5f5f0]">Upcoming Bookings</h2>
                    <a href="{{ route('user.bookings.index') }}" class="text-sm text-[#c9a77c] hover:text-[#e8d5a7] transition-colors">View All</a>
                </div>
                @if($upcomingBookings->count())
                    <div class="space-y-4">
                        @foreach($upcomingBookings as $booking)
                            <div class="py-3 border-b border-[#2a2a2a] last:border-0">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-[#f5f5f0] font-medium">{{ $booking->room->name ?? 'Unknown Room' }}</p>
                                        <p class="text-[#8a8a8a] text-sm">{{ $booking->check_in->format('M d') }} - {{ $booking->check_out->format('M d') }}</p>
                                    </div>
                                    <span class="px-3 py-1 text-xs font-medium rounded-full
                                        {{ $booking->status === 'confirmed' ? 'bg-green-500/10 text-green-500' : '' }}
                                        {{ $booking->status === 'pending' ? 'bg-yellow-500/10 text-yellow-500' : '' }}">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-[#8a8a8a] text-center py-8">No upcoming bookings. <a href="{{ route('user.rooms.index') }}" class="text-[#c9a77c] hover:underline">Browse rooms</a></p>
                @endif
            </div>

        </div>
    </div>

    <script>
        const emailBtn = document.getElementById('emailConciergeBtn');
        const callBtn = document.getElementById('callConciergeBtn');
        const popupOverlay = document.getElementById('conciergePopupOverlay');
        const popupCard = document.getElementById('conciergePopupCard');
        const popupTitle = document.getElementById('conciergePopupTitle');
        const popupSubtitle = document.getElementById('conciergePopupSubtitle');
        const popupContent = document.getElementById('conciergePopupContent');
        const popupClose = document.getElementById('conciergePopupClose');

        function openConciergePopup(type) {
            if (!popupOverlay) return;

            if (type === 'email') {
                popupTitle.textContent = 'Email Concierge';
                popupSubtitle.textContent = 'Tap anywhere outside this card to close.';
                popupContent.innerHTML = '<div class="rounded-3xl border border-[#2a2a2a] bg-[#0f0f0f] p-5">'
                    + '<p class="text-[#8a8a8a] text-sm">Email</p>'
                    + '<p class="text-[#c9a77c] text-lg font-semibold mt-2">seinhelios@gmail.com</p>'
                    + '</div>';
            } else if (type === 'call') {
                popupTitle.textContent = 'Call Guest Services';
                popupSubtitle.textContent = 'Tap anywhere outside this card to close.';
                popupContent.innerHTML = '<div class="rounded-3xl border border-[#2a2a2a] bg-[#0f0f0f] p-5">'
                    + '<p class="text-[#8a8a8a] text-sm">Mobile</p>'
                    + '<p class="text-[#c9a77c] text-lg font-semibold mt-2">+63 970 908 4589</p>'
                    + '<p class="text-[#8a8a8a] text-sm mt-4">Landline</p>'
                    + '<p class="text-[#c9a77c] text-lg font-semibold mt-2">(082) 224-7812</p>'
                    + '</div>';
            }

            popupOverlay.classList.remove('hidden');
        }

        function closeConciergePopup() {
            if (!popupOverlay) return;
            popupOverlay.classList.add('hidden');
        }

        if (emailBtn) {
            emailBtn.addEventListener('click', () => openConciergePopup('email'));
        }

        if (callBtn) {
            callBtn.addEventListener('click', () => openConciergePopup('call'));
        }

        if (popupOverlay) {
            popupOverlay.addEventListener('click', closeConciergePopup);
        }

        if (popupCard) {
            popupCard.addEventListener('click', (event) => event.stopPropagation());
        }

        if (popupClose) {
            popupClose.addEventListener('click', closeConciergePopup);
        }
    </script>
</x-app-layout>
