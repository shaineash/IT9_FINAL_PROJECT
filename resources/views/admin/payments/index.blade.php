<x-app-layout>
    <div class="max-w-7xl mx-auto px-6 py-8">
        <div class="mb-6 rounded-[32px] border border-[#c9a77c] bg-[#121212]/95 p-6 shadow-[0_40px_120px_-70px_rgba(0,0,0,0.9)]">
            <div class="mb-6 rounded-[24px] border border-[#1f3b67] bg-gradient-to-r from-[#12203f] via-[#0f1424] to-[#12203f] p-6 text-[#f5f5f0] shadow-[0_24px_80px_-40px_rgba(0,0,0,0.9)]">
                <p class="text-xs uppercase tracking-[0.35em] text-[#78a4e0]/80">Payment Processing</p>
                <h1 class="mt-4 text-4xl font-semibold text-[#f5f5f0]">Admin Payment Dashboard</h1>
                <p class="mt-3 text-sm leading-6 text-[#a8b8d4]">Review guest payments, verify payment statuses, and track daily revenue from one polished finance panel.</p>
            </div>

            <div class="grid gap-4 sm:grid-cols-3">
                <div class="rounded-[24px] border border-[#1f3b67] bg-[#0f1728]/90 p-5">
                    <p class="text-xs uppercase tracking-[0.25em] text-[#8a8a8a]">Today's Payments</p>
                    <p class="mt-3 text-3xl font-semibold text-[#c9a77c]">{{ $todayPayments }}</p>
                </div>
                <div class="rounded-[24px] border border-[#1f3b67] bg-[#0f1728]/90 p-5">
                    <p class="text-xs uppercase tracking-[0.25em] text-[#8a8a8a]">Total Revenue</p>
                    <p class="mt-3 text-3xl font-semibold text-[#f5f5f0]">₱{{ number_format($totalRevenue, 2) }}</p>
                </div>
                <div class="rounded-[24px] border border-[#1f3b67] bg-[#0f1728]/90 p-5">
                    <p class="text-xs uppercase tracking-[0.25em] text-[#8a8a8a]">Search & refresh</p>
                    <form method="GET" action="{{ route('admin.payments.index') }}" class="mt-3 flex flex-col gap-3 sm:flex-row sm:items-center">
                        <input type="search" name="search" value="{{ request('search') }}" placeholder="Search by guest, booking ID, or room" class="flex-1 min-w-0 rounded-full border border-[#2a2a2a] bg-[#0f111f] px-4 py-3 text-sm text-[#f5f5f0] placeholder:text-[#5f7eb6] focus:border-[#c9a77c] focus:outline-none focus:ring-[#c9a77c]/20" />
                        <div class="flex gap-3 flex-wrap sm:flex-nowrap justify-end">
                            <button type="submit" class="inline-flex w-full sm:w-auto items-center justify-center rounded-full bg-[#c9a77c] px-5 py-3 text-sm font-semibold text-[#0f0f0f] transition hover:bg-[#e8d5a7]">Search</button>
                            <a href="{{ route('admin.payments.index') }}" class="inline-flex w-full sm:w-auto items-center justify-center rounded-full border border-[#2a2a2a] bg-[#0f0f0f] px-5 py-3 text-sm font-semibold text-[#f5f5f0] transition hover:border-[#c9a77c] hover:bg-[#c9a77c]/10">Refresh</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="mb-6 rounded-[32px] border border-[#1f3b67] bg-[#0f1728]/90 p-5 shadow-[0_40px_120px_-70px_rgba(0,0,0,0.9)]">
            <div class="mb-5 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-xl font-semibold text-[#f5f5f0]">Payment Records</h2>
                    <p class="text-sm text-[#8a8a8a]">Live payment table for the admin finance review.</p>
                </div>
                <div class="rounded-3xl bg-[#12203f]/80 px-4 py-2 text-sm text-[#78a4e0]">Showing latest {{ $bookings->count() }} records</div>
            </div>

            <div class="overflow-x-auto rounded-[24px] border border-[#22385c] bg-[#0b1221]/95">
                <table class="min-w-full divide-y divide-[#22385c] text-sm">
                    <thead class="bg-[#0f1728] text-left text-xs uppercase tracking-[0.2em] text-[#78a4e0]">
                        <tr>
                            <th class="px-4 py-4">Receipt #</th>
                            <th class="px-4 py-4">Reservation ID</th>
                            <th class="px-4 py-4">Guest</th>
                            <th class="px-4 py-4">Room #</th>
                            <th class="px-4 py-4">Room Type</th>
                            <th class="px-4 py-4">Amount</th>
                            <th class="px-4 py-4">Payment Method</th>
                            <th class="px-4 py-4">Payment Date</th>
                            <th class="px-4 py-4">Status</th>
                            <th class="px-4 py-4">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#1c2d54] bg-[#08101f]">
                        @forelse($bookings as $booking)
                            <tr class="transition hover:bg-[#0f1728]/80">
                                <td class="px-4 py-4 text-[#f5f5f0]">{{ $booking->payment->transaction_reference ?? 'PENDING' }}</td>
                                <td class="px-4 py-4 text-[#8a8a8a]">{{ $booking->id }}</td>
                                <td class="px-4 py-4 text-[#f5f5f0]">{{ $booking->guest_name ?? ($booking->user->name ?? 'Guest') }}</td>
                                <td class="px-4 py-4 text-[#8a8a8a]">#{{ $booking->room->room_number ?? '—' }}</td>
                                <td class="px-4 py-4 text-[#f5f5f0]">{{ $booking->room->type ?? '—' }}</td>
                                <td class="px-4 py-4 text-[#c9a77c]">₱{{ number_format($booking->total_price, 2) }}</td>
                                <td class="px-4 py-4 text-[#8a8a8a]">{{ $booking->payment ? ucfirst($booking->payment->payment_method) : 'Not Paid' }}</td>
                                <td class="px-4 py-4 text-[#8a8a8a]">{{ optional($booking->payment?->created_at)->format('Y-m-d H:i') ?? '—' }}</td>
                                <td class="px-4 py-4">
                                    <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $booking->payment ? 'bg-green-500/10 text-green-500' : 'bg-yellow-500/10 text-yellow-500' }}">{{ $booking->payment ? 'Paid' : 'Not Paid' }}</span>
                                </td>
                                <td class="px-4 py-4">
                                    <a href="{{ route('admin.payments.process', $booking) }}" class="inline-flex rounded-full {{ $booking->payment ? 'bg-[#78972d]' : 'bg-[#c9a77c]' }} px-3 py-2 text-xs font-semibold text-[#0f0f0f] transition hover:bg-[#e8d5a7]">{{ $booking->payment ? 'Receipt' : 'Process' }}</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="px-4 py-12 text-center text-[#8a8a8a]">No confirmed bookings or payment records found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">{{ $bookings->links() }}</div>
        </div>
    </div>
</x-app-layout>
