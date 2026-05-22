<x-app-layout>
    <div class="max-w-7xl mx-auto px-6 py-8">
        <div class="rounded-[32px] border border-[#2a2a2a] bg-[#121212]/95 p-6 shadow-[0_40px_120px_-70px_rgba(0,0,0,0.9)]">
            <div class="rounded-[24px] border border-[#20386c] bg-[#0f1f4c] p-5">
                <p class="text-xs uppercase tracking-[0.35em] text-[#8ba9ff]/80">Administration Panel</p>
                <h1 class="mt-3 text-3xl font-semibold text-[#f5f5f0]">Sein Helios Reports</h1>
                <p class="mt-2 text-sm text-[#8a8a8a]">Manage users and review monthly performance without the database-only tab.</p>
            </div>

            <div class="mt-6 flex flex-col gap-4 xl:flex-row xl:items-center xl:justify-between">
                <div class="flex flex-wrap gap-3">
                    <button data-tab="users" class="report-tab active rounded-full border border-[#2a2a2a] bg-[#0f172b] px-5 py-3 text-sm font-semibold text-[#f5f5f0] transition hover:border-[#c9a77c]">User Management</button>
                    <button data-tab="monthly" class="report-tab rounded-full border border-[#2a2a2a] bg-[#0f172b] px-5 py-3 text-sm font-semibold text-[#8a8a8a] transition hover:border-[#c9a77c]">Monthly Reports</button>
                </div>
                <form method="GET" action="{{ route('admin.reports.index') }}" class="flex w-full max-w-md items-center gap-2">
                    <input name="search" value="{{ $search }}" type="search" placeholder="Search by name or email..." class="w-full rounded-full border border-[#2a2a2a] bg-[#0f0f0f] px-4 py-3 text-sm text-[#f5f5f0] placeholder:text-[#616161] focus:border-[#c9a77c] focus:outline-none focus:ring-[#c9a77c]/20" />
                    <button type="submit" class="rounded-full bg-[#c9a77c] px-5 py-3 text-sm font-semibold text-[#0f0f0f] transition hover:bg-[#e8d5a7]">Search</button>
                </form>
            </div>
        </div>

        <div id="tab-users" class="mt-6 rounded-[32px] border border-[#2a2a2a] bg-[#121212]/90 p-6 shadow-[0_40px_120px_-70px_rgba(0,0,0,0.9)]">
            <div class="mb-6 flex items-center justify-between gap-3">
                <div>
                    <h2 class="text-2xl font-semibold text-[#f5f5f0]">User Management</h2>
                    <p class="text-sm text-[#8a8a8a]">View and manage registered accounts with a polished administrative table.</p>
                </div>
                <span class="rounded-full border border-[#2a2a2a] bg-[#0f172b] px-4 py-2 text-sm text-[#8a8a8a]">Users: {{ $users->total() }}</span>
            </div>

            <div class="overflow-x-auto rounded-[24px] border border-[#2a2a2a] bg-[#0f0f0f]/90">
                <table class="min-w-full text-left text-sm">
                    <thead class="bg-[#121212] text-xs uppercase tracking-[0.2em] text-[#c9a77c]">
                        <tr>
                            <th class="px-5 py-4">ID</th>
                            <th class="px-5 py-4">Name</th>
                            <th class="px-5 py-4">Email</th>
                            <th class="px-5 py-4">Contact</th>
                            <th class="px-5 py-4">Joined</th>
                            <th class="px-5 py-4">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#2a2a2a] bg-[#0f0f0f]">
                        @forelse($users as $user)
                            <tr class="hover:bg-[#111827]/70 transition-colors">
                                <td class="px-5 py-4 text-[#8a8a8a]">#{{ $user->id }}</td>
                                <td class="px-5 py-4 text-[#f5f5f0]">{{ $user->name }}</td>
                                <td class="px-5 py-4 text-[#8a8a8a]">{{ $user->email }}</td>
                                <td class="px-5 py-4 text-[#8a8a8a]">{{ $user->contact_number ?? '—' }}</td>
                                <td class="px-5 py-4 text-[#8a8a8a]">{{ $user->created_at->format('Y-m-d') }}</td>
                                <td class="px-5 py-4">
                                    <span class="inline-flex rounded-full bg-[#c9a77c]/10 px-3 py-1 text-xs font-semibold text-[#c9a77c]">ACTIVE</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-5 py-12 text-center text-[#8a8a8a]">No users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">{{ $users->links() }}</div>
        </div>

        <div id="tab-monthly" class="mt-6 hidden rounded-[32px] border border-[#2a2a2a] bg-[#121212]/90 p-6 shadow-[0_40px_120px_-70px_rgba(0,0,0,0.9)]">
            <div class="mb-6">
                <h2 class="text-2xl font-semibold text-[#f5f5f0]">Monthly Reports</h2>
                <p class="text-sm text-[#8a8a8a]">Review bookings and revenue trends month by month.</p>
            </div>

            <div class="grid gap-4 md:grid-cols-3">
                <div class="rounded-[24px] border border-[#2a2a2a] bg-[#0f172b]/95 p-5">
                    <p class="text-xs uppercase tracking-[0.25em] text-[#8a8a8a]">Total Users</p>
                    <p class="mt-3 text-3xl font-semibold text-[#c9a77c]">{{ $users->total() }}</p>
                </div>
                <div class="rounded-[24px] border border-[#2a2a2a] bg-[#0f172b]/95 p-5">
                    <p class="text-xs uppercase tracking-[0.25em] text-[#8a8a8a]">Total Bookings</p>
                    <p class="mt-3 text-3xl font-semibold text-[#f5f5f0]">{{ $monthlyReports->sum('bookings') }}</p>
                </div>
                <div class="rounded-[24px] border border-[#2a2a2a] bg-[#0f172b]/95 p-5">
                    <p class="text-xs uppercase tracking-[0.25em] text-[#8a8a8a]">Total Revenue</p>
                    <p class="mt-3 text-3xl font-semibold text-[#c9a77c]">₱{{ number_format($monthlyReports->sum('revenue'), 2) }}</p>
                </div>
            </div>

            <div class="mt-6 overflow-x-auto rounded-[24px] border border-[#2a2a2a] bg-[#0f0f0f]/95">
                <table class="min-w-full text-left text-sm">
                    <thead class="bg-[#121212] text-xs uppercase tracking-[0.2em] text-[#c9a77c]">
                        <tr>
                            <th class="px-5 py-4">Month</th>
                            <th class="px-5 py-4">Bookings</th>
                            <th class="px-5 py-4">Revenue</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#2a2a2a] bg-[#0f0f0f]">
                        @forelse($monthlyReports as $report)
                            <tr class="hover:bg-[#111827]/70 transition-colors">
                                <td class="px-5 py-4 text-[#f5f5f0]">{{ $report->month }}</td>
                                <td class="px-5 py-4 text-[#8a8a8a]">{{ $report->bookings }}</td>
                                <td class="px-5 py-4 text-[#c9a77c]">₱{{ number_format($report->revenue, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-5 py-12 text-center text-[#8a8a8a]">No report data available.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        const tabs = document.querySelectorAll('.report-tab');
        const usersPanel = document.getElementById('tab-users');
        const monthlyPanel = document.getElementById('tab-monthly');

        tabs.forEach((tab) => {
            tab.addEventListener('click', () => {
                tabs.forEach((button) => {
                    button.classList.remove('active', 'bg-[#c9a77c]', 'text-[#0f0f0f]');
                    button.classList.add('bg-[#0f172b]', 'text-[#8a8a8a]');
                });
                tab.classList.add('active', 'bg-[#c9a77c]', 'text-[#0f0f0f]');
                if (tab.dataset.tab === 'users') {
                    usersPanel.classList.remove('hidden');
                    monthlyPanel.classList.add('hidden');
                } else {
                    monthlyPanel.classList.remove('hidden');
                    usersPanel.classList.add('hidden');
                }
            });
        });
    </script>
</x-app-layout>
