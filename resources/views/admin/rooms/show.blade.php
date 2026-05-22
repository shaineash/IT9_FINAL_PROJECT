<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-serif text-2xl text-[#f5f5f0] tracking-wide">
                Room Details
            </h2>
            <div class="flex gap-3">
                <a href="{{ route('admin.rooms.edit', $room) }}"
                   class="inline-flex items-center gap-2 px-4 py-2 bg-[#c9a77c] text-[#0f0f0f] text-sm font-medium rounded-lg hover:bg-[#e8d5a7] transition-colors duration-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit Room
                </a>
                <a href="{{ route('admin.rooms.index') }}"
                   class="inline-flex items-center gap-2 px-4 py-2 border border-[#2a2a2a] text-[#f5f5f0] text-sm font-medium rounded-lg hover:border-[#c9a77c] transition-colors duration-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Rooms
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <button onclick="history.back()" class="inline-flex items-center gap-2 px-4 py-2 bg-[#0f0f0f] border border-[#2a2a2a] text-[#f5f5f0] rounded-xl hover:border-[#c9a77c] hover:bg-[#c9a77c]/10 transition-colors duration-300 text-sm font-medium mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Go Back
        </button>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Room Details Card -->
            <div class="luxury-form-card p-8">
                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Room Image -->
                    <div class="space-y-4">
                        @if($room->image)
                            <img src="{{ asset('storage/' . $room->image) }}"
                                 alt="{{ $room->name }}"
                                 class="w-full h-64 object-cover rounded-xl border border-[#2a2a2a]">
                        @else
                            <div class="w-full h-64 bg-[#1a1a1a] rounded-xl border border-[#2a2a2a] flex items-center justify-center">
                                <svg class="w-16 h-16 text-[#8a8a8a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <!-- Room Information -->
                    <div class="space-y-6">
                        <div>
                            <h3 class="font-serif text-2xl text-[#f5f5f0] mb-2">{{ $room->name }}</h3>
                            <p class="text-[#8a8a8a] text-sm">Room {{ $room->room_number }}</p>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-1">
                                <p class="text-xs font-medium text-[#8a8a8a] uppercase tracking-wider">Type</p>
                                <p class="text-[#f5f5f0] font-medium">{{ ucfirst($room->type) }}</p>
                            </div>
                            <div class="space-y-1">
                                <p class="text-xs font-medium text-[#8a8a8a] uppercase tracking-wider">Capacity</p>
                                <p class="text-[#f5f5f0] font-medium">{{ $room->capacity }} Guest{{ $room->capacity > 1 ? 's' : '' }}</p>
                            </div>
                            <div class="space-y-1">
                                <p class="text-xs font-medium text-[#8a8a8a] uppercase tracking-wider">Price/Night</p>
                                <p class="text-[#c9a77c] font-semibold text-lg">₱{{ number_format($room->price_per_night, 2) }}</p>
                            </div>
                            <div class="space-y-1">
                                <p class="text-xs font-medium text-[#8a8a8a] uppercase tracking-wider">Status</p>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($room->status === 'available') bg-green-500/10 text-green-400 border border-green-500/20
                                    @elseif($room->status === 'booked') bg-blue-500/10 text-blue-400 border border-blue-500/20
                                    @else bg-red-500/10 text-red-400 border border-red-500/20 @endif">
                                    {{ ucfirst($room->status) }}
                                </span>
                            </div>
                        </div>

                        @if($room->description)
                            <div class="space-y-2">
                                <p class="text-xs font-medium text-[#8a8a8a] uppercase tracking-wider">Description</p>
                                <p class="text-[#f5f5f0] leading-relaxed">{{ $room->description }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Recent Bookings -->
            <div class="mt-8">
                <h4 class="font-serif text-xl text-[#f5f5f0] mb-6">Recent Bookings</h4>
                <div class="luxury-form-card p-6">
                    @if($room->bookings->count() > 0)
                        <div class="space-y-4">
                            @foreach($room->bookings->take(5) as $booking)
                                <div class="flex items-center justify-between p-4 bg-[#0f0f0f] rounded-lg border border-[#2a2a2a]">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 bg-[#c9a77c]/10 rounded-full flex items-center justify-center">
                                            <svg class="w-5 h-5 text-[#c9a77c]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-[#f5f5f0] font-medium">{{ $booking->user->name }}</p>
                                            <p class="text-[#8a8a8a] text-sm">{{ $booking->check_in->format('M j') }} - {{ $booking->check_out->format('M j, Y') }}</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            @if($booking->status === 'confirmed') bg-green-500/10 text-green-400 border border-green-500/20
                                            @elseif($booking->status === 'pending') bg-yellow-500/10 text-yellow-400 border border-yellow-500/20
                                            @elseif($booking->status === 'checked_in') bg-blue-500/10 text-blue-400 border border-blue-500/20
                                            @elseif($booking->status === 'checked_out') bg-green-500/10 text-green-400 border border-green-500/20
                                            @else bg-red-500/10 text-red-400 border border-red-500/20 @endif">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                        <p class="text-[#c9a77c] text-sm font-medium mt-1">₱{{ number_format($booking->total_price, 2) }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @if($room->bookings->count() > 5)
                            <div class="mt-4 text-center">
                                <a href="{{ route('admin.bookings.index', ['room_id' => $room->id]) }}"
                                   class="text-[#c9a77c] hover:text-[#e8d5a7] text-sm font-medium transition-colors">
                                    View all bookings →
                                </a>
                            </div>
                        @endif
                    @else
                        <div class="text-center py-8">
                            <svg class="w-12 h-12 text-[#8a8a8a] mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            <p class="text-[#8a8a8a]">No bookings yet for this room.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>