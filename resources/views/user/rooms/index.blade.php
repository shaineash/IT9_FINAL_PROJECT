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
            <h1 class="font-serif text-3xl text-[#f5f5f0]">Our Rooms</h1>
            <p class="text-[#8a8a8a] text-sm mt-1">Select from our luxury accommodations</p>
        </div>

        <!-- Luxury Accommodations Showcase -->
        <section class="reserve-now-section mb-12">
            <div class="max-w-7xl mx-auto relative z-10">
                <h2 class="section-title-reserve">Luxury Accommodations</h2>
                <p class="section-subtitle-reserve max-w-3xl">
                    Four signature room collections, curated by admin control and rendered with elegant balance.
                </p>

                <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @php
                        $roomTypes = ['STANDARD', 'DELUXE', 'SUITE', 'PRESIDENTIAL'];
                    @endphp

                    @foreach($roomTypes as $roomType)
                        @php
                            $category = $roomCategories->first(function ($cat) use ($roomType) {
                                return \App\Models\Room::normalizeType($cat->name ?? '') === $roomType;
                            });

                            $previewRoom = $category?->rooms->firstWhere('image', '!=', null) ?? $category?->rooms->first();

                            // FULL DETAILS RULE:
                            // Consider “full details exist” if there is at least one room record for this type
                            // that has a non-empty description and/or image.
                            $hasFullDetails = (bool) ($category && $category->rooms
                                ->filter(fn ($r) => !empty($r->description) || !empty($r->image))
                                ->count());

                            $roomName = $previewRoom ? $previewRoom->name : ucfirst(strtolower($roomType)) . ' Room';
                            $roomInitial = strtoupper(substr($roomName, 0, 1));
                            $roomDisplayName = preg_replace('/\b(?:Room\s*(?:No\.?\s*)?|#)\s*\d+\b/i', '', $roomName);
                            $roomDisplayName = trim($roomDisplayName);
                            if ($roomDisplayName === '') {
                                $roomDisplayName = ucfirst(strtolower($roomType)) . ' Room';
                            }
                        @endphp

                        <a href="{{ $hasFullDetails && $previewRoom ? route('user.rooms.show', $previewRoom) : route('user.rooms.index') }}" class="group overflow-hidden rounded-[2rem] border border-[#2a2a2a] bg-[#0f0f0f] shadow-[0_20px_40px_rgba(0,0,0,0.25)] transition duration-300 hover:border-[#c9a77c]/80 no-underline {{ $hasFullDetails ? '' : 'opacity-80' }}">
                            <div class="relative h-72 bg-[#111111]">
                                @if($previewRoom && $previewRoom->image)
                                    <img src="{{ asset('storage/' . $previewRoom->image) }}" alt="{{ $roomDisplayName }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105" />
                                @else
                                    <div class="h-full w-full flex items-center justify-center bg-gradient-to-br from-[#111111] to-[#1a1a1a]">
                                        <span class="text-8xl font-serif uppercase tracking-[0.2em] text-[#c9a77c]/20">{{ $roomInitial }}</span>
                                    </div>
                                @endif
                                <div class="absolute inset-x-0 top-0 h-full bg-gradient-to-b from-black/10 via-transparent to-transparent"></div>
                            </div>

                            <div class="p-6">
                                <h3 class="mt-4 font-serif text-2xl text-[#f5f5f0] leading-tight">{{ $roomDisplayName }}</h3>
                                <div class="mt-5 flex gap-1" aria-label="5 star rating">
                                    @for($i = 0; $i < 5; $i++)
                                        <svg class="w-4 h-4 text-[#c9a77c]" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                    @endfor
                                </div>
                                <div class="mt-4 text-sm text-[#c9a77c] uppercase tracking-[0.15em]">
                                    {{ $hasFullDetails ? 'View Room Details' : 'Coming Soon' }}
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
