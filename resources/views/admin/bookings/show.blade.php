<x-app-layout>
    <div class="max-w-4xl mx-auto px-6 py-8">
        @if(session('success'))
            <div id="booking-success-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-[#0f0f0f]/70 px-4 py-6 opacity-0 pointer-events-none transition-opacity duration-300" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="w-full max-w-md rounded-[28px] border border-[#c9a77c] bg-[#121212] p-6 text-[#f5f5f0] shadow-[0_24px_80px_-40px_rgba(0,0,0,0.9)]">
                    <h2 id="modal-title" class="text-3xl font-semibold leading-tight">Booking updated successfully!</h2>
                    <div class="mt-6 flex justify-end">
                        <button id="booking-success-ok" type="button" class="rounded-full border border-[#c9a77c] bg-[#121212] px-6 py-3 text-sm font-semibold text-[#f5f5f0] transition hover:bg-[#c9a77c] hover:text-[#0f0f0f]">OK</button>
                    </div>
                </div>
            </div>
        @endif

        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-[#0f0f0f] border border-[#2a2a2a] text-[#f5f5f0] rounded-xl hover:border-[#c9a77c] hover:bg-[#c9a77c]/10 transition-colors duration-300 text-sm font-medium mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Go Back
        </a>

        <div class="mb-8">
            <h1 class="font-serif text-3xl text-[#f5f5f0]">Booking Details</h1>
            <p class="text-[#8a8a8a] text-sm mt-1">Booking ID: #{{ $booking->id }}</p>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
            <!-- Booking Info -->
            <div class="bg-[#1a1a1a] border border-[#2a2a2a] rounded-lg p-6">
                <h2 class="font-serif text-xl text-[#c9a77c] mb-4">Booking Information</h2>
                <form id="booking-update-form" action="{{ route('admin.bookings.update', $booking) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="check_in" value="{{ $booking->check_in->format('Y-m-d') }}">

                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-[#8a8a8a]">Status</span>
                            <span class="px-3 py-1 text-xs font-medium rounded-full
                                {{ $booking->status === 'confirmed' ? 'bg-green-500/10 text-green-500' : '' }}
                                {{ $booking->status === 'pending' ? 'bg-yellow-500/10 text-yellow-500' : '' }}
                                {{ $booking->status === 'cancelled' ? 'bg-red-500/10 text-red-500' : '' }}
                                {{ $booking->status === 'checked_in' ? 'bg-blue-500/10 text-blue-500' : '' }}
                                {{ $booking->status === 'checked_out' ? 'bg-gray-500/10 text-gray-500' : '' }}">
                                {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-[#8a8a8a]">Check-in</span>
                            <span class="text-[#f5f5f0]">{{ $booking->check_in->format('M d, Y') }}</span>
                        </div>

                        <div class="grid gap-4 sm:grid-cols-2">
                            <div>
                                <label class="luxury-form-label block mb-2" for="check_out">Check-out</label>
                                <input id="check_out" type="date" name="check_out" value="{{ $booking->check_out->format('Y-m-d') }}" min="{{ $booking->check_in->format('Y-m-d') }}" class="luxury-form-select w-full bg-[#2a2a2a] text-[#f5f5f0] border border-[#3b3b3b]" required>
                            </div>
                            <div>
                                <label class="luxury-form-label block mb-2" for="number_of_guests">Guests</label>
                                <input id="number_of_guests" type="number" name="number_of_guests" value="{{ $booking->number_of_guests }}" min="1" max="{{ $booking->room->capacity ?? 20 }}" class="luxury-form-select w-full bg-[#2a2a2a] text-[#f5f5f0] border border-[#3b3b3b]" required>
                            </div>
                        </div>

                        <div class="grid gap-4 sm:grid-cols-2">
                            <div class="space-y-1">
                                <span class="text-[#8a8a8a]">Nights</span>
                                <p id="booking-nights" class="text-[#f5f5f0] text-lg font-semibold">{{ $booking->check_in->diffInDays($booking->check_out) }}</p>
                            </div>
                            <div class="space-y-1">
                                <span class="text-[#8a8a8a]">Total</span>
                                <p id="booking-total" class="text-[#c9a77c] text-lg font-semibold">₱{{ number_format($booking->total_price, 2) }}</p>
                            </div>
                        </div>

                        <div>
                            <label class="luxury-form-label block mb-2" for="status">Update Status</label>
                            <select id="status" name="status" class="luxury-form-select w-full bg-[#2a2a2a] text-[#f5f5f0] border border-[#3b3b3b]">
                                <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="checked_in" {{ $booking->status == 'checked_in' ? 'selected' : '' }}>Checked In</option>
                                <option value="checked_out" {{ $booking->status == 'checked_out' ? 'selected' : '' }}>Checked Out</option>
                                <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-lg bg-[#c9a77c] px-5 py-3 text-sm font-semibold text-[#0f0f0f] hover:bg-[#d1b26b] transition-colors duration-300">
                            Update Booking
                        </button>

                        @if($booking->status === 'pending')
                            <a href="{{ route('admin.payments.process', $booking) }}" class="inline-flex items-center justify-center rounded-lg border border-[#2a2a2a] bg-[#0f0f0f] px-5 py-3 text-sm font-semibold text-[#f5f5f0] hover:border-[#c9a77c] hover:bg-[#c9a77c]/10 transition">
                                Process Payment
                            </a>
                        @endif
                    </div>
                </form>

                @if($booking->special_requests)
                    <div class="mt-6 pt-4 border-t border-[#2a2a2a]">
                        <h3 class="text-sm font-medium text-[#f5f5f0] mb-2">Special Requests</h3>
                        <p class="text-[#8a8a8a] text-sm">{{ $booking->special_requests }}</p>
                    </div>
                @endif
            </div>

            <!-- Guest & Room Info -->
            <div class="space-y-6">
                <!-- Guest -->
                <div class="bg-[#1a1a1a] border border-[#2a2a2a] rounded-lg p-6">
                    <h2 class="font-serif text-xl text-[#c9a77c] mb-4">Guest Information</h2>
                    <div class="space-y-3">
                        <p class="text-[#f5f5f0] font-medium">{{ $booking->guest_name ?? $booking->user->name ?? 'Unknown Guest' }}</p>
                        <p class="text-[#8a8a8a] text-sm">{{ $booking->guest_email ?? $booking->user->email ?? 'No email available' }}</p>
                        <p class="text-[#8a8a8a] text-sm">{{ $booking->contact_number ?? 'No phone number provided' }}</p>
                        @if($booking->user)
                            <p class="text-[#8a8a8a] text-sm mt-2">Account: {{ $booking->user->name }} (ID #{{ $booking->user->id }})</p>
                        @endif
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Room -->
                    <div class="bg-[#1a1a1a] border border-[#2a2a2a] rounded-3xl p-6">
                        <h2 class="font-serif text-xl text-[#c9a77c] mb-5">Room Details</h2>
                        @if($booking->room)
                            <div class="space-y-4">
                                <p class="text-[#f5f5f0] text-2xl font-semibold leading-tight break-words overflow-hidden">{{ $booking->room->name }}</p>
                                <div class="space-y-3 text-sm">
                                    <div class="space-y-1">
                                        <span class="text-[#c9a77c] uppercase tracking-[0.2em] text-[10px]">Type</span>
                                        <p class="text-[#f5f5f0] leading-snug break-words">{{ $booking->room->type }}</p>
                                    </div>
                                    <div class="space-y-1">
                                        <span class="text-[#c9a77c] uppercase tracking-[0.2em] text-[10px]">Room #</span>
                                        <p class="text-[#f5f5f0] leading-snug break-words">{{ $booking->room->room_number }}</p>
                                    </div>
                                </div>
                                <div class="pt-3 border-t border-[#2a2a2a]">
                                    <p class="text-[#c9a77c] text-sm uppercase tracking-[0.2em] mb-1">Price/night</p>
                                    <p class="text-[#f5f5f0] text-lg font-semibold">₱{{ number_format($booking->room->price_per_night, 2) }}</p>
                                </div>
                            </div>
                        @else
                            <p class="text-[#8a8a8a]">Room no longer exists</p>
                        @endif
                    </div>

                    <!-- Payment -->
                    <div class="bg-[#1a1a1a] border border-[#2a2a2a] rounded-3xl p-6">
                        <h2 class="font-serif text-xl text-[#c9a77c] mb-5">Payment Summary</h2>
                        <div class="space-y-4 text-sm">
                            <div class="grid grid-cols-[1fr_auto] items-center gap-x-4 gap-y-2">
                                <span class="text-[#8a8a8a]">Payment Status</span>
                                <span class="flex-shrink-0 px-3 py-1 text-xs font-medium rounded-full {{ $booking->payment ? ($booking->payment->status === 'completed' ? 'bg-green-500/10 text-green-500' : ($booking->payment->status === 'pending' ? 'bg-yellow-500/10 text-yellow-500' : 'bg-red-500/10 text-red-500')) : 'bg-gray-500/10 text-gray-400' }}">
                                    {{ $booking->payment->status ?? 'Not Available' }}
                                </span>
                                <span class="text-[#8a8a8a]">Amount</span>
                                <span id="payment-amount" class="text-[#f5f5f0]">₱{{ number_format($booking->payment->amount ?? $booking->total_price, 2) }}</span>
                                <span class="text-[#8a8a8a]">Method</span>
                                <span class="text-[#f5f5f0]">{{ ucfirst($booking->payment->payment_method ?? 'N/A') }}</span>
                                <span class="text-[#8a8a8a]">Reference</span>
                                <span class="text-[#f5f5f0]">{{ $booking->payment->transaction_reference ?? '—' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkInDate = new Date('{{ $booking->check_in->format('Y-m-d') }}');
            const checkOutInput = document.getElementById('check_out');
            const nightsEl = document.getElementById('booking-nights');
            const totalEl = document.getElementById('booking-total');
            const paymentAmountEl = document.getElementById('payment-amount');
            const roomPrice = {{ $booking->room->price_per_night ?? 0 }};
            const paymentExists = {{ $booking->payment ? 'true' : 'false' }};
            const bookingSuccessModal = document.getElementById('booking-success-modal');
            const bookingSuccessOk = document.getElementById('booking-success-ok');

            function updateTotals() {
                const checkOutDate = new Date(checkOutInput.value);
                let nights = Math.max(1, Math.ceil((checkOutDate - checkInDate) / (1000 * 60 * 60 * 24)));
                if (isNaN(nights) || nights < 1) {
                    nights = 1;
                }
                const total = nights * roomPrice;
                nightsEl.textContent = nights;
                totalEl.textContent = total.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2, style: 'currency', currency: 'PHP' }).replace('PHP', '₱');

                if (!paymentExists && paymentAmountEl) {
                    paymentAmountEl.textContent = total.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2, style: 'currency', currency: 'PHP' }).replace('PHP', '₱');
                }
            }

            if (bookingSuccessModal) {
                bookingSuccessModal.classList.remove('opacity-0', 'pointer-events-none');
                bookingSuccessModal.classList.add('opacity-100');

                const hideModal = () => {
                    bookingSuccessModal.classList.remove('opacity-100');
                    bookingSuccessModal.classList.add('opacity-0', 'pointer-events-none');
                };

                bookingSuccessOk?.addEventListener('click', hideModal);
                bookingSuccessModal.addEventListener('click', (event) => {
                    if (event.target === bookingSuccessModal) {
                        hideModal();
                    }
                });
            }

            checkOutInput.addEventListener('change', updateTotals);
            updateTotals();
        });
    </script>
</x-app-layout>
