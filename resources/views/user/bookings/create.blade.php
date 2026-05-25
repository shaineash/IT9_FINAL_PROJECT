<x-app-layout>
    <div class="max-w-6xl mx-auto px-6 py-8">

        <button onclick="history.back()"
            class="inline-flex items-center gap-2 px-4 py-2 bg-[#0f0f0f] border border-[#2a2a2a] text-[#f5f5f0] rounded-xl hover:border-[#c9a77c] hover:bg-[#c9a77c]/10 transition-colors duration-300 text-sm font-medium mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Go Back
        </button>

        <div class="mb-8">
            <h1 class="font-serif text-3xl text-[#f5f5f0]">Complete Your Booking</h1>
            <p class="text-[#8a8a8a] text-sm mt-1">{{ $room->type }} — ₱{{ number_format($room->price_per_night, 0) }} / night</p>
        </div>

        @if(session('error'))
            <div class="mb-6 px-4 py-3 rounded-xl bg-red-500/10 border border-red-500/30 text-red-400 text-sm">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 xl:grid-cols-[1fr_380px] gap-8">

            <!-- Booking Form -->
            <div class="rounded-3xl border border-[#2a2a2a] bg-[#111111] p-8">
                <form method="POST" action="{{ route('user.bookings.room.store', $room) }}" class="space-y-6">
                    @csrf

                    <!-- Room Number -->
                    <div>
                        <label for="room_number" class="block text-sm font-medium text-[#f5f5f0] mb-2">Choose Room Number</label>
                        <select name="room_number" id="room_number"
                            class="w-full px-4 py-3 bg-[#0f0f0f] border border-[#2a2a2a] rounded-3xl text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-1 focus:ring-[#c9a77c] transition-all">
                            <option value="">Auto-select next available room</option>
                            @foreach($typeRooms->where('status', 'available') as $availableRoom)
                                <option value="{{ $availableRoom->room_number }}"
                                    {{ old('room_number') == $availableRoom->room_number ? 'selected' : '' }}>
                                    {{ $availableRoom->room_number }} — {{ $availableRoom->name }}
                                </option>
                            @endforeach
                        </select>
                        <p class="text-[#8a8a8a] text-xs mt-2">Leave blank to auto-assign the next available room.</p>
                        @error('room_number') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Guest Name & Email -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="guest_name" class="block text-sm font-medium text-[#f5f5f0] mb-2">Guest Full Name</label>
                            <input type="text" name="guest_name" id="guest_name"
                                value="{{ old('guest_name', auth()->user()->name) }}" required
                                class="w-full px-4 py-3 bg-[#0f0f0f] border border-[#2a2a2a] rounded-3xl text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-1 focus:ring-[#c9a77c] transition-all">
                            @error('guest_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="guest_email" class="block text-sm font-medium text-[#f5f5f0] mb-2">Email Address</label>
                            <input type="email" name="guest_email" id="guest_email"
                                value="{{ old('guest_email', auth()->user()->email) }}" required
                                class="w-full px-4 py-3 bg-[#0f0f0f] border border-[#2a2a2a] rounded-3xl text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-1 focus:ring-[#c9a77c] transition-all">
                            @error('guest_email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- Contact Number -->
                    <div>
                        <label for="contact_number" class="block text-sm font-medium text-[#f5f5f0] mb-2">Contact Number</label>
                        <input type="text" name="contact_number" id="contact_number"
                            value="{{ old('contact_number') }}" placeholder="e.g. +63 917 000 0000" required
                            class="w-full px-4 py-3 bg-[#0f0f0f] border border-[#2a2a2a] rounded-3xl text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-1 focus:ring-[#c9a77c] transition-all">
                        @error('contact_number') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Dates -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="check_in" class="block text-sm font-medium text-[#f5f5f0] mb-2">Check-in Date</label>
                            <input type="date" name="check_in" id="check_in"
                                value="{{ old('check_in') }}" required min="{{ date('Y-m-d') }}"
                                class="w-full px-4 py-3 bg-[#0f0f0f] border border-[#2a2a2a] rounded-3xl text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-1 focus:ring-[#c9a77c] transition-all">
                            @error('check_in') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="check_out" class="block text-sm font-medium text-[#f5f5f0] mb-2">Check-out Date</label>
                            <input type="date" name="check_out" id="check_out"
                                value="{{ old('check_out') }}" required
                                class="w-full px-4 py-3 bg-[#0f0f0f] border border-[#2a2a2a] rounded-3xl text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-1 focus:ring-[#c9a77c] transition-all">
                            @error('check_out') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- Guests -->
                    <div>
                        <label for="number_of_guests" class="block text-sm font-medium text-[#f5f5f0] mb-2">Number of Guests</label>
                        <input type="number" name="number_of_guests" id="number_of_guests"
                            value="{{ old('number_of_guests', 1) }}" min="1" max="{{ $room->capacity }}" required
                            class="w-full px-4 py-3 bg-[#0f0f0f] border border-[#2a2a2a] rounded-3xl text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-1 focus:ring-[#c9a77c] transition-all">
                        <p class="text-[#8a8a8a] text-xs mt-1">Maximum {{ $room->capacity }} guests for this room type.</p>
                        @error('number_of_guests') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Special Requests -->
                    <div>
                        <label for="special_requests" class="block text-sm font-medium text-[#f5f5f0] mb-2">Special Requests <span class="text-[#8a8a8a] font-normal">(optional)</span></label>
                        <textarea name="special_requests" id="special_requests" rows="4"
                            placeholder="Any special requests or notes for your stay"
                            class="w-full px-4 py-3 bg-[#0f0f0f] border border-[#2a2a2a] rounded-3xl text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-1 focus:ring-[#c9a77c] transition-all">{{ old('special_requests') }}</textarea>
                        @error('special_requests') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="pt-4 border-t border-[#2a2a2a]">
                        <button type="submit"
                            class="w-full px-6 py-4 bg-[#c9a77c] text-[#0f0f0f] text-sm font-semibold tracking-wider rounded-3xl hover:bg-[#e8d5a7] transition-colors duration-300">
                            Continue to Payment
                        </button>
                    </div>
                </form>
            </div>

            <!-- Sidebar -->
            <aside class="space-y-6">

                <!-- Room Preview -->
                <div class="rounded-3xl border border-[#2a2a2a] bg-[#111111] overflow-hidden">
                    <div class="relative h-44 bg-[#111111]">
                        @if($room->image)
                            <img src="{{ asset('storage/' . $room->image) }}" alt="{{ $room->name }}"
                                 class="h-full w-full object-cover">
                        @else
                            <div class="h-full w-full flex items-center justify-center bg-gradient-to-br from-[#111111] to-[#1a1a1a]">
                                <span class="font-serif text-7xl uppercase tracking-[0.2em] text-[#c9a77c]/20">
                                    {{ strtoupper(substr($room->type, 0, 1)) }}
                                </span>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                    </div>
                    <div class="p-5">
                        <h3 class="font-serif text-xl text-[#f5f5f0] mb-1">{{ $room->type }}</h3>
                        <div class="flex gap-1 mb-3">
                            @for($i = 0; $i < 5; $i++)
                                <svg class="w-3.5 h-3.5 text-[#c9a77c]" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                            @endfor
                        </div>
                        <p class="text-[#8a8a8a] text-sm">Up to {{ $room->capacity }} guests</p>
                    </div>
                </div>

                <!-- Booking Summary -->
                <div class="rounded-3xl border border-[#2a2a2a] bg-[#111111] p-6">
                    <h2 class="font-serif text-xl text-[#f5f5f0] mb-5">Booking Summary</h2>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-[#8a8a8a]">Room Type</span>
                            <span class="text-[#f5f5f0]">{{ $room->type }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-[#8a8a8a]">Room Number</span>
                            <span class="text-[#f5f5f0]">#{{ $room->room_number }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-[#8a8a8a]">Price / night</span>
                            <span class="text-[#c9a77c] font-semibold">₱{{ number_format($room->price_per_night, 0) }}</span>
                        </div>
                        <div class="border-t border-[#2a2a2a] pt-3 flex justify-between">
                            <span class="text-[#8a8a8a]">Check-in</span>
                            <span id="summary-checkin" class="text-[#f5f5f0]">—</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-[#8a8a8a]">Check-out</span>
                            <span id="summary-checkout" class="text-[#f5f5f0]">—</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-[#8a8a8a]">Nights</span>
                            <span id="summary-nights" class="text-[#f5f5f0]">0</span>
                        </div>
                        <div class="border-t border-[#2a2a2a] pt-3 flex justify-between items-center">
                            <span class="text-[#8a8a8a]">Estimated Total</span>
                            <span id="summary-total" class="text-[#c9a77c] text-lg font-semibold">₱0</span>
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl border border-[#2a2a2a] bg-[#111111] p-6">
                    <h3 class="font-serif text-lg text-[#f5f5f0] mb-2">Luxury Details</h3>
                    <p class="text-[#8a8a8a] text-sm leading-relaxed">
                        Experience premium service, discreet check-in and bespoke room preparation.
                        Payment is secured and all bookings are managed within your private SEIN HELIOS profile.
                    </p>
                </div>
            </aside>
        </div>
    </div>

    <script>
        const pricePerNight = {{ $room->price_per_night }};
        const checkInInput  = document.getElementById('check_in');
        const checkOutInput = document.getElementById('check_out');

        function updateSummary() {
            const ci = checkInInput.value;
            const co = checkOutInput.value;
            const nights = (ci && co) ? Math.max(0, Math.ceil((new Date(co) - new Date(ci)) / 86400000)) : 0;
            document.getElementById('summary-checkin').textContent  = ci || '—';
            document.getElementById('summary-checkout').textContent = co || '—';
            document.getElementById('summary-nights').textContent   = nights;
            document.getElementById('summary-total').textContent    = nights > 0 ? '₱' + (nights * pricePerNight).toLocaleString() : '₱0';
        }

        checkInInput.addEventListener('change', updateSummary);
        checkOutInput.addEventListener('change', updateSummary);
        updateSummary();
    </script>
</x-app-layout>
