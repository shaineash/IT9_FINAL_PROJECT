<x-app-layout>
    <div class="max-w-6xl mx-auto px-6 py-8">
        <button onclick="history.back()" class="inline-flex items-center gap-2 px-4 py-2 bg-[#0f0f0f] border border-[#2a2a2a] text-[#f5f5f0] rounded-xl hover:border-[#c9a77c] hover:bg-[#c9a77c]/10 transition-colors duration-300 text-sm font-medium mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Go Back
        </button>

        <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <a href="{{ route('user.bookings.room.create', $booking->room) }}" class="inline-flex items-center gap-2 text-[#8a8a8a] hover:text-[#f5f5f0] transition-colors mb-4 sm:mb-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Booking
                </a>
                <h1 class="font-serif text-3xl text-[#f5f5f0]">Complete Payment</h1>
            </div>
            <p class="text-[#8a8a8a] text-sm">Confirm your booking for {{ $booking->room->name }} with a secure payment process. Your stay is reserved once payment is successful.</p>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-8 gap-8">
            <main class="xl:col-span-5">
                <form method="POST" action="{{ route('user.bookings.payment.store', $booking) }}" class="luxury-form-card space-y-6">
                    @csrf

                    <div class="space-y-3">
                        <h2 class="font-serif text-xl text-[#f5f5f0]">Payment Method</h2>
                        <p class="text-[#8a8a8a] text-sm">Choose your preferred payment option and enter card details securely.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <label class="block text-sm text-[#f5f5f0]">
                            <span class="text-[#8a8a8a] mb-2 block">Payment Method</span>
                            <select name="payment_method" class="w-full px-4 py-3 bg-[#0f0f0f] border border-[#2a2a2a] rounded-3xl text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-1 focus:ring-[#c9a77c] transition-all">
                                <option value="card" selected>Credit / Debit Card</option>
                                <option value="paypal">PayPal</option>
                                <option value="bank_transfer">Bank Transfer</option>
                            </select>
                        </label>

                        <label class="block text-sm text-[#f5f5f0]">
                            <span class="text-[#8a8a8a] mb-2 block">Cardholder Name</span>
                            <input type="text" name="cardholder_name" value="{{ old('cardholder_name', $booking->guest_name) }}" required
                                class="w-full px-4 py-3 bg-[#0f0f0f] border border-[#2a2a2a] rounded-3xl text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-1 focus:ring-[#c9a77c] transition-all">
                            @error('cardholder_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </label>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <label class="block text-sm text-[#f5f5f0]">
                            <span class="text-[#8a8a8a] mb-2 block">Card Number</span>
                            <input type="text" name="card_number" value="{{ old('card_number') }}" inputmode="numeric" maxlength="19" placeholder="1234 5678 9012 3456" required
                                class="w-full px-4 py-3 bg-[#0f0f0f] border border-[#2a2a2a] rounded-3xl text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-1 focus:ring-[#c9a77c] transition-all">
                            @error('card_number') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </label>

                        <label class="block text-sm text-[#f5f5f0]">
                            <span class="text-[#8a8a8a] mb-2 block">Expiration Date</span>
                            <input type="text" name="expiration_date" value="{{ old('expiration_date') }}" placeholder="MM/YY" required
                                class="w-full px-4 py-3 bg-[#0f0f0f] border border-[#2a2a2a] rounded-3xl text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-1 focus:ring-[#c9a77c] transition-all">
                            @error('expiration_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </label>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <label class="block text-sm text-[#f5f5f0]">
                            <span class="text-[#8a8a8a] mb-2 block">CVV</span>
                            <input type="text" name="cvv" value="{{ old('cvv') }}" maxlength="4" placeholder="123" required
                                class="w-full px-4 py-3 bg-[#0f0f0f] border border-[#2a2a2a] rounded-3xl text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-1 focus:ring-[#c9a77c] transition-all">
                            @error('cvv') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </label>

                        <label class="block text-sm text-[#f5f5f0]">
                            <span class="text-[#8a8a8a] mb-2 block">Billing Address</span>
                            <input type="text" name="billing_address" value="{{ old('billing_address', $booking->guest_email) }}" placeholder="Street, city, postal code" required
                                class="w-full px-4 py-3 bg-[#0f0f0f] border border-[#2a2a2a] rounded-3xl text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-1 focus:ring-[#c9a77c] transition-all">
                            @error('billing_address') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </label>
                    </div>

                    <button type="submit" class="w-full px-6 py-3 bg-[#c9a77c] text-[#0f0f0f] text-sm font-semibold tracking-wider rounded-3xl hover:bg-[#e8d5a7] transition-colors duration-300">
                        Confirm Payment
                    </button>
                </form>
            </main>

            <aside class="xl:col-span-3 space-y-6">
                <div class="luxury-form-card p-6">
                    <h2 class="font-serif text-2xl text-[#f5f5f0] mb-4">Booking Summary</h2>
                    <div class="space-y-4 text-sm text-[#c9c9c9]">
                        <div class="grid grid-cols-2 gap-3">
                            <span class="text-[#8a8a8a]">Guest</span>
                            <span class="text-[#f5f5f0] text-right">{{ $booking->guest_name }}</span>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <span class="text-[#8a8a8a]">Email</span>
                            <span class="text-[#f5f5f0] text-right">{{ $booking->guest_email }}</span>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <span class="text-[#8a8a8a]">Room</span>
                            <span class="text-[#f5f5f0] text-right">{{ $booking->room->name }}</span>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <span class="text-[#8a8a8a]">Check-in</span>
                            <span class="text-[#f5f5f0] text-right">{{ $booking->check_in->format('M d, Y') }}</span>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <span class="text-[#8a8a8a]">Check-out</span>
                            <span class="text-[#f5f5f0] text-right">{{ $booking->check_out->format('M d, Y') }}</span>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <span class="text-[#8a8a8a]">Guests</span>
                            <span class="text-[#f5f5f0] text-right">{{ $booking->number_of_guests }}</span>
                        </div>
                        <div class="grid grid-cols-2 gap-3 pt-4 border-t border-[#2a2a2a]">
                            <span class="text-[#8a8a8a]">Total Amount</span>
                            <span class="text-[#c9a77c] text-right text-lg font-semibold">₱{{ number_format($booking->total_price, 0) }}</span>
                        </div>
                    </div>
                </div>

                <div class="luxury-form-card p-6 bg-[#111111]/90 border border-[#2a2a2a]">
                    <h3 class="font-serif text-lg text-[#f5f5f0] mb-3">Payment Security</h3>
                    <p class="text-[#8a8a8a] text-sm">All card information is passed securely and only the last four digits are stored for reference. CVV details are not retained.</p>
                </div>
            </aside>
        </div>
    </div>
</x-app-layout>
