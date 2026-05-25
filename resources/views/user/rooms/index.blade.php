<x-app-layout>
    <div class="max-w-7xl mx-auto px-6 py-8">

        <!-- Header -->
        <div class="mb-10">
            <h1 class="font-serif text-4xl text-[#f5f5f0]">Our Rooms &amp; Suites</h1>
            <p class="text-[#8a8a8a] text-sm mt-2">Select a room type to view details and book your stay.</p>
        </div>

        @if($roomTypes->isEmpty())
            <div class="rounded-2xl border border-[#2a2a2a] bg-[#111111] p-16 text-center">
                <p class="text-[#8a8a8a] text-lg font-serif">No rooms have been configured yet.</p>
                <p class="text-[#8a8a8a] text-sm mt-2">Please check back soon or contact the front desk.</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 items-stretch">
                @foreach($roomTypes as $group)
                    @php
                        $availableCount = $group->available_rooms->count();
                        $hasAvailable   = $availableCount > 0;
                        $firstRoom      = $group->first_available ?? $group->representative;
                        $initial        = strtoupper(substr($group->label, 0, 1));
                    @endphp

                    <div class="group flex flex-col overflow-hidden rounded-[1.5rem] border border-[#2a2a2a] bg-[#111111] transition duration-300 hover:border-[#c9a77c]/80 hover:-translate-y-1 hover:shadow-[0_20px_50px_rgba(0,0,0,0.4)] h-full">

                        <!-- Image — fixed height on all cards -->
                        <div class="relative h-56 flex-shrink-0 overflow-hidden bg-[#111111]">
                            @if($group->image)
                                <img src="{{ asset('storage/' . $group->image) }}"
                                     alt="{{ $group->label }}"
                                     class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                            @else
                                <div class="h-full w-full flex items-center justify-center bg-gradient-to-br from-[#111111] to-[#1a1a1a]">
                                    <span class="font-serif text-8xl uppercase tracking-[0.2em] text-[#c9a77c]/20">{{ $initial }}</span>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>

                            <!-- Availability badge -->
                            <div class="absolute top-4 right-4">
                                @if($hasAvailable)
                                    <span class="text-xs font-semibold px-3 py-1 rounded-full bg-green-500/10 text-green-400">
                                        {{ $availableCount }} Available
                                    </span>
                                @else
                                    <span class="text-xs font-semibold px-3 py-1 rounded-full bg-red-500/10 text-red-400">
                                        Fully Booked
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Body — flex-1 so all cards grow to the same height -->
                        <div class="p-6 flex flex-col flex-1">
                            <!-- Stars -->
                            <div class="flex gap-1 mb-3">
                                @for($i = 0; $i < 5; $i++)
                                    <svg class="w-3.5 h-3.5 text-[#c9a77c]" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                @endfor
                            </div>

                            <h3 class="font-serif text-2xl text-[#f5f5f0] font-semibold leading-tight group-hover:text-[#c9a77c] transition-colors duration-300 mb-1">
                                {{ $group->label }}
                            </h3>
                            <p class="text-xs uppercase tracking-[0.15em] text-[#c9a77c] mb-3">Room Type: {{ $group->type }}</p>

                            <div class="flex items-center gap-4 text-sm text-[#8a8a8a] mb-4">
                                <span>Up to {{ $group->capacity }} guests</span>
                                <span class="text-[#c9a77c] font-semibold">
                                    ₱{{ number_format($group->price_per_night, 0) }}<span class="text-[#8a8a8a] font-normal">/night</span>
                                </span>
                            </div>

                            <!-- Description — fixed 3-line clamp so all cards have same text block height -->
                            <div class="mb-5 min-h-[4.5rem]">
                                @if($group->description)
                                    <p class="text-[#8a8a8a] text-sm leading-relaxed line-clamp-3">{{ $group->description }}</p>
                                @endif
                            </div>

                            <!-- CTA pinned to bottom -->
                            <div class="mt-auto">
                                @if($firstRoom && $hasAvailable)
                                    <a href="{{ route('user.rooms.show', $firstRoom) }}"
                                       class="block w-full text-center px-5 py-3 bg-[#c9a77c] text-[#0f0f0f] text-sm font-semibold rounded-xl hover:bg-[#e8d5a7] transition-colors duration-300">
                                        View &amp; Book
                                    </a>
                                @elseif($firstRoom)
                                    <a href="{{ route('user.rooms.show', $firstRoom) }}"
                                       class="block w-full text-center px-5 py-3 border border-[#2a2a2a] text-[#8a8a8a] text-sm rounded-xl hover:border-[#c9a77c] hover:text-[#c9a77c] transition-colors duration-300">
                                        View Details
                                    </a>
                                @else
                                    <span class="block w-full text-center px-5 py-3 border border-[#2a2a2a] text-[#8a8a8a] text-sm rounded-xl cursor-not-allowed">
                                        Fully Booked
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</x-app-layout>
