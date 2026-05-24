<x-app-layout>
    <div class="max-w-6xl mx-auto px-6 py-8">
        <button onclick="history.back()" class="inline-flex items-center gap-2 px-4 py-2 bg-[#0f0f0f] border border-[#2a2a2a] text-[#f5f5f0] rounded-xl hover:border-[#c9a77c] hover:bg-[#c9a77c]/10 transition-colors duration-300 text-sm font-medium mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Go Back
        </button>
                    <div>
                        <label for="room_number" class="block text-sm font-medium text-[#f5f5f0] mb-2">Choose Room Number</label>
                        <select name="room_number" id="room_number" class="w-full px-4 py-3 bg-[#0f0f0f] border border-[#2a2a2a] rounded-3xl text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-1 focus:ring-[#c9a77c] transition-all">
                            <option value="" {{ old('room_number') ? '' : 'selected' }}>Auto-select next available room</option>
                            @foreach($typeRooms->where('status', 'available') as $availableRoom)
                                <option value="{{ $availableRoom->room_number }}" {{ old('room_number') == $availableRoom->room_number ? 'selected' : '' }}>
                                    {{ $availableRoom->room_number }} — {{ $availableRoom->name }}
                                </option>
                            @endforeach
                        </select>
                        <p class="text-[#8a8a8a] text-sm mt-2">Select a preferred available room number. Booked or unavailable rooms will not appear here.</p>
                        @error('room_number') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="guest_name" class="block text-sm font-medium text-[#f5f5f0] mb-2">Guest Full Name</label>
                            <input type="text" name="guest_name" id="guest_name" value="{{ old('guest_name', auth()->user()->name) }}" required
                                class="w-full px-4 py-3 bg-[#0f0f0f] border border-[#2a2a2a] rounded-3xl text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-1 focus:ring-[#c9a77c] transition-all">
                            @error('guest_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="guest_email" class="block text-sm font-medium text-[#f5f5f0] mb-2">Email Address</label>
                            <input type="email" name="guest_email" id="guest_email" value="{{ old('guest_email', auth()->user()->email) }}" required
                                class="w-full px-4 py-3 bg-[#0f0f0f] border border-[#2a2a2a] rounded-3xl text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-1 focus:ring-[#c9a77c] transition-all">
                            @error('guest_email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label for="contact_number" class="block text-sm font-medium text-[#f5f5f0] mb-2">Contact Number</label>
                        <input type="text" name="contact_number" id="contact_number" value="{{ old('contact_number') }}" placeholder="e.g. +1 555 123 4567" required
                            class="w-full px-4 py-3 bg-[#0f0f0f] border border-[#2a2a2a] rounded-3xl text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-1 focus:ring-[#c9a77c] transition-all">
                        @error('contact_number') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="check_in" class="block text-sm font-medium text-[#f5f5f0] mb-2">Check-in Date</label>
                            <input type="date" name="check_in" id="check_in" value="{{ old('check_in') }}" required min="{{ date('Y-m-d') }}"
                                class="w-full px-4 py-3 bg-[#0f0f0f] border border-[#2a2a2a] rounded-3xl text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-1 focus:ring-[#c9a77c] transition-all">
                            @error('check_in') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="check_out" class="block text-sm font-medium text-[#f5f5f0] mb-2">Check-out Date</label>
                            <input type="date" name="check_out" id="check_out" value="{{ old('check_out') }}" required
                                class="w-full px-4 py-3 bg-[#0f0f0f] border border-[#2a2a2a] rounded-3xl text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-1 focus:ring-[#c9a77c] transition-all">
                            @error('check_out') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="number_of_guests" class="block text-sm font-medium text-[#f5f5f0] mb-2">Number of Guests</label>
                            <input type="number" name="number_of_guests" id="number_of_guests" value="{{ old('number_of_guests', 1) }}" min="1" max="{{ $room->capacity }}" required
                                class="w-full px-4 py-3 bg-[#0f0f0f] border border-[#2a2a2a] rounded-3xl text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-1 focus:ring-[#c9a77c] transition-all">
                            @error('number_of_guests') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-[#f5f5f0] mb-2">Selected Room</label>
                            <div class="w-full px-4 py-3 bg-[#111111] border border-[#2a2a2a] rounded-3xl text-[#f5f5f0]">
                                <div class="font-medium">{{ $room->name }} — #{{ $room->room_number }}</div>
                                <div class="text-[#8a8a8a] text-sm">Booking this exact room for your stay.</div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="special_requests" class="block text-sm font-medium text-[#f5f5f0] mb-2">Special Requests</label>
                        <textarea name="special_requests" id="special_requests" rows="4" placeholder="Any special requests or notes for your stay"
                            class="w-full px-4 py-3 bg-[#0f0f0f] border border-[#2a2a2a] rounded-3xl text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-1 focus:ring-[#c9a77c] transition-all">{{ old('special_requests') }}</textarea>
                        @error('special_requests') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mt-4 pt-4 border-t border-[#2a2a2a]">
                        <button type="submit" class="w-full px-6 py-3 bg-[#c9a77c] text-[#0f0f0f] text-sm font-semibold tracking-wider rounded-3xl hover:bg-[#e8d5a7] transition-colors duration-300">
                            Continue to Payment
                        </button>
                    </div>
                </form>
            </div>

            <aside class="xl:col-span-3 space-y-6">
                <!-- Room preview card (mirrors Homepage 'ROOMS' card details) -->
                <div class="group luxury-room-card overflow-hidden border border-[#2a2a2a] bg-[#0f0f0f] shadow-[0_20px_40px_rgba(0,0,0,0.25)] transition duration-300 hover:border-[#c9a77c]/80 mb-4">
                    <div class="relative h-48 bg-[#111111] flex-shrink-0">
                        @if($room->image)
                            <img src="{{ asset('storage/' . $room->image) }}" alt="{{ $room->name ?? $room->type }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105" />
                        @else
                            <div class="h-full w-full flex items-center justify-center bg-gradient-to-br from-[#111111] to-[#1a1a1a]">
                                <span class="text-8xl font-serif uppercase tracking-[0.2em] text-[#c9a77c]/20">{{ strtoupper(substr($room->name ?? $room->type, 0, 1)) }}</span>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-b from-black/20 via-transparent to-transparent"></div>
                    </div>

                    <div class="p-4">
                        <h3 class="mt-2 font-serif text-2xl text-[#f5f5f0] leading-tight">{{ $room->name ?? $room->type }}</h3>
                        <div class="mt-3 flex items-center justify-between">
                            <div class="flex gap-1" aria-label="5 star rating">
                                @for($i = 0; $i < 5; $i++)
                                    <svg class="w-4 h-4 text-[#c9a77c]" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                @endfor
                            </div>
                            <div class="text-sm text-[#8a8a8a] uppercase tracking-[0.15em]">{{ $room->capacity ?? '—' }} guests</div>
                        </div>
                    </div>
                </div>

                <div class="luxury-form-card p-6">
                    <h2 class="font-serif text-2xl text-[#f5f5f0] mb-4">Booking Summary</h2>
                    <div class="space-y-4 text-sm text-[#c9c9c9]">
                        <div class="grid grid-cols-2 gap-3">
                            <span class="text-[#8a8a8a]">Room</span>
                            <span class="text-[#f5f5f0] text-right">{{ $room->name }}</span>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <span class="text-[#8a8a8a]">Type</span>
                            <span class="text-[#f5f5f0] text-right">{{ $room->type }}</span>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <span class="text-[#8a8a8a]">Room Number</span>
                            <span id="summary-room-number" class="text-[#f5f5f0] text-right">#{{ $room->room_number }}</span>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <span class="text-[#8a8a8a]">Price / night</span>
                            <span class="text-[#f5f5f0] text-right">₱{{ number_format($room->price_per_night, 0) }}</span>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <span class="text-[#8a8a8a]">Max Guests</span>
                            <span class="text-[#f5f5f0] text-right">{{ $room->capacity }}</span>
                        </div>
                        <div class="grid grid-cols-2 gap-3 pt-4 border-t border-[#2a2a2a]">
                            <span class="text-[#8a8a8a]">Check-in</span>
                            <span id="summary-checkin" class="text-[#f5f5f0] text-right">—</span>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <span class="text-[#8a8a8a]">Check-out</span>
                            <span id="summary-checkout" class="text-[#f5f5f0] text-right">—</span>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <span class="text-[#8a8a8a]">Nights</span>
                            <span id="summary-nights" class="text-[#f5f5f0] text-right">0</span>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <span class="text-[#8a8a8a]">Estimated Total</span>
                            <span id="summary-total" class="text-[#c9a77c] text-right text-lg font-semibold">₱0</span>
                        </div>
                    </div>
                </div>

                <div class="luxury-form-card p-6 bg-[#111111]/90 border border-[#2a2a2a]">
                    <h3 class="font-serif text-xl text-[#f5f5f0] mb-3">Luxury Details</h3>
                    <p class="text-[#8a8a8a] text-sm">Experience premium service, discreet check-in and bespoke room preparation. Payment is secured and all bookings are managed within your private SEIN HELIOS profile.</p>
                </div>
            </aside>
        </div>
    </div>

    <script>
        const pricePerNight = {{ $room->price_per_night }};
        const checkInInput = document.getElementById('check_in');
        const checkOutInput = document.getElementById('check_out');
        const summaryCheckin = document.getElementById('summary-checkin');
        const summaryCheckout = document.getElementById('summary-checkout');
        const summaryNights = document.getElementById('summary-nights');
        const summaryTotal = document.getElementById('summary-total');

        function calculateNights(checkIn, checkOut) {
            if (!checkIn || !checkOut) return 0;
            const start = new Date(checkIn);
            const end = new Date(checkOut);
            const diff = Math.ceil((end - start) / (1000 * 60 * 60 * 24));
            return diff > 0 ? diff : 0;
        }

        function updateSummary() {
            const checkIn = checkInInput.value;
            const checkOut = checkOutInput.value;
            const nights = calculateNights(checkIn, checkOut);
            summaryCheckin.textContent = checkIn || '—';
            summaryCheckout.textContent = checkOut || '—';
            summaryNights.textContent = nights;
            summaryTotal.textContent = nights > 0 ? '₱' + (nights * pricePerNight).toFixed(0) : '₱0';
        }

        [checkInInput, checkOutInput].forEach(input => {
            input.addEventListener('change', updateSummary);
        });

        updateSummary();
    </script>
</x-app-layout>
