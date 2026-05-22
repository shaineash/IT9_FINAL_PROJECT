<x-app-layout>
    <div class="max-w-7xl mx-auto px-6 py-8">
        <div class="rounded-[32px] border border-[#c9a77c] bg-[#121212]/95 p-6 shadow-[0_40px_120px_-70px_rgba(0,0,0,0.9)]">
            <div class="mb-6">
                <p class="text-xs uppercase tracking-[0.35em] text-[#c9a77c]/80">Check In Guests</p>
                <h1 class="mt-3 text-4xl font-semibold text-[#f5f5f0]">Guest Check-In Dashboard</h1>
                <p class="mt-2 text-sm text-[#8a8a8a] max-w-2xl">Manage all confirmed arrivals, review payment status, and process check-ins from one place.</p>
            </div>

            <div class="grid gap-4 md:grid-cols-4 mb-6">
                <div class="rounded-[24px] border border-[#2a2a2a] bg-[#0f0f0f]/90 p-5">
                    <p class="text-xs uppercase tracking-[0.25em] text-[#8a8a8a]">Total Check-ins Today</p>
                    <p class="mt-3 text-3xl font-semibold text-[#c9a77c]">{{ $totalCheckinsToday }}</p>
                </div>
                <div class="rounded-[24px] border border-[#2a2a2a] bg-[#0f0f0f]/90 p-5">
                    <p class="text-xs uppercase tracking-[0.25em] text-[#8a8a8a]">Pending</p>
                    <p class="mt-3 text-3xl font-semibold text-[#f5f5f0]">{{ $pendingCount }}</p>
                </div>
                <div class="rounded-[24px] border border-[#2a2a2a] bg-[#0f0f0f]/90 p-5">
                    <p class="text-xs uppercase tracking-[0.25em] text-[#8a8a8a]">Completed</p>
                    <p class="mt-3 text-3xl font-semibold text-[#f5f5f0]">{{ $completedCount }}</p>
                </div>
                <div class="rounded-[24px] border border-[#2a2a2a] bg-[#0f0f0f]/90 p-5">
                    <p class="text-xs uppercase tracking-[0.25em] text-[#8a8a8a]">Revenue</p>
                    <p class="mt-3 text-3xl font-semibold text-[#c9a77c]">₱{{ number_format($revenue, 2) }}</p>
                </div>
            </div>

            <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div class="relative w-full sm:max-w-md">
                    <input type="text" placeholder="Search by guest name or reservation ID..." class="w-full rounded-3xl border border-[#2a2a2a] bg-[#0f0f0f] px-5 py-3 text-sm text-[#f5f5f0] placeholder:text-[#616161] focus:border-[#c9a77c] focus:outline-none focus:ring-[#c9a77c]/20"/>
                </div>
                <div class="flex gap-3">
                    <button type="button" onclick="location.reload()" class="inline-flex items-center justify-center rounded-3xl border border-[#c9a77c] bg-[#121212] px-5 py-3 text-sm font-semibold text-[#f5f5f0] transition hover:bg-[#c9a77c] hover:text-[#0f0f0f]">Refresh</button>
                </div>
            </div>

            <div class="overflow-x-auto rounded-[24px] border border-[#2a2a2a] bg-[#111111]/90">
                <table class="min-w-full divide-y divide-[#2a2a2a]">
                    <thead class="bg-[#121212]">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.2em] text-[#c9a77c]">ID</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.2em] text-[#c9a77c]">Guest</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.2em] text-[#c9a77c]">Room #</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.2em] text-[#c9a77c]">Room Type</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.2em] text-[#c9a77c]">Check-in</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.2em] text-[#c9a77c]">Check-out</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.2em] text-[#c9a77c]">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.2em] text-[#c9a77c]">Payment</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.2em] text-[#c9a77c]">Total</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.2em] text-[#c9a77c]">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#2a2a2a] bg-[#0f0f0f]">
                        @forelse($bookings as $booking)
                            <tr class="hover:bg-[#111111]/80 transition-colors">
                                <td class="px-6 py-4 text-sm text-[#8a8a8a]">#{{ $booking->id }}</td>
                                <td class="px-6 py-4 text-sm text-[#f5f5f0]">{{ $booking->guest_name ?? ($booking->user->name ?? 'Guest') }}</td>
                                <td class="px-6 py-4 text-sm text-[#8a8a8a]">#{{ $booking->room->room_number ?? '—' }}</td>
                                <td class="px-6 py-4 text-sm text-[#f5f5f0]">{{ $booking->room->type ?? '—' }}</td>
                                <td class="px-6 py-4 text-sm text-[#f5f5f0]">{{ \Carbon\Carbon::parse($booking->check_in)->format('M d, Y') }}</td>
                                <td class="px-6 py-4 text-sm text-[#f5f5f0]">{{ \Carbon\Carbon::parse($booking->check_out)->format('M d, Y') }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $booking->status === 'confirmed' ? 'bg-blue-500/10 text-blue-500' : 'bg-gray-500/10 text-gray-400' }}">{{ ucfirst(str_replace('_', ' ', $booking->status)) }}</span>
                                </td>
                                <td class="px-6 py-4 text-sm text-[#8a8a8a]">{{ $booking->payment?->status ? ucfirst($booking->payment->status) : 'Pending' }}</td>
                                <td class="px-6 py-4 text-sm text-[#c9a77c]">₱{{ number_format($booking->total_price, 2) }}</td>
                                <td class="px-6 py-4">
                                    <form action="{{ route('admin.bookings.updateStatus', $booking) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="checked_in">
                                        <button type="submit" class="rounded-full bg-[#c9a77c] px-4 py-2 text-xs font-semibold text-[#0f0f0f] transition hover:bg-[#e8d5a7]">CHECK IN</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="px-6 py-12 text-center text-[#8a8a8a]">No check-ins available.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">{{ $bookings->links() }}</div>
        </div>
    </div>
</x-app-layout>
