<x-app-layout>
    <div class="max-w-7xl mx-auto px-6 py-8">
        <button onclick="history.back()" class="inline-flex items-center gap-2 px-4 py-2 bg-[#0f0f0f] border border-[#2a2a2a] text-[#f5f5f0] rounded-xl hover:border-[#c9a77c] hover:bg-[#c9a77c]/10 transition-colors duration-300 text-sm font-medium mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Go Back
        </button>

        <!-- Header -->
        <div class="mb-8">
            <h1 class="font-serif text-3xl text-[#f5f5f0]">Manage Users</h1>
            <p class="text-[#8a8a8a] text-sm mt-1">View and manage registered customers</p>
        </div>

        <!-- Users Table -->
        <div class="bg-[#1a1a1a] border border-[#2a2a2a] rounded-lg overflow-x-auto">
            <table class="w-full min-w-[600px]">
                <thead>
                    <tr class="border-b border-[#2a2a2a]">
                        <th class="px-6 py-4 text-left text-sm font-medium text-[#c9a77c]">ID</th>
                        <th class="px-6 py-4 text-left text-sm font-medium text-[#c9a77c]">Name</th>
                        <th class="px-6 py-4 text-left text-sm font-medium text-[#c9a77c]">Email</th>
                        <th class="px-6 py-4 text-left text-sm font-medium text-[#c9a77c]">Joined</th>
                        <th class="px-6 py-4 text-left text-sm font-medium text-[#c9a77c]">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr class="border-b border-[#2a2a2a] hover:bg-[#0f0f0f]/50 transition-colors">
                            <td class="px-6 py-4 text-[#8a8a8a] text-sm">#{{ $user->id }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#c9a77c]/20 to-[#8b6f3a]/20 flex items-center justify-center">
                                        <span class="text-sm font-medium text-[#c9a77c]">{{ substr($user->name, 0, 1) }}</span>
                                    </div>
                                    <div>
                                        <p class="text-[#f5f5f0] font-medium">{{ $user->name }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-[#f5f5f0]">{{ $user->email }}</td>
                            <td class="px-6 py-4 text-[#8a8a8a]">{{ $user->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('admin.users.bookings', $user) }}" class="text-sm text-[#c9a77c] hover:text-[#e8d5a7]" title="View Bookings">
                                        Bookings
                                    </a>
                                    <a href="{{ route('admin.users.edit', $user) }}" class="text-sm text-[#c9a77c] hover:text-[#e8d5a7]" title="Edit User">
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="inline" onsubmit="return confirm('Delete this user? Associated bookings will be deleted too.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm text-red-500 hover:text-red-400">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-[#8a8a8a]">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($users->hasPages())
            <div class="mt-6">{{ $users->links() }}</div>
        @endif
    </div>
</x-app-layout>
