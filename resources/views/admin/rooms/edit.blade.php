@php
    $isEdit = isset($room);
@endphp

<x-app-layout>
    <div class="max-w-3xl mx-auto px-6 py-8">
        <a href="{{ route('admin.rooms.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-[#0f0f0f] border border-[#2a2a2a] text-[#f5f5f0] rounded-xl hover:border-[#c9a77c] hover:bg-[#c9a77c]/10 transition-colors duration-300 text-sm font-medium mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Go Back
        </a>

        <div class="mb-8">
            <h1 class="font-serif text-3xl text-[#f5f5f0]">Edit Room</h1>
            <p class="text-[#8a8a8a] text-sm mt-1">Update room information</p>
        </div>

        <form method="POST" action="{{ route('admin.rooms.update', $room) }}" enctype="multipart/form-data" class="bg-[#1a1a1a] border border-[#2a2a2a] rounded-lg p-6 space-y-6">
            @csrf
            @method('PUT')

            
            <div>
                <label for="name" class="block text-sm font-medium text-[#f5f5f0] mb-2">Room Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $room->name) }}" required
                    class="w-full px-4 py-2.5 bg-[#0f0f0f] border border-[#2a2a2a] rounded-lg text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-1 focus:ring-[#c9a77c] transition-all">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div>
                    <label for="type" class="block text-sm font-medium text-[#f5f5f0] mb-2">Room Type</label>
                    <select name="type" id="type" required
                        class="w-full px-4 py-2.5 bg-[#0f0f0f] border border-[#2a2a2a] rounded-lg text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-1 focus:ring-[#c9a77c] transition-all">
                        <option value="Standard" {{ (old('type', $room->type) == 'Standard') ? 'selected' : '' }}>Standard</option>
                        <option value="Deluxe" {{ (old('type', $room->type) == 'Deluxe') ? 'selected' : '' }}>Deluxe</option>
                        <option value="Suite" {{ (old('type', $room->type) == 'Suite') ? 'selected' : '' }}>Suite</option>
                        <option value="Presidential" {{ (old('type', $room->type) == 'Presidential') ? 'selected' : '' }}>Presidential</option>
                    </select>
                    @error('type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="bed_type" class="block text-sm font-medium text-[#f5f5f0] mb-2">Bed Type</label>
                    <input type="text" name="bed_type" id="bed_type" value="{{ old('bed_type', $room->bed_type) }}"
                        class="w-full px-4 py-2.5 bg-[#0f0f0f] border border-[#2a2a2a] rounded-lg text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-1 focus:ring-[#c9a77c] transition-all">
                    @error('bed_type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                
                <div>
                    <label for="room_number" class="block text-sm font-medium text-[#f5f5f0] mb-2">Room Number</label>
                    <input type="text" name="room_number" id="room_number" value="{{ old('room_number', $room->room_number) }}" required
                        class="w-full px-4 py-2.5 bg-[#0f0f0f] border border-[#2a2a2a] rounded-lg text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-1 focus:ring-[#c9a77c] transition-all">
                    @error('room_number') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Price per Night -->
                <div>
                    <label for="price_per_night" class="block text-sm font-medium text-[#f5f5f0] mb-2">Price per Night (₱)</label>
                    <input type="number" step="0.01" name="price_per_night" id="price_per_night" value="{{ old('price_per_night', $room->price_per_night) }}" required
                        class="w-full px-4 py-2.5 bg-[#0f0f0f] border border-[#2a2a2a] rounded-lg text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-1 focus:ring-[#c9a77c] transition-all">
                    @error('price_per_night') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Capacity -->
                <div>
                    <label for="capacity" class="block text-sm font-medium text-[#f5f5f0] mb-2">Capacity (Guests)</label>
                    <input type="number" name="capacity" id="capacity" value="{{ old('capacity', $room->capacity) }}" required
                        class="w-full px-4 py-2.5 bg-[#0f0f0f] border border-[#2a2a2a] rounded-lg text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-1 focus:ring-[#c9a77c] transition-all">
                    @error('capacity') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-medium text-[#f5f5f0] mb-2">Status</label>
                <select name="status" id="status" required
                    class="w-full px-4 py-2.5 bg-[#0f0f0f] border border-[#2a2a2a] rounded-lg text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-1 focus:ring-[#c9a77c] transition-all">
                    <option value="available" {{ (old('status', $room->status) == 'available') ? 'selected' : '' }}>Available</option>
                    <option value="booked" {{ (old('status', $room->status) == 'booked') ? 'selected' : '' }}>Booked</option>
                    <option value="maintenance" {{ (old('status', $room->status) == 'maintenance') ? 'selected' : '' }}>Maintenance</option>
                </select>
                @error('status') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-[#f5f5f0] mb-2">Description (optional)</label>
                <textarea name="description" id="description" rows="4"
                    class="w-full px-4 py-2.5 bg-[#0f0f0f] border border-[#2a2a2a] rounded-lg text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-1 focus:ring-[#c9a77c] transition-all">{{ old('description', $room->description) }}</textarea>
                @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Image Upload -->
            <div>
                <label class="block text-sm font-medium text-[#f5f5f0] mb-2">Room Image (optional)</label>
                <input type="file" name="image" accept="image/*"
                    class="w-full px-4 py-2.5 bg-[#0f0f0f] border border-[#2a2a2a] rounded-lg text-[#f5f5f0] file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-medium file:bg-[#c9a77c] file:text-[#0f0f0f] hover:file:bg-[#e8d5a7] transition-all">
                @if($room->image)
                    <div class="mt-3">
                        <p class="text-[#8a8a8a] text-sm mb-2">Current image:</p>
                        <img src="{{ asset('storage/' . $room->image) }}" alt="Room image" class="w-32 h-32 object-cover rounded">
                    </div>
                @endif
                @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Actions -->
            <div class="flex items-center gap-4 pt-4 border-t border-[#2a2a2a]">
                <button type="submit" class="px-6 py-2.5 bg-[#c9a77c] text-[#0f0f0f] text-sm font-medium tracking-wider rounded-lg hover:bg-[#e8d5a7] transition-colors duration-300">
                    Update Room
                </button>
                <a href="{{ route('admin.rooms.index') }}" class="px-6 py-2.5 border border-[#2a2a2a] text-[#f5f5f0] text-sm font-medium rounded-lg hover:border-[#c9a77c] transition-colors duration-300">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
