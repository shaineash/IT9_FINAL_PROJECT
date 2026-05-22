<x-app-layout>
    <div class="max-w-4xl mx-auto px-6 py-8">
        <button onclick="history.back()" class="inline-flex items-center gap-2 px-4 py-2 bg-[#0f0f0f] border border-[#2a2a2a] text-[#f5f5f0] rounded-xl hover:border-[#c9a77c] hover:bg-[#c9a77c]/10 transition-colors duration-300 text-sm font-medium mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Go Back
        </button>

        <div class="mb-8">
            <h1 class="font-serif text-3xl text-[#f5f5f0]">Booking Confirmation</h1>
            <p class="text-[#8a8a8a] text-sm mt-1">Booking ID: #{{ $booking->id }}</p>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-500/10 border border-green-500/30 text-green-500 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-[#1a1a1a] border border-[#2a2a2a] rounded-lg p-6 mb-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="font-serif text-xl text-[#c9a77c]">Status</h2>
                <span class="px-4 py-2 text-sm font-medium rounded-full
                    {{ $booking->status === 'confirmed' ? 'bg-green-500/10 text-green-500' : '' }}
                    {{ $booking->status === 'pending' ? 'bg-yellow-500/10 text-yellow-500' : '' }}
                    {{ $booking->status === 'cancelled' ? 'bg-red-500/10 text-red-500' : '' }}
                    {{ $booking->status === 'checked_in' ? 'bg-blue-500/10 text-blue-500' : '' }}
                    {{ $booking->status === 'checked_out' ? 'bg-gray-500/10 text-gray-500' : '' }}">
                    {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                </span>
            </div>

            @if($booking->status === 'pending')
                <div class="bg-yellow-500/10 border border-yellow-500/30 text-yellow-500 p-4 rounded-lg mb-6">
                    <p class="text-sm">Your booking is pending confirmation. We'll notify you once it's approved.</p>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-[#f5f5f0] font-medium mb-4">Stay Details</h3>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-[#8a8a8a]">Check-in</span>
                            <span class="text-[#f5f5f0]">{{ \Carbon\Carbon::parse($booking->check_in)->format('M d, Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-[#8a8a8a]">Check-out</span>
                            <span class="text-[#f5f5f0]">{{ \Carbon\Carbon::parse($booking->check_out)->format('M d, Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-[#8a8a8a]">Nights</span>
                            <span class="text-[#f5f5f0]">{{ $booking->check_in->diffInDays($booking->check_out) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-[#8a8a8a]">Guests</span>
                            <span class="text-[#f5f5f0]">{{ $booking->number_of_guests }}</span>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-[#f5f5f0] font-medium mb-4">Room Information</h3>
                    <div class="space-y-3 text-sm">
                        @if($booking->room)
                            <div class="flex justify-between">
                                <span class="text-[#8a8a8a]">Room</span>
                                <span class="text-[#f5f5f0]">{{ $booking->room->name }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-[#8a8a8a]">Type</span>
                                <span class="text-[#f5f5f0]">{{ $booking->room->type }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-[#8a8a8a]">Room #</span>
                                <span class="text-[#f5f5f0]">{{ $booking->room->room_number }}</span>
                            </div>
                        @else
                            <p class="text-[#8a8a8a]">Room information not available.</p>
                        @endif
                    </div>
                </div>
            </div>

            @if($booking->special_requests)
                <div class="mt-6 pt-6 border-t border-[#2a2a2a]">
                    <h3 class="text-[#f5f5f0] font-medium mb-2">Special Requests</h3>
                    <p class="text-[#8a8a8a] text-sm">{{ $booking->special_requests }}</p>
                </div>
            @endif

            <div class="mt-6 pt-6 border-t border-[#2a2a2a] text-right">
                <p class="text-[#8a8a8a] text-sm">Total Amount</p>
                <p class="font-serif text-3xl text-[#c9a77c]">₱{{ number_format($booking->total_price, 2) }}</p>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row gap-4">
            @if($booking->status === 'pending' && !$booking->payment)
                <a href="{{ route('user.bookings.payment.create', $booking) }}" class="w-full sm:w-auto px-6 py-3 bg-[#c9a77c] text-[#0f0f0f] text-sm font-medium rounded-lg hover:bg-[#e8d5a7] transition-colors text-center">
                    Complete Payment
                </a>
            @endif

            @if(in_array($booking->status, ['pending', 'confirmed']))
                <form method="POST" action="{{ route('user.bookings.cancel', $booking) }}" onsubmit="return confirm('Are you sure you want to cancel this booking?')">
                    @csrf
                    <button type="submit" class="w-full sm:w-auto px-6 py-3 border border-red-500/50 text-red-500 text-sm font-medium rounded-lg hover:bg-red-500/10 transition-colors">
                        Cancel Booking
                    </button>
                </form>
            @endif
            <a href="{{ route('user.bookings.index') }}" class="w-full sm:w-auto px-6 py-3 bg-[#c9a77c] text-[#0f0f0f] text-sm font-medium rounded-lg hover:bg-[#e8d5a7] transition-colors text-center">
                Back to Bookings
            </a>
        </div>
    </div>
</x-app-layout>
