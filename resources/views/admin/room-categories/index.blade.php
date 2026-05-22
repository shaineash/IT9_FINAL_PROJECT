<x-app-layout>
    <div class="max-w-7xl mx-auto px-6 py-8">
        <button onclick="history.back()" class="inline-flex items-center gap-2 px-4 py-2 bg-[#0f0f0f] border border-[#2a2a2a] text-[#f5f5f0] rounded-xl hover:border-[#c9a77c] hover:bg-[#c9a77c]/10 transition-colors duration-300 text-sm font-medium mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Go Back
        </button>

        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="font-serif text-3xl text-[#f5f5f0]">Room Categories</h1>
                <p class="text-[#8a8a8a] text-sm mt-1">Manage category ranges and automatically sync room numbers.</p>
            </div>
            <a href="{{ route('admin.room-categories.create') }}" class="px-6 py-2.5 bg-[#c9a77c] text-[#0f0f0f] text-sm font-medium tracking-wider rounded-lg hover:bg-[#e8d5a7] transition-colors duration-300">
                + Add Category
            </a>
        </div>

        <div class="bg-[#1a1a1a] border border-[#2a2a2a] rounded-lg overflow-hidden">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-[#2a2a2a]">
                        <th class="px-6 py-4 text-left text-sm font-medium text-[#c9a77c]">Category</th>
                        <th class="px-6 py-4 text-left text-sm font-medium text-[#c9a77c]">Range (Auto-generated)</th>
                        <th class="px-6 py-4 text-left text-sm font-medium text-[#c9a77c]">Room Count</th>
                        <th class="px-6 py-4 text-left text-sm font-medium text-[#c9a77c]">Price/Night</th>
                        <th class="px-6 py-4 text-left text-sm font-medium text-[#c9a77c]">Capacity</th>
                        <th class="px-6 py-4 text-left text-sm font-medium text-[#c9a77c]">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr class="border-b border-[#2a2a2a] hover:bg-[#0f0f0f]/50 transition-colors">
                            <td class="px-6 py-4 text-[#f5f5f0]">{{ $category->name }}</td>
                            <td class="px-6 py-4 text-[#8a8a8a]">{{ $category->range_start }} – {{ $category->range_end }}</td>
                            <td class="px-6 py-4 text-[#f5f5f0]">{{ count($category->room_numbers) }}</td>
                            <td class="px-6 py-4 text-[#f5f5f0]">₱{{ number_format($category->price_per_night, 2) }}</td>
                            <td class="px-6 py-4 text-[#f5f5f0]">{{ $category->capacity }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.room-categories.edit', $category) }}" class="p-2 text-[#8a8a8a] hover:text-[#c9a77c] transition-colors">Edit</a>
                                    <form method="POST" action="{{ route('admin.room-categories.destroy', $category) }}" class="inline" onsubmit="return confirm('Remove this category and retire its rooms?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-[#8a8a8a] hover:text-red-500 transition-colors">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-[#8a8a8a]">
                                No categories defined yet. <a href="{{ route('admin.room-categories.create') }}" class="text-[#c9a77c] hover:underline">Create one now</a>.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($categories->hasPages())
            <div class="mt-6">
                {{ $categories->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
