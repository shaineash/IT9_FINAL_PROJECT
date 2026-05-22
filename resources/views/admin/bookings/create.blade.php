<x-app-layout>
    <div class="max-w-7xl mx-auto px-6 py-8">
        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-[#0f0f0f] border border-[#2a2a2a] text-[#f5f5f0] rounded-xl hover:border-[#c9a77c] hover:bg-[#c9a77c]/10 transition-colors duration-300 text-sm font-medium mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Go Back
        </a>

        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="font-serif text-3xl text-[#f5f5f0]">Create Booking <span class="text-[#8a8a8a] text-base">(Walk-in / Admin)</span></h1>
            </div>
            <div>
                <a href="{{ route('admin.bookings.index') }}" class="inline-flex items-center justify-center px-6 py-2.5 bg-[#c9a77c] text-[#0f0f0f] text-sm font-medium rounded-lg hover:bg-[#e8d5a7] transition-colors duration-300">
                    View All Bookings
                </a>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.bookings.store') }}" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="user_id" class="block text-sm font-medium text-[#f5f5f0] mb-2">Guest</label>
                    <select name="user_id" id="user_id" class="w-full px-4 py-3 bg-[#0f0f0f] border border-[#2a2a2a] rounded-3xl text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-1 focus:ring-[#c9a77c] transition-all">
                        <option value="">Select a guest (optional)</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('user_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="room_type" class="block text-sm font-medium text-[#f5f5f0] mb-2">Room Type</label>
                    <select name="room_type" id="room_type" class="w-full px-4 py-3 bg-[#0f0f0f] border border-[#2a2a2a] rounded-3xl text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-1 focus:ring-[#c9a77c] transition-all">
                        <option value="">Select Room Type</option>
                        @foreach($rooms->keys() as $type)
                            <option value="{{ $type }}" {{ old('room_type') == $type ? 'selected' : '' }}>
                                {{ $type }}
                            </option>
                        @endforeach
                    </select>
                    @error('room_type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label for="room_number" class="block text-sm font-medium text-[#f5f5f0] mb-2">Room Number</label>
                <select name="room_number" id="room_number" class="w-full px-4 py-3 bg-[#0f0f0f] border border-[#2a2a2a] rounded-3xl text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-1 focus:ring-[#c9a77c] transition-all">
                    <option value="">Select a room type first</option>
                </select>
                @error('room_number') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="check_in" class="block text-sm font-medium text-[#f5f5f0] mb-2">Check-in Date</label>
                    <input type="date" name="check_in" id="check_in" value="{{ old('check_in') }}" required min="{{ date('Y-m-d') }}"
                        class="w-full px-4 py-3 bg-[#0f0f0f] border border-[#2a2a2a] rounded-3xl text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-1 focus:ring-[#c9a77c] transition-all">
                    @error('check_in') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="check_out" class="block text-sm font-medium text-[#f5f5f0] mb-2">Check-out Date</label>
                    <input type="date" name="check_out" id="check_out" value="{{ old('check_out') }}" required
                        class="w-full px-4 py-3 bg-[#0f0f0f] border border-[#2a2a2a] rounded-3xl text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-1 focus:ring-[#c9a77c] transition-all">
                    @error('check_out') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="number_of_guests" class="block text-sm font-medium text-[#f5f5f0] mb-2">Number of Guests</label>
                    <input type="number" name="number_of_guests" id="number_of_guests" value="{{ old('number_of_guests', 1) }}" min="1"
                        class="w-full px-4 py-3 bg-[#0f0f0f] border border-[#2a2a2a] rounded-3xl text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-1 focus:ring-[#c9a77c] transition-all">
                    @error('number_of_guests') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="special_request" class="block text-sm font-medium text-[#f5f5f0] mb-2">Special Requests</label>
                    <textarea name="special_request" id="special_request" rows="3" placeholder="Any special requests or notes"
                        class="w-full px-4 py-3 bg-[#0f0f0f] border border-[#2a2a2a] rounded-3xl text-[#f5f5f0] focus:outline-none focus:border-[#c9a77c] focus:ring-1 focus:ring-[#c9a77c] transition-all">{{ old('special_request') }}</textarea>
                    @error('special_request') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mt-4 pt-4 border-t border-[#2a2a2a]">
                <button type="submit" class="w-full px-6 py-3 bg-[#c9a77c] text-[#0f0f0f] text-sm font-semibold tracking-wider rounded-3xl hover:bg-[#e8d5a7] transition-colors duration-300">
                    Create Booking
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const roomTypeSelect = document.getElementById('room_type');
            const roomNumberSelect = document.getElementById('room_number');

            // Populate room numbers when room type changes
            roomTypeSelect.addEventListener('change', function() {
                const selectedType = this.value;
                roomNumberSelect.innerHTML = '<option value="">Select a room number</option>';

                if (selectedType) {
                    // Fetch available rooms of this type via AJAX or pre-loaded data
                    @php
                        $roomTypes = [];
                        foreach ($rooms as $type => $roomCollection) {
                            $roomTypes[$type] = $roomCollection->where('status', 'available')->pluck('room_number', 'room_number')->toArray();
                        }
                    @endphp
                    const availableRooms = @json($roomTypes);

                    if (availableRooms[selectedType] && availableRooms[selectedType].length > 0) {
                        availableRooms[selectedType].forEach(roomNumber => {
                            const option = document.createElement('option');
                            option.value = roomNumber;
                            option.textContent = roomNumber;
                            roomNumberSelect.appendChild(option);
                        });
                    } else {
                        const option = document.createElement('option');
                        option.value = '';
                        option.textContent = 'No available rooms of this type';
                        option.disabled = true;
                        roomNumberSelect.appendChild(option);
                    }
                }
            });

            // Set initial room numbers if there's an old input
            const oldRoomType = "{{ old('room_type') }}";
            if (oldRoomType) {
                roomTypeSelect.value = oldRoomType;
                // Trigger change event to populate room numbers
                const event = new Event('change');
                roomTypeSelect.dispatchEvent(event);
                
                // Set selected room number
                const oldRoomNumber = "{{ old('room_number') }}";
                if (oldRoomNumber) {
                    roomNumberSelect.value = oldRoomNumber;
                }
            }
        });
    </script>
</x-app-layout>