<x-app-layout>
    <div class="max-w-6xl mx-auto px-6 py-8">
        <button onclick="history.back()" class="inline-flex items-center gap-2 px-4 py-2 bg-[#0f0f0f] border border-[#2a2a2a] text-[#f5f5f0] rounded-xl hover:border-[#c9a77c] hover:bg-[#c9a77c]/10 transition-colors duration-300 text-sm font-medium mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Go Back
        </button>

        <a href="{{ route('user.rooms.index') }}" class="inline-flex items-center gap-2 text-[#8a8a8a] hover:text-[#f5f5f0] transition-colors mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Rooms
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-[1.4fr_0.95fr] gap-8">
            <section class="space-y-6">
                <div class="rounded-3xl overflow-hidden border border-[#2a2a2a] bg-[#111111] shadow-[0_20px_50px_rgba(0,0,0,0.2)]">
                    @if($room->image)
                        <img src="{{ asset('storage/' . $room->image) }}" alt="{{ $room->type }}" class="w-full h-64 object-cover">
                    @else
                        <div class="h-64 flex items-center justify-center bg-[#181818]">
                            <span class="text-8xl text-[#c9a77c]/20 font-serif">{{ substr($room->type, 0, 1) }}</span>
                        </div>
                    @endif
                </div>

                <div class="space-y-6 rounded-3xl border border-[#2a2a2a] bg-[#111111] p-8">
                    <div class="flex flex-wrap items-start justify-between gap-4">
                        <div>
                            <p class="text-xs uppercase tracking-[0.3em] text-[#8a8a8a] mb-2">Room Collection</p>
                            <h1 class="font-serif text-4xl text-[#f5f5f0]">{{ $room->type }}</h1>
                        </div>
                        <div class="text-right">
                            <p class="text-[#8a8a8a] text-sm">Price per night</p>
                            <p class="font-serif text-3xl text-[#c9a77c]">₱{{ number_format($room->price_per_night, 0) }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-[#b0b0b0]">
                        <div class="rounded-3xl border border-[#2a2a2a] bg-[#121212] p-4 text-center">
                            <p class="text-xs uppercase tracking-[0.3em] text-[#8a8a8a]">Guests</p>
                            <p class="mt-3 text-lg text-[#f5f5f0]">{{ $room->capacity }}</p>
                        </div>
                        <div class="rounded-3xl border border-[#2a2a2a] bg-[#121212] p-4 text-center">
                            <p class="text-xs uppercase tracking-[0.3em] text-[#8a8a8a]">Availability</p>
                            <p class="mt-3 text-lg text-[#f5f5f0]">{{ ucfirst($room->status) }}</p>
                        </div>
                        <div class="rounded-3xl border border-[#2a2a2a] bg-[#121212] p-4 text-center">
                            <p class="text-xs uppercase tracking-[0.3em] text-[#8a8a8a]">Category</p>
                            <p class="mt-3 text-lg text-[#f5f5f0]">{{ $room->type }}</p>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-[#2a2a2a] text-[#8a8a8a]">
                        <h2 class="font-serif text-xl text-[#f5f5f0] mb-3">About this stay</h2>
                        <p class="leading-relaxed">{{ $room->description ?? 'Experience the SEIN HELIOS standard of comfort, elegance and refined service. This room is carefully styled for a restful stay with premium amenities and elevated touches.' }}</p>
                    </div>

                    <div class="pt-6 border-t border-[#2a2a2a]">
                        <h2 class="font-serif text-xl text-[#f5f5f0] mb-3">Amenities</h2>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-3 text-sm text-[#8a8a8a]">
                            <span class="inline-flex items-center justify-center rounded-3xl bg-[#0f0f0f] border border-[#2a2a2a] px-4 py-3">WiFi</span>
                            <span class="inline-flex items-center justify-center rounded-3xl bg-[#0f0f0f] border border-[#2a2a2a] px-4 py-3">Air Conditioning</span>
                            <span class="inline-flex items-center justify-center rounded-3xl bg-[#0f0f0f] border border-[#2a2a2a] px-4 py-3">Room Service</span>
                            <span class="inline-flex items-center justify-center rounded-3xl bg-[#0f0f0f] border border-[#2a2a2a] px-4 py-3">Smart TV</span>
                            <span class="inline-flex items-center justify-center rounded-3xl bg-[#0f0f0f] border border-[#2a2a2a] px-4 py-3">Minibar</span>
                            <span class="inline-flex items-center justify-center rounded-3xl bg-[#0f0f0f] border border-[#2a2a2a] px-4 py-3">Concierge</span>
                        </div>
                    </div>
                </div>
            </section>

            <aside class="space-y-6">
                <div class="rounded-3xl border border-[#2a2a2a] bg-[#111111] p-8">
                    <h2 class="font-serif text-2xl text-[#f5f5f0] mb-4">Reserve this room</h2>
                    <form method="POST" action="{{ route('user.bookings.room.store', $room) }}" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 gap-4">
                            <label class="block text-sm font-medium text-[#f5f5f0]">
                                <span class="text-[#8a8a8a] mb-2 block">Guest Name</span>
                                <input type="text" name="guest_name" value="{{ old('guest_name', optional(auth()->user())->name) }}" required
                                    class="w-full px-4 py-3 bg-[#0f0f0f] border border-[#2a2a2a] rounded-3xl text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-1 focus:ring-[#c9a77c] transition-all">
                                @error('guest_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </label>

                            <label class="block text-sm font-medium text-[#f5f5f0]">
                                <span class="text-[#8a8a8a] mb-2 block">Contact Email</span>
                                <input type="email" name="guest_email" value="{{ old('guest_email', optional(auth()->user())->email) }}" required
                                    class="w-full px-4 py-3 bg-[#0f0f0f] border border-[#2a2a2a] rounded-3xl text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-1 focus:ring-[#c9a77c] transition-all">
                                @error('guest_email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </label>

                            <label class="block text-sm font-medium text-[#f5f5f0]">
                                <span class="text-[#8a8a8a] mb-2 block">Contact Number</span>
                                <input type="text" name="contact_number" value="{{ old('contact_number') }}" placeholder="e.g. +63 917 000 0000" required
                                    class="w-full px-4 py-3 bg-[#0f0f0f] border border-[#2a2a2a] rounded-3xl text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-1 focus:ring-[#c9a77c] transition-all">
                                @error('contact_number') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </label>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <label class="block text-sm font-medium text-[#f5f5f0]">
                                <span class="text-[#8a8a8a] mb-2 block">Check-in Date</span>
                                <input id="check_in" type="date" name="check_in" value="{{ old('check_in') }}" required min="{{ date('Y-m-d') }}"
                                    class="w-full px-4 py-3 bg-[#0f0f0f] border border-[#2a2a2a] rounded-3xl text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-1 focus:ring-[#c9a77c] transition-all">
                                @error('check_in') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </label>

                            <label class="block text-sm font-medium text-[#f5f5f0]">
                                <span class="text-[#8a8a8a] mb-2 block">Check-out Date</span>
                                <input id="check_out" type="date" name="check_out" value="{{ old('check_out') }}" required
                                    class="w-full px-4 py-3 bg-[#0f0f0f] border border-[#2a2a2a] rounded-3xl text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-1 focus:ring-[#c9a77c] transition-all">
                                @error('check_out') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </label>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <label class="block text-sm font-medium text-[#f5f5f0]">
                                <span class="text-[#8a8a8a] mb-2 block">Number of Guests</span>
                                <input type="number" name="number_of_guests" value="{{ old('number_of_guests', 1) }}" min="1" max="{{ $room->capacity }}" required
                                    class="w-full px-4 py-3 bg-[#0f0f0f] border border-[#2a2a2a] rounded-3xl text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-1 focus:ring-[#c9a77c] transition-all">
                                @error('number_of_guests') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </label>

                            <div class="space-y-2">
                                <p class="text-sm text-[#8a8a8a] uppercase tracking-[0.2em]">Room Number</p>
                                <button id="toggle-room-numbers" type="button" class="w-full inline-flex items-center justify-between rounded-3xl border border-[#2a2a2a] bg-[#121212] px-4 py-3 text-left text-[#f5f5f0] hover:border-[#c9a77c] transition-colors">
                                    <span>Select Room Number</span>
                                    <span id="toggle-room-numbers-icon" class="text-[#c9a77c]">+</span>
                                </button>
                            </div>
                        </div>

                        <div id="room-number-grid" class="space-y-4 hidden">
                            <p class="text-[#8a8a8a] text-sm">Choose an available room number below. Unavailable rooms are faded and cannot be selected.</p>
                            <div class="grid grid-cols-3 sm:grid-cols-4 gap-3">
                                @php
                                    $selectedRoomId = old('selected_room_id', $selectedRoomId ?? null);
                                    $bookedRoomIds = $bookings->pluck('room_id')->all();
                                @endphp

                                @foreach($roomNumbers as $roomNumber)
                                    @php
                                        $roomEntry = $typeRooms->get($roomNumber);
                                        $isBooked = $roomEntry && in_array($roomEntry->id, $bookedRoomIds);
                                        $isAvailable = $roomEntry && $roomEntry->status === 'available' && ! $isBooked;
                                        $isSelected = $selectedRoomId == ($roomEntry?->id);
                                    @endphp

                                    <label class="relative block rounded-3xl border p-4 text-left transition-all duration-300 ease-in-out {{ $isAvailable ? 'border-[#2a2a2a] bg-[#111111] hover:border-[#c9a77c] hover:shadow-[0_0_30px_rgba(201,167,124,0.15)]' : 'border-[#2a2a2a] bg-[#151515] opacity-70 cursor-not-allowed' }} {{ $isSelected ? 'border-[#c9a77c] shadow-[0_0_25px_rgba(201,167,124,0.18)]' : '' }}">
                                        <input type="radio" name="selected_room_id" value="{{ $roomEntry?->id }}" class="peer sr-only" {{ $isAvailable ? '' : 'disabled' }} {{ $isSelected ? 'checked' : '' }}>

                                        <div class="flex items-center justify-between gap-3">
                                            <div>
                                                <div class="text-lg font-semibold text-[#f5f5f0]">{{ $roomNumber }}</div>
                                                <div class="text-xs mt-1 {{ $isAvailable ? 'text-[#c9a77c]' : 'text-[#8a8a8a]' }}">{{ $isAvailable ? 'Available' : ($roomEntry ? 'Unavailable' : 'Unavailable') }}</div>
                                            </div>
                                            <span class="text-[11px] uppercase tracking-[0.25em] {{ $isAvailable ? 'text-[#c9a77c]' : 'text-[#8a8a8a]' }}">{{ $isAvailable ? 'Select' : 'Locked' }}</span>
                                        </div>
                                        <div class="pointer-events-none absolute inset-0 rounded-3xl border-2 border-transparent peer-checked:border-[#c9a77c]"></div>
                                    </label>
                                @endforeach
                            </div>
                            @error('selected_room_id') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                        </div>

                        <label class="block text-sm font-medium text-[#f5f5f0]">
                            <span class="text-[#8a8a8a] mb-2 block">Special Requests</span>
                            <textarea name="special_requests" rows="4" placeholder="Any special requests for your stay"
                                class="w-full px-4 py-3 bg-[#0f0f0f] border border-[#2a2a2a] rounded-3xl text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-1 focus:ring-[#c9a77c] transition-all">{{ old('special_requests') }}</textarea>
                            @error('special_requests') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </label>

                        <input type="hidden" name="room_id" value="{{ $room->id }}">

                        <button type="submit" class="w-full px-6 py-3 bg-[#c9a77c] text-[#0f0f0f] text-sm font-semibold tracking-wider rounded-3xl hover:bg-[#e8d5a7] transition-colors duration-300">
                            Book Room
                        </button>
                    </form>
                </div>

                <div class="rounded-3xl border border-[#2a2a2a] bg-[#111111] p-6">
                    <h3 class="font-serif text-xl text-[#f5f5f0] mb-3">Booking summary</h3>
                    <div class="space-y-3 text-sm text-[#c9c9c9]">
                        <div class="grid grid-cols-2 gap-3">
                            <span class="text-[#8a8a8a]">Room Type</span>
                            <span class="text-right text-[#f5f5f0]">{{ $room->type }}</span>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <span class="text-[#8a8a8a]">Price / night</span>
                            <span class="text-right text-[#c9a77c]">₱{{ number_format($room->price_per_night, 0) }}</span>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <span class="text-[#8a8a8a]">Guests</span>
                            <span class="text-right text-[#f5f5f0]">{{ $room->capacity }}</span>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <span class="text-[#8a8a8a]">Selected Room</span>
                            <span class="text-right text-[#f5f5f0]">{{ optional($typeRooms->firstWhere('id', $selectedRoomId))->room_number ?? 'None' }}</span>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>

    <script>
        const toggleButton = document.getElementById('toggle-room-numbers');
        const roomGrid = document.getElementById('room-number-grid');
        const toggleIcon = document.getElementById('toggle-room-numbers-icon');

        if (toggleButton && roomGrid) {
            toggleButton.addEventListener('click', () => {
                const isOpen = !roomGrid.classList.contains('hidden');
                roomGrid.classList.toggle('hidden');
                toggleIcon.textContent = isOpen ? '+' : '−';
            });
        }
    </script>
</x-app-layout>
