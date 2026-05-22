<x-app-layout>
    <div class="max-w-3xl mx-auto px-6 py-8">
        <button onclick="history.back()" class="inline-flex items-center gap-2 px-4 py-2 bg-[#0f0f0f] border border-[#2a2a2a] text-[#f5f5f0] rounded-xl hover:border-[#c9a77c] hover:bg-[#c9a77c]/10 transition-colors duration-300 text-sm font-medium mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Go Back
        </button>

        <div class="mb-8">
            <h1 class="font-serif text-3xl text-[#f5f5f0]">Edit Room Category</h1>
            <p class="text-[#8a8a8a] text-sm mt-1">Update the range and sync room numbers immediately.</p>
        </div>

        <form method="POST" action="{{ route('admin.room-categories.update', $roomCategory) }}" class="luxury-form-card luxury-form-inner space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-medium text-[#f5f5f0] mb-2">Room Category Type</label>
                <select name="name" id="name" required
                    class="w-full px-4 py-2.5 bg-[#0f0f0f] border border-[#2a2a2a] rounded-lg text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-1 focus:ring-[#c9a77c] transition-all">
                    <option value="">Select a room type</option>
                    <option value="STANDARD" {{ old('name', $roomCategory->name) == 'STANDARD' ? 'selected' : '' }}>STANDARD (101–110)</option>
                    <option value="DELUXE" {{ old('name', $roomCategory->name) == 'DELUXE' ? 'selected' : '' }}>DELUXE (201–210)</option>
                    <option value="SUITE" {{ old('name', $roomCategory->name) == 'SUITE' ? 'selected' : '' }}>SUITE (301–305)</option>
                    <option value="PRESIDENTIAL" {{ old('name', $roomCategory->name) == 'PRESIDENTIAL' ? 'selected' : '' }}>PRESIDENTIAL (PS1–PS6)</option>
                </select>
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="price_per_night" class="block text-sm font-medium text-[#f5f5f0] mb-2">Price per Night (₱)</label>
                    <input type="number" step="0.01" name="price_per_night" id="price_per_night" value="{{ old('price_per_night', $roomCategory->price_per_night) }}" required
                        class="w-full px-4 py-2.5 bg-[#0f0f0f] border border-[#2a2a2a] rounded-lg text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-1 focus:ring-[#c9a77c] transition-all">
                    @error('price_per_night') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="capacity" class="block text-sm font-medium text-[#f5f5f0] mb-2">Capacity (Guests)</label>
                    <input type="number" name="capacity" id="capacity" value="{{ old('capacity', $roomCategory->capacity) }}" required
                        class="w-full px-4 py-2.5 bg-[#0f0f0f] border border-[#2a2a2a] rounded-lg text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-1 focus:ring-[#c9a77c] transition-all">
                    @error('capacity') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-[#f5f5f0] mb-2">Description (optional)</label>
                <textarea name="description" id="description" rows="4"
                    class="w-full px-4 py-2.5 bg-[#0f0f0f] border border-[#2a2a2a] rounded-lg text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-1 focus:ring-[#c9a77c] transition-all">{{ old('description', $roomCategory->description) }}</textarea>
                @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center gap-4 pt-4 border-t border-[#2a2a2a]">
                <button type="submit" class="px-6 py-2.5 bg-[#c9a77c] text-[#0f0f0f] text-sm font-medium tracking-wider rounded-lg hover:bg-[#e8d5a7] transition-colors duration-300">Update Category</button>
                <a href="{{ route('admin.room-categories.index') }}" class="px-6 py-2.5 border border-[#2a2a2a] text-[#f5f5f0] text-sm font-medium rounded-lg hover:border-[#c9a77c] transition-colors duration-300">Cancel</a>
            </div>
        </form>
    </div>
</x-app-layout>
