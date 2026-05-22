<x-app-layout>
    <div class="max-w-5xl mx-auto px-6 py-8">
        <button onclick="history.back()" class="inline-flex items-center gap-2 px-4 py-2 bg-[#0f0f0f] border border-[#2a2a2a] text-[#f5f5f0] rounded-xl hover:border-[#c9a77c] hover:bg-[#c9a77c]/10 transition-colors duration-300 text-sm font-medium mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Go Back
        </button>

        <div class="mb-8">
            <h1 class="font-serif text-3xl text-[#f5f5f0]">My Bookings</h1>
            <p class="text-[#8a8a8a] text-sm mt-1">View and manage your reservations</p>
        </div>

        @if($bookings->count())
            <div class="space-y-6">
                @foreach($bookings as $booking)
                    <div class="bg-[#1a1a1a] border border-[#2a2a2a] rounded-lg overflow-hidden hover:border-[#c9a77c]/30 transition-colors duration-300">
                        <div class="grid grid-cols-1 md:grid-cols-4">
                            <!-- Room Image -->
                            <div class="md:col-span-1">
                                @if($booking->room && $booking->room->image)
                                    <img src="{{ asset('storage/' . $booking->room->image) }}" alt="{{ $booking->room->name }}" class="w-full h-full object-cover min-h-[200px]">
                                @else
                                    <div class="w-full h-full min-h-[200px] bg-[#2a2a2a] flex items-center justify-center">
                                        <span class="text-[#c9a77c] font-serif text-4xl">{{ substr($booking->room->name ?? 'R', 0, 1) }}</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Booking Details -->
                            <div class="md:col-span-3 p-6">
                                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                                    <div>
                                        <h3 class="font-serif text-xl text-[#f5f5f0] mb-1">{{ $booking->room->name ?? 'Unknown Room' }}</h3>
                                        <p class="text-[#8a8a8a] text-sm">Booking #{{ $booking->id }}</p>
                                    </div>
                                    <span class="px-4 py-2 text-sm font-medium rounded-full self-start md:self-auto
                                        {{ $booking->status === 'confirmed' ? 'bg-green-500/10 text-green-500' : '' }}
                                        {{ $booking->status === 'pending' ? 'bg-yellow-500/10 text-yellow-500' : '' }}
                                        {{ $booking->status === 'cancelled' ? 'bg-red-500/10 text-red-500' : '' }}
                                        {{ $booking->status === 'checked_in' ? 'bg-blue-500/10 text-blue-500' : '' }}
                                        {{ $booking->status === 'checked_out' ? 'bg-gray-500/10 text-gray-500' : '' }}">
                                        {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                                    </span>
                                </div>

                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 my-4">
                                    <div>
                                        <p class="text-[#8a8a8a] text-xs uppercase tracking-wider">Check-in</p>
                                        <p class="text-[#f5f5f0]">{{ \Carbon\Carbon::parse($booking->check_in)->format('M d, Y') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-[#8a8a8a] text-xs uppercase tracking-wider">Check-out</p>
                                        <p class="text-[#f5f5f0]">{{ \Carbon\Carbon::parse($booking->check_out)->format('M d, Y') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-[#8a8a8a] text-xs uppercase tracking-wider">Nights</p>
                                        <p class="text-[#f5f5f0]">{{ $booking->check_in->diffInDays($booking->check_out) }}</p>
                                    </div>
                                    <div>
                                        <p class="text-[#8a8a8a] text-xs uppercase tracking-wider">Guests</p>
                                        <p class="text-[#f5f5f0]">{{ $booking->number_of_guests }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between pt-4 border-t border-[#2a2a2a]">
                                    <div>
                                        <p class="text-[#8a8a8a] text-sm">Total Price</p>
                                        <p class="text-[#c9a77c] font-semibold text-lg">₱{{ number_format($booking->total_price, 2) }}</p>
                                    </div>
                                    <div class="flex gap-2">
                                        <a href="{{ route('user.bookings.show', $booking) }}" class="px-4 py-2 border border-[#2a2a2a] text-[#f5f5f0] text-sm rounded hover:border-[#c9a77c] hover:text-[#c9a77c] transition-colors">
                                            View Details
                                        </a>
                                        @if(in_array($booking->status, ['pending', 'confirmed']))
                                            <form method="POST" action="{{ route('user.bookings.cancel', $booking) }}" onsubmit="return confirm('Cancel this booking?')">
                                                @csrf
                                                <button type="submit" class="px-4 py-2 border border-red-500/50 text-red-500 text-sm rounded hover:bg-red-500/10 transition-colors">
                                                    Cancel
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $bookings->links() }}
            </div>
        @else
            <div class="bg-[#1a1a1a] border border-[#2a2a2a] rounded-lg p-12 text-center">
                <p class="text-[#8a8a8a] mb-4">You don't have any bookings yet.</p>
                <a href="{{ route('user.rooms.index') }}" class="inline-block px-6 py-2.5 bg-[#c9a77c] text-[#0f0f0f] text-sm font-medium rounded-lg hover:bg-[#e8d5a7] transition-colors">
                    Browse Rooms
                </a>
            </div>
        @endif
    </div>
</x-app-layout>
