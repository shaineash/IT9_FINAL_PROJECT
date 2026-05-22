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
                <h1 class="font-serif text-3xl text-[#f5f5f0]">Manage Room Types</h1>
            </div>
            <div>
                <a href="{{ route('admin.rooms.create') }}" class="inline-flex items-center justify-center px-6 py-2.5 bg-[#c9a77c] text-[#0f0f0f] text-sm font-medium rounded-lg hover:bg-[#e8d5a7] transition-colors duration-300">
                    Add Room
                </a>
            </div>
        </div>
        
        <div class="bg-[#1a1a1a] border border-[#2a2a2a] rounded-lg overflow-hidden">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-[#2a2a2a]">
                        <th class="px-6 py-4 text-left text-sm font-medium text-[#c9a77c]">Room Type</th>
                        <th class="px-6 py-4 text-left text-sm font-medium text-[#c9a77c]">Price Range</th>
                        <th class="px-6 py-4 text-left text-sm font-medium text-[#c9a77c]">Capacity Range</th>
                        <th class="px-6 py-4 text-left text-sm font-medium text-[#c9a77c]">#Rooms</th>
                        <th class="px-6 py-4 text-left text-sm font-medium text-[#c9a77c]">Status</th>
                        <th class="px-6 py-4 text-left text-sm font-medium text-[#c9a77c]">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($roomTypes as $type)
                        <?php
                            // Get a sample room of this type for edit link
                            $sampleRoom = App\Models\Room::where('type', $type->type)->latest('id')->first();

                            $priceDisplay = $sampleRoom
                                ? number_format($sampleRoom->price_per_night, 2)
                                : '-';

                            $capacityDisplay = $sampleRoom
                                ? $sampleRoom->capacity . ' guests'
                                : '-';
                        ?>
                        <tr class="border-b border-[#2a2a2a] hover:bg-[#0f0f0f]/50 transition-colors">
                            <td class="px-6 py-4 text-[#f5f5f0]">{{ $type->type }}</td>
                            <td class="px-6 py-4 text-[#f5f5f0]">{{ $priceDisplay }}</td>
                            <td class="px-6 py-4 text-[#f5f5f0]">{{ $capacityDisplay }}</td>
                            <td class="px-6 py-4 text-[#f5f5f0]">{{ $type->room_count }} rooms</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs font-medium rounded-full
                                    bg-green-500/10 text-green-500">
                                    Available
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    @if($sampleRoom)
                                        <a href="{{ route('admin.rooms.edit', $sampleRoom->id) }}" class="p-2 text-[#8a8a8a] hover:text-[#c9a77c] transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                    @else
                                        <span class="p-2 text-[#8a8a8a] text-opacity-50">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </span>
                                    @endif
                                    @if($type->room_count > 0)
                                        <form method="POST" action="{{ route('admin.rooms.destroyByType') }}" class="inline" onsubmit="return confirm('Are you sure you want to delete ALL {{ $type->room_count }} rooms of type {{ $type->type }}? This action cannot be undone.');">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="room_type" value="{{ $type->type }}">
                                            <button type="submit" class="p-2 text-[#8a8a8a] hover:text-red-500 transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1 1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-[#8a8a8a]">
                                No room types found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($roomTypes->hasPages())
            <div class="mt-6">
                {{ $roomTypes->links() }}
            </div>
        @endif
    </div>
</x-app-layout>