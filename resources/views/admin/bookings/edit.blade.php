<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-serif text-2xl text-[#f5f5f0] tracking-wide">
                Edit Booking #{{ $booking->id }}
            </h2>
            <div class="flex gap-3">
                <a href="{{ route('admin.bookings.show', $booking) }}"
                   class="inline-flex items-center gap-2 px-4 py-2 border border-[#2a2a2a] text-[#f5f5f0] text-sm font-medium rounded-lg hover:border-[#c9a77c] transition-colors duration-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    View Details
                </a>
                <a href="{{ route('admin.bookings.index') }}"
                   class="inline-flex items-center gap-2 px-4 py-2 border border-[#2a2a2a] text-[#f5f5f0] text-sm font-medium rounded-lg hover:border-[#c9a77c] transition-colors duration-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Bookings
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-[#0f0f0f] border border-[#2a2a2a] text-[#f5f5f0] rounded-xl hover:border-[#c9a77c] hover:bg-[#c9a77c]/10 transition-colors duration-300 text-sm font-medium mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Go Back
        </a>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="luxury-form-card p-8">
                <!-- Guest & Room Info -->
                <div class="mb-8 p-6 bg-[#0f0f0f] rounded-xl border border-[#2a2a2a]">
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div>
                            <h3 class="font-serif text-lg text-[#c9a77c] mb-3">Guest Information</h3>
                            <div class="space-y-2">
                                <p class="text-[#f5f5f0] font-medium">{{ $booking->guest_name ?? $booking->user->name ?? 'Unknown Guest' }}</p>
                                <p class="text-[#8a8a8a] text-sm">{{ $booking->guest_email ?? $booking->user->email ?? 'No email available' }}</p>
                                <p class="text-[#8a8a8a] text-sm">{{ $booking->contact_number ?? 'No phone number provided' }}</p>
                                @if($booking->user)
                                    <p class="text-[#8a8a8a] text-sm mt-2">Account ID: #{{ $booking->user->id }}</p>
                                @endif
                            </div>
                        </div>
                        <div>
                            <h3 class="font-serif text-lg text-[#c9a77c] mb-3">Room Information</h3>
                            <div class="space-y-2">
                                <p class="text-[#f5f5f0] font-medium">{{ $booking->room->name }}</p>
                                <p class="text-[#8a8a8a] text-sm">Type: {{ $booking->room->type }}</p>
                                <p class="text-[#8a8a8a] text-sm">Room #{{ $booking->room->room_number }}</p>
                                <p class="text-[#c9a77c] mt-1">₱{{ number_format($booking->room->price_per_night, 2) }}/night</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Form -->
                <form method="POST" action="{{ route('admin.bookings.update', $booking) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Dates -->
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="check_in" class="text-xs font-medium text-[#8a8a8a] uppercase tracking-wider ml-1">
                                Check-in Date
                            </label>
                            <input
                                id="check_in"
                                name="check_in"
                                type="date"
                                required
                                class="block w-full px-4 py-3.5 bg-[#0f0f0f] border border-[#2a2a2a] rounded-xl text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-2 focus:ring-[#c9a77c]/20 transition-all duration-300 hover:border-[#3a3a3a]"
                                value="{{ $booking->check_in->format('Y-m-d') }}"
                            >
                            @error('check_in')
                                <p class="mt-1 text-xs text-red-400 ml-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="check_out" class="text-xs font-medium text-[#8a8a8a] uppercase tracking-wider ml-1">
                                Check-out Date
                            </label>
                            <input
                                id="check_out"
                                name="check_out"
                                type="date"
                                required
                                class="block w-full px-4 py-3.5 bg-[#0f0f0f] border border-[#2a2a2a] rounded-xl text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-2 focus:ring-[#c9a77c]/20 transition-all duration-300 hover:border-[#3a3a3a]"
                                value="{{ $booking->check_out->format('Y-m-d') }}"
                            >
                            @error('check_out')
                                <p class="mt-1 text-xs text-red-400 ml-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Guest Count & Status -->
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="number_of_guests" class="text-xs font-medium text-[#8a8a8a] uppercase tracking-wider ml-1">
                                Number of Guests
                            </label>
                            <select
                                id="number_of_guests"
                                name="number_of_guests"
                                required
                                class="block w-full px-4 py-3.5 bg-[#0f0f0f] border border-[#2a2a2a] rounded-xl text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-2 focus:ring-[#c9a77c]/20 transition-all duration-300 hover:border-[#3a3a3a] appearance-none cursor-pointer"
                            >
                                @for($i = 1; $i <= $booking->room->capacity; $i++)
                                    <option value="{{ $i }}" {{ $booking->number_of_guests == $i ? 'selected' : '' }}>
                                        {{ $i }} Guest{{ $i > 1 ? 's' : '' }}
                                    </option>
                                @endfor
                            </select>
                            @error('number_of_guests')
                                <p class="mt-1 text-xs text-red-400 ml-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="status" class="text-xs font-medium text-[#8a8a8a] uppercase tracking-wider ml-1">
                                Booking Status
                            </label>
                            <select
                                id="status"
                                name="status"
                                required
                                class="block w-full px-4 py-3.5 bg-[#0f0f0f] border border-[#2a2a2a] rounded-xl text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-2 focus:ring-[#c9a77c]/20 transition-all duration-300 hover:border-[#3a3a3a] appearance-none cursor-pointer"
                            >
                                <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="checked_in" {{ $booking->status == 'checked_in' ? 'selected' : '' }}>Checked In</option>
                                <option value="checked_out" {{ $booking->status == 'checked_out' ? 'selected' : '' }}>Checked Out</option>
                                <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-xs text-red-400 ml-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Special Requests -->
                    <div class="space-y-2">
                        <label for="special_requests" class="text-xs font-medium text-[#8a8a8a] uppercase tracking-wider ml-1">
                            Special Requests
                        </label>
                        <textarea
                            id="special_requests"
                            name="special_requests"
                            rows="4"
                            class="block w-full px-4 py-3.5 bg-[#0f0f0f] border border-[#2a2a2a] rounded-xl text-[#f5f5f0] placeholder-[#4a4a4a] focus:outline-none focus:border-[#c9a77c] focus:ring-2 focus:ring-[#c9a77c]/20 transition-all duration-300 hover:border-[#3a3a3a] resize-none"
                            placeholder="Any special requests or notes..."
                        >{{ old('special_requests', $booking->special_requests) }}</textarea>
                        @error('special_requests')
                            <p class="mt-1 text-xs text-red-400 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Price Calculation Info -->
                    <div class="p-4 bg-[#0f0f0f] rounded-xl border border-[#2a2a2a]">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-[#8a8a8a] text-sm">Price per night: <span class="text-[#f5f5f0]">₱{{ number_format($booking->room->price_per_night, 2) }}</span></p>
                                <p class="text-[#8a8a8a] text-sm">Nights: <span class="text-[#f5f5f0]" id="nights-count">{{ $booking->check_in->diffInDays($booking->check_out) }}</span></p>
                            </div>
                            <div class="text-right">
                                <p class="text-[#8a8a8a] text-sm">Total Price</p>
                                <p class="text-[#c9a77c] text-xl font-semibold" id="total-price">₱{{ number_format($booking->total_price, 2) }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex gap-4 pt-6 border-t border-[#2a2a2a]">
                        <button
                            type="submit"
                            class="flex-1 group relative overflow-hidden py-4 px-6 rounded-xl shadow-lg transition-all duration-300 transform hover:scale-[1.01] active:scale-100"
                        >
                            <div class="absolute inset-0 bg-gradient-to-r from-[#c9a77c] via-[#d4af87] to-[#c9a77c] bg-[length:200%_100%] animate-shimmer"></div>
                            <div class="absolute inset-0 bg-gradient-to-r from-[#e8d5a7] to-[#c9a77c] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                            <span class="relative flex items-center justify-center gap-3 text-[#0f0f0f] font-semibold text-sm tracking-wider uppercase">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Update Booking
                            </span>
                        </button>

                        <a href="{{ route('admin.bookings.show', $booking) }}"
                           class="px-6 py-4 border border-[#2a2a2a] text-[#f5f5f0] rounded-xl hover:border-[#c9a77c] transition-colors duration-300 text-center">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Auto-calculate price when dates change
        document.getElementById('check_in').addEventListener('change', calculatePrice);
        document.getElementById('check_out').addEventListener('change', calculatePrice);

        function calculatePrice() {
            const checkIn = new Date(document.getElementById('check_in').value);
            const checkOut = new Date(document.getElementById('check_out').value);
            const pricePerNight = {{ $booking->room->price_per_night }};

            if (checkIn && checkOut && checkOut > checkIn) {
                const nights = Math.ceil((checkOut - checkIn) / (1000 * 60 * 60 * 24));
                const total = nights * pricePerNight;

                document.getElementById('nights-count').textContent = nights;
                document.getElementById('total-price').textContent = '₱' + total.toFixed(2);
            }
        }
    </script>
</x-app-layout>