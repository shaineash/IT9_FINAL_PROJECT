<x-app-layout>
    <div class="max-w-5xl mx-auto px-6 py-8">
        <button onclick="history.back()" class="inline-flex items-center gap-2 px-4 py-2 bg-[#0f0f0f] border border-[#2a2a2a] text-[#f5f5f0] rounded-xl hover:border-[#c9a77c] hover:bg-[#c9a77c]/10 transition-colors duration-300 text-sm font-medium mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Go Back
        </button>

        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="font-serif text-3xl text-[#f5f5f0]">{{ $user->name }}'s Bookings</h1>
                <p class="text-[#8a8a8a] text-sm mt-1">{{ $user->email }}</p>
            </div>
            <a href="{{ route('admin.users.index') }}" class="px-6 py-2.5 border border-[#2a2a2a] text-[#f5f5f0] text-sm font-medium rounded-lg hover:border-[#c9a77c] transition-colors duration-300 inline-flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Users
            </a>
        </div>

        <!-- Bookings Table -->
        <div class="bg-[#1a1a1a] border border-[#2a2a2a] rounded-lg overflow-hidden">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-[#2a2a2a]">
                        <th class="px-6 py-4 text-left text-sm font-medium text-[#c9a77c]">ID</th>
                        <th class="px-6 py-4 text-left text-sm font-medium text-[#c9a77c]">Room</th>
                        <th class="px-6 py-4 text-left text-sm font-medium text-[#c9a77c]">Check-in</th>
                        <th class="px-6 py-4 text-left text-sm font-medium text-[#c9a77c]">Check-out</th>
                        <th class="px-6 py-4 text-left text-sm font-medium text-[#c9a77c]">Total</th>
                        <th class="px-6 py-4 text-left text-sm font-medium text-[#c9a77c]">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                        <tr class="border-b border-[#2a2a2a] hover:bg-[#0f0f0f]/50 transition-colors">
                            <td class="px-6 py-4 text-[#8a8a8a] text-sm">#{{ $booking->id }}</td>
                            <td class="px-6 py-4">
                                <p class="text-[#f5f5f0]">{{ $booking->room->name ?? 'Unknown' }}</p>
                                <p class="text-[#8a8a8a] text-xs">#{{ $booking->room->room_number ?? '' }}</p>
                            </td>
                            <td class="px-6 py-4 text-[#f5f5f0]">{{ \Carbon\Carbon::parse($booking->check_in)->format('M d, Y') }}</td>
                            <td class="px-6 py-4 text-[#f5f5f0]">{{ \Carbon\Carbon::parse($booking->check_out)->format('M d, Y') }}</td>
                            <td class="px-6 py-4 text-[#c9a77c]">₱{{ number_format($booking->total_price, 2) }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs font-medium rounded-full
                                    {{ $booking->status === 'confirmed' ? 'bg-green-500/10 text-green-500' : '' }}
                                    {{ $booking->status === 'pending' ? 'bg-yellow-500/10 text-yellow-500' : '' }}
                                    {{ $booking->status === 'cancelled' ? 'bg-red-500/10 text-red-500' : '' }}
                                    {{ $booking->status === 'checked_in' ? 'bg-blue-500/10 text-blue-500' : '' }}
                                    {{ $booking->status === 'checked_out' ? 'bg-gray-500/10 text-gray-500' : '' }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-[#8a8a8a]">No bookings found for this user.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
