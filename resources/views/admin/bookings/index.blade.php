<x-app-layout>
    <div class="max-w-7xl mx-auto px-6 py-8">
        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-[#0f0f0f] border border-[#2a2a2a] text-[#f5f5f0] rounded-xl hover:border-[#c9a77c] hover:bg-[#c9a77c]/10 transition-colors duration-300 text-sm font-medium mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Go Back
        </a>

        <!-- Header -->
        <div class="mb-8">
            <h1 class="font-serif text-3xl text-[#f5f5f0]">Manage Bookings</h1>
            <p class="text-[#8a8a8a] text-sm mt-1">View and manage all customer bookings</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6 text-sm text-[#f5f5f0]">
            <div class="px-4 py-4 rounded-xl bg-[#0f0f0f] border border-[#2a2a2a]">
                <p class="text-[#8a8a8a] uppercase tracking-[0.15em] text-xs">Total Check-ins Today</p>
                <p class="mt-2 text-lg font-semibold text-[#c9a77c]">{{ $totalCheckinsToday }}</p>
            </div>
            <div class="px-4 py-4 rounded-xl bg-[#0f0f0f] border border-[#2a2a2a]">
                <p class="text-[#8a8a8a] uppercase tracking-[0.15em] text-xs">Total Bookings</p>
                <p class="mt-2 text-lg font-semibold text-[#c9a77c]">{{ $totalBookings }}</p>
            </div>
            <div class="px-4 py-4 rounded-xl bg-[#0f0f0f] border border-[#2a2a2a]">
                <p class="text-[#8a8a8a] uppercase tracking-[0.15em] text-xs">Revenue</p>
                <p class="mt-2 text-lg font-semibold text-[#c9a77c]">₱{{ number_format($revenue, 2) }}</p>
            </div>
        </div>

        <div class="flex flex-wrap gap-3 mb-6">
            @foreach([
                'all' => ['label' => 'All', 'count' => $totalBookings],
                'pending' => ['label' => 'Pending', 'count' => $pendingCount],
                'confirmed' => ['label' => 'Confirmed', 'count' => $confirmedCount],
                'checked_in' => ['label' => 'Check-in', 'count' => $checkedInCount],
                'checked_out' => ['label' => 'Check-out', 'count' => $checkedOutCount],
                'cancelled' => ['label' => 'Cancelled', 'count' => $cancelledCount],
            ] as $status => $data)
                @php
                    $isActive = request('status') === $status || ($status === 'all' && ! request()->filled('status'));
                @endphp
                <a href="{{ $status === 'all' ? route('admin.bookings.index') : route('admin.bookings.index', ['status' => $status]) }}"
                   class="inline-flex items-center gap-3 rounded-3xl px-4 py-3 text-sm font-medium transition border {{ $isActive ? 'border-[#c9a77c] bg-[#c9a77c]/10 text-[#f5f5f0]' : 'border-transparent text-[#8a8a8a] hover:text-[#f5f5f0] hover:bg-[#1a1a1a]' }}">
                    <span>{{ $data['label'] }}</span>
                    <span class="rounded-full bg-[#c9a77c]/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-[#c9a77c]">{{ $data['count'] }}</span>
                </a>
            @endforeach
        </div>

        <!-- Bookings Table -->
        <div class="bg-[#1a1a1a] border border-[#2a2a2a] rounded-lg overflow-hidden">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-[#2a2a2a]">
                        <th class="px-6 py-4 text-left text-sm font-medium text-[#c9a77c]">ID</th>
                        <th class="px-6 py-4 text-left text-sm font-medium text-[#c9a77c]">Guest</th>
                        <th class="px-6 py-4 text-left text-sm font-medium text-[#c9a77c]">Room</th>
                        <th class="px-6 py-4 text-left text-sm font-medium text-[#c9a77c]">Check-in</th>
                        <th class="px-6 py-4 text-left text-sm font-medium text-[#c9a77c]">Check-out</th>
                        <th class="px-6 py-4 text-left text-sm font-medium text-[#c9a77c]">Total</th>
                        <th class="px-6 py-4 text-left text-sm font-medium text-[#c9a77c]">Paid</th>
                        <th class="px-6 py-4 text-left text-sm font-medium text-[#c9a77c]">Status</th>
                        <th class="px-6 py-4 text-left text-sm font-medium text-[#c9a77c]">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                        <tr class="border-b border-[#2a2a2a] hover:bg-[#0f0f0f]/50 transition-colors">
                            <td class="px-6 py-4 text-[#8a8a8a] text-sm">#{{ $booking->id }}</td>
                            <td class="px-6 py-4">
                                <p class="text-[#f5f5f0]">{{ $booking->user->name ?? 'Unknown' }}</p>
                                <p class="text-[#8a8a8a] text-xs">{{ $booking->user->email ?? '' }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-[#f5f5f0]">{{ $booking->room->name ?? 'Unknown' }}</p>
                                <p class="text-[#8a8a8a] text-xs">#{{ $booking->room->room_number ?? '' }}</p>
                            </td>
                            <td class="px-6 py-4 text-[#f5f5f0]">{{ \Carbon\Carbon::parse($booking->check_in)->format('M d, Y') }}</td>
                            <td class="px-6 py-4 text-[#f5f5f0]">{{ \Carbon\Carbon::parse($booking->check_out)->format('M d, Y') }}</td>
                            <td class="px-6 py-4 text-[#c9a77c] font-medium">₱{{ number_format($booking->total_price, 2) }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs font-medium rounded-full {{ $booking->payment && $booking->payment->status === 'completed' ? 'bg-green-500/10 text-green-500' : 'bg-yellow-500/10 text-yellow-500' }}">
                                    {{ $booking->payment && $booking->payment->status === 'completed' ? 'Paid' : 'Pending' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center justify-center min-w-max px-3 py-1 text-xs font-medium rounded-full whitespace-nowrap
                                    {{ $booking->status === 'pending' ? 'bg-yellow-500/10 text-yellow-500' : '' }}
                                    {{ $booking->status === 'confirmed' ? 'bg-blue-500/10 text-blue-500' : '' }}
                                    {{ $booking->status === 'checked_in' ? 'bg-green-500/10 text-green-500' : '' }}
                                    {{ $booking->status === 'checked_out' ? 'bg-gray-500/10 text-gray-500' : '' }}
                                    {{ $booking->status === 'cancelled' ? 'bg-red-500/10 text-red-500' : '' }}">
                                    {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 flex items-center gap-2">
                                <a href="{{ route('admin.bookings.show', $booking) }}" class="inline-flex items-center justify-center w-9 h-9 rounded-lg border border-[#2a2a2a] text-[#c9a77c] hover:bg-[#c9a77c]/10 transition-colors" title="View booking">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>

                                @if($booking->status === 'pending')
                                    <form action="{{ route('admin.bookings.updateStatus', $booking) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="confirmed">
                                        <button type="submit" class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-[#c9a77c]/10 text-[#c9a77c] border border-[#c9a77c] hover:bg-[#c9a77c] hover:text-[#0f0f0f] transition-colors" title="Confirm booking">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </button>
                                    </form>
                                @elseif($booking->status === 'confirmed')
                                    <form action="{{ route('admin.bookings.updateStatus', $booking) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="checked_in">
                                        <button type="submit" class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-[#c9a77c]/10 text-[#c9a77c] border border-[#c9a77c] hover:bg-[#c9a77c] hover:text-[#0f0f0f] transition-colors" title="Check in booking">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4" />
                                            </svg>
                                        </button>
                                    </form>
                                @elseif($booking->status === 'checked_in')
                                    <form action="{{ route('admin.bookings.updateStatus', $booking) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="checked_out">
                                        <button type="submit" class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-[#6b7280]/10 text-[#d1d5db] border border-[#d1d5db] hover:bg-[#d1d5db] hover:text-[#0f0f0f] transition-colors" title="Check out booking">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6" />
                                            </svg>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-12 text-center text-[#8a8a8a]">No bookings found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($bookings->hasPages())
            <div class="mt-6">{{ $bookings->links() }}</div>
        @endif
    </div>
</x-app-layout>
