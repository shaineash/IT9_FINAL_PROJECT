<x-app-layout>
    @php
        $totalBookings = $totalBookings ?? 0;
        $availableRooms = $availableRooms ?? 0;
        $occupiedRooms = $occupiedRooms ?? 0;
        $totalRooms = $totalRooms ?? ($availableRooms + $occupiedRooms);
        $revenue = $revenue ?? 0;
        $totalStaff = $totalStaff ?? 24;
        $recentBookings = $recentBookings ?? collect();
    @endphp

    <div class="min-h-screen bg-[#0f0f0f] text-[#f5f5f0]">
        @if(session('success'))
            <div id="booking-success-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-[#0f0f0f]/70 px-4 py-6 opacity-0 pointer-events-none transition-opacity duration-300" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="w-full max-w-md rounded-[28px] border border-[#c9a77c] bg-[#121212] p-6 text-[#f5f5f0] shadow-[0_24px_80px_-40px_rgba(0,0,0,0.9)]">
                    <h2 id="modal-title" class="text-4xl font-semibold leading-tight">Reservation created successfully</h2>
                    <div class="mt-6 flex justify-end">
                        <button id="booking-success-ok" type="button" class="rounded-full border border-[#c9a77c] bg-[#121212] px-6 py-3 text-sm font-semibold text-[#f5f5f0] transition hover:bg-[#c9a77c] hover:text-[#0f0f0f]">OK</button>
                    </div>
                </div>
            </div>
        @endif

        <div class="lg:flex lg:items-start lg:space-x-6 px-6 pb-12 pt-28">
            <aside class="hidden lg:block w-80 shrink-0">
                <div class="sticky top-28 space-y-6">
                    <div class="rounded-[32px] border border-[#2a2a2a] bg-[#121212]/90 p-6 shadow-[0_40px_120px_-70px_rgba(0,0,0,0.9)] backdrop-blur-xl">
                        <div class="flex items-center gap-4">
                            <div class="flex h-14 w-14 items-center justify-center rounded-3xl bg-gradient-to-br from-[#c9a77c]/20 to-[#e8d5a7]/15 text-[#c9a77c] shadow-lg shadow-[#c9a77c]/10">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 1.343-3 3v7h6v-7c0-1.657-1.343-3-3-3zM6 6h12M6 6a2 2 0 012-2h8a2 2 0 012 2M6 6v2a6 6 0 0012 0V6"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm uppercase tracking-[0.25em] text-[#c9a77c]/80">Sein Helios</p>
                                <h2 class="font-serif text-2xl text-[#f5f5f0]">Hotel Command</h2>
                            </div>
                        </div>
                        <p class="mt-4 text-sm leading-6 text-[#8a8a8a]">The ultimate administration console for luxury bookings, rooms, guests and revenue.</p>
                    </div>

                    <nav class="rounded-[32px] border border-[#2a2a2a] bg-[#121212]/90 p-4 shadow-[0_40px_120px_-70px_rgba(0,0,0,0.9)]">
                        <div class="space-y-2">
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 rounded-3xl px-4 py-3 text-sm font-medium text-[#f5f5f0] bg-[#1a1a1a] border border-[#2a2a2a] shadow-sm shadow-[#000]/20 transition hover:bg-[#1f1f1f]">
                                <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-[#c9a77c]/10 text-[#c9a77c]">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h7v7H3V3zm11 0h7v7h-7V3zM3 14h7v7H3v-7zm11 0h7v7h-7v-7z"/></svg>
                                </span>
                                Dashboard
                            </a>
                            <a href="{{ route('admin.rooms.index') }}" class="flex items-center gap-3 rounded-3xl px-4 py-3 text-sm font-medium text-[#8a8a8a] border border-transparent transition hover:text-[#f5f5f0] hover:bg-[#1a1a1a]">
                                <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-[#c9a77c]/10 text-[#c9a77c]">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M7 21V7m10 14V7M3 17h18"/></svg>
                                </span>
                                Rooms
                            </a>
                            <a href="{{ route('admin.bookings.index') }}" class="flex items-center gap-3 rounded-3xl px-4 py-3 text-sm font-medium text-[#8a8a8a] border border-transparent transition hover:text-[#f5f5f0] hover:bg-[#1a1a1a]">
                                <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-[#c9a77c]/10 text-[#c9a77c]">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    </svg>
                                </span>
                                Bookngs
                            </a>
                            <a href="{{ route('admin.payments.index') }}" class="flex items-center gap-3 rounded-3xl px-4 py-3 text-sm font-medium text-[#8a8a8a] border border-transparent transition hover:text-[#f5f5f0] hover:bg-[#1a1a1a]">
                                <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-[#c9a77c]/10 text-[#c9a77c]">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                </span>
                                Payments
                            </a>
                            <a href="{{ route('admin.reports.index') }}" class="flex items-center gap-3 rounded-3xl px-4 py-3 text-sm font-medium text-[#8a8a8a] border border-transparent transition hover:text-[#f5f5f0] hover:bg-[#1a1a1a]">
                                <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-[#c9a77c]/10 text-[#c9a77c]">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17h8M9 13h6M10 9h4"/></svg>
                                </span>
                                Reports
                            </a>
                        </div>
                    </nav>
                </div>
            </aside>

            <div class="flex-1">
                <div class="rounded-[32px] border border-[#2a2a2a] bg-[#121212]/85 p-6 shadow-[0_40px_120px_-70px_rgba(0,0,0,0.9)] backdrop-blur-xl mb-6">
                    <div class="flex flex-col gap-6 xl:flex-row xl:items-center xl:justify-between">
                        <div class="space-y-3">
                            <p class="text-sm uppercase tracking-[0.35em] text-[#c9a77c]/80">Admin Dashboard</p>
                            <h1 class="font-serif text-4xl text-[#f5f5f0]">Sein Helios Hotel Management</h1>
                            <p class="max-w-2xl text-sm text-[#8a8a8a]">Control bookings, rooms, guests and revenue for the hotel with a polished 5-star command center.</p>
                        </div>

                        <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                            <div class="relative w-full sm:w-[24rem]">
                                <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-[#8a8a8a]">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M10.5 18a7.5 7.5 0 107.5-7.5 7.508 7.508 0 00-7.5 7.5z"/></svg>
                                </span>
                                <input type="search" placeholder="Search bookings, guests, rooms" class="w-full rounded-3xl border border-[#2a2a2a] bg-[#111111]/90 py-3 pl-12 pr-4 text-sm text-[#f5f5f0] placeholder:text-[#616161] focus:border-[#c9a77c] focus:outline-none focus:ring-2 focus:ring-[#c9a77c]/20 transition" />
                            </div>

                            <div class="flex items-center gap-3">
                                <button type="button" class="inline-flex h-12 items-center justify-center rounded-3xl border border-[#2a2a2a] bg-[#111111]/90 px-5 text-sm text-[#f5f5f0] transition hover:border-[#c9a77c] hover:bg-[#c9a77c]/10">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405M18 8a6 6 0 10-12 0 6 6 0 0012 0zm-6 14a3.001 3.001 0 01-2.995-2.824L9 19h6a3 3 0 01-2.995 2.824L12 22z"/></svg>
                                </button>
                                <button type="button" class="inline-flex h-12 items-center gap-3 rounded-3xl bg-[#c9a77c] px-5 text-sm font-semibold text-[#0f0f0f] transition hover:bg-[#e8d5a7]">
                                    <span class="rounded-full bg-[#ffffff]/20 px-3 py-1 text-xs uppercase tracking-[0.25em]">Admin</span>
                                    {{ auth()->user()->name }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid gap-6 xl:grid-cols-[2.5fr_1fr]">
                    <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-2">
                        <article class="rounded-[32px] border border-[#2a2a2a] bg-[#111111]/85 p-6 shadow-[0_30px_80px_-50px_rgba(0,0,0,0.8)] transition hover:border-[#c9a77c]/50">
                            <div class="flex items-center justify-between gap-4">
                                <div>
                                    <p class="text-sm uppercase tracking-[0.3em] text-[#c9a77c]/80">Total Bookings</p>
                                    <p class="font-serif text-4xl text-[#f5f5f0] mt-4">{{ $totalBookings }}</p>
                                </div>
                                <div class="flex h-12 w-12 items-center justify-center rounded-3xl bg-[#c9a77c]/10 text-[#c9a77c]">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8h3a2 2 0 002-2V8h-5m-5 0H5a2 2 0 00-2 2v8a2 2 0 002 2h3"/></svg>
                                </div>
                            </div>
                        </article>

                        <article class="rounded-[32px] border border-[#2a2a2a] bg-[#111111]/85 p-6 shadow-[0_30px_80px_-50px_rgba(0,0,0,0.8)] transition hover:border-[#c9a77c]/50">
                            <div class="flex items-center justify-between gap-4">
                                <div>
                                    <p class="text-sm uppercase tracking-[0.3em] text-[#c9a77c]/80">Available Rooms</p>
                                    <p class="font-serif text-4xl text-[#f5f5f0] mt-4">{{ $availableRooms }}</p>
                                </div>
                                <div class="flex h-12 w-12 items-center justify-center rounded-3xl bg-[#c9a77c]/10 text-[#c9a77c]">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M6 10h12m-6 4h6m-8 4h10"/></svg>
                                </div>
                            </div>
                        </article>

                        <article class="rounded-[32px] border border-[#2a2a2a] bg-[#111111]/85 p-6 shadow-[0_30px_80px_-50px_rgba(0,0,0,0.8)] transition hover:border-[#c9a77c]/50">
                            <div class="flex items-center justify-between gap-4">
                                <div>
                                    <p class="text-sm uppercase tracking-[0.3em] text-[#c9a77c]/80">Occupied Rooms</p>
                                    <p class="font-serif text-4xl text-[#f5f5f0] mt-4">{{ $occupiedRooms }}</p>
                                </div>
                                <div class="flex h-12 w-12 items-center justify-center rounded-3xl bg-[#c9a77c]/10 text-[#c9a77c]">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11h14M5 15h6M8 7h.01M16 7h.01M3 5a2 2 0 012-2h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5z"/></svg>
                                </div>
                            </div>
                        </article>

                        <article class="rounded-[32px] border border-[#2a2a2a] bg-[#111111]/85 p-6 shadow-[0_30px_80px_-50px_rgba(0,0,0,0.8)] transition hover:border-[#c9a77c]/50">
                            <div class="flex items-center justify-between gap-4">
                                <div>
                                    <p class="text-sm uppercase tracking-[0.3em] text-[#c9a77c]/80">Total Revenue</p>
                                    <p class="font-serif text-4xl text-[#c9a77c] mt-4">₱{{ number_format($revenue, 2) }}</p>
                                </div>
                                <div class="flex h-12 w-12 items-center justify-center rounded-3xl bg-[#c9a77c]/10 text-[#c9a77c]">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-2.21 0-4 1.343-4 3s1.79 3 4 3 4-1.343 4-3-1.79-3-4-3zm0 9v2m0-14V3m-2 1h4"/></svg>
                                </div>
                            </div>
                        </article>
                    </div>

                </div>

                <section class="rounded-[32px] border border-[#2a2a2a] bg-[#111111]/90 p-6 mt-6 shadow-[0_30px_80px_-50px_rgba(0,0,0,0.8)]">
                    <div class="flex items-center justify-between gap-4 mb-6">
                        <div>
                            <p class="text-sm uppercase tracking-[0.35em] text-[#c9a77c]/80">Reserve a Room</p>
                        </div>
                        <span class="rounded-full bg-[#c9a77c]/10 px-3 py-2 text-xs font-semibold uppercase tracking-[0.25em] text-[#c9a77c]">Booking Operations</span>
                    </div>
                    <form id="admin-booking-form" method="POST" action="{{ route('admin.bookings.store') }}" class="grid gap-4 xl:grid-cols-2">
                        @csrf
                        <div>
                            <label for="guest-name" class="block text-sm font-medium text-[#f5f5f0] mb-2">Given Name</label>
                            <input id="guest-name" name="guest_name" type="text" placeholder="Guest name" class="w-full rounded-3xl border border-[#2a2a2a] bg-[#0f0f0f] px-4 py-3 text-[#f5f5f0] focus:border-[#c9a77c] focus:ring-[#c9a77c]/20 focus:outline-none" />
                        </div>
                        <div>
                            <label for="room-type" class="block text-sm font-medium text-[#f5f5f0] mb-2">Room Type</label>
                            <select id="room-type" name="room_type" class="w-full rounded-3xl border border-[#2a2a2a] bg-[#0f0f0f] px-4 py-3 text-[#f5f5f0] focus:border-[#c9a77c] focus:ring-[#c9a77c]/20 focus:outline-none">
                                @foreach($roomCategories->unique('name') as $category)
                                    <option value="{{ $category->name }}" data-price="{{ $category->price_per_night }}">{{ $category->name }} — ₱{{ number_format($category->price_per_night, 2) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="room-number" class="block text-sm font-medium text-[#f5f5f0] mb-2">Room Number</label>
                            <select id="room-number" name="room_number" class="w-full rounded-3xl border border-[#2a2a2a] bg-[#0f0f0f] px-4 py-3 text-[#f5f5f0] focus:border-[#c9a77c] focus:ring-[#c9a77c]/20 focus:outline-none">
                                @foreach($availableRoomRecords as $room)
                                    <option value="{{ $room->room_number }}" data-room-type="{{ $room->type }}">{{ $room->room_number }} — {{ $room->type }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="number-of-guests" class="block text-sm font-medium text-[#f5f5f0] mb-2">Number of Guests</label>
                            <input id="number-of-guests" name="number_of_guests" type="number" min="1" value="1" class="w-full rounded-3xl border border-[#2a2a2a] bg-[#0f0f0f] px-4 py-3 text-[#f5f5f0] focus:border-[#c9a77c] focus:ring-[#c9a77c]/20 focus:outline-none" />
                        </div>
                        <div>
                            <label for="contact-number" class="block text-sm font-medium text-[#f5f5f0] mb-2">Contact Number</label>
                            <input id="contact-number" name="contact_number" type="tel" placeholder="0917 123 4567" class="w-full rounded-3xl border border-[#2a2a2a] bg-[#0f0f0f] px-4 py-3 text-[#f5f5f0] focus:border-[#c9a77c] focus:ring-[#c9a77c]/20 focus:outline-none" />
                        </div>
                        <div>
                            <label for="nationality" class="block text-sm font-medium text-[#f5f5f0] mb-2">Nationality</label>
                            <input id="nationality" name="nationality" type="text" placeholder="Nationality" class="w-full rounded-3xl border border-[#2a2a2a] bg-[#0f0f0f] px-4 py-3 text-[#f5f5f0] focus:border-[#c9a77c] focus:ring-[#c9a77c]/20 focus:outline-none" />
                        </div>
                        <div class="xl:col-span-2 grid gap-4 xl:grid-cols-2">
                            <div class="grid gap-4">
                                <div>
                                    <label for="breakfast-offer" class="block text-sm font-medium text-[#f5f5f0] mb-2">Breakfast Offers</label>
                                    <select id="breakfast-offer" name="breakfast_offer" class="w-full rounded-3xl border border-[#2a2a2a] bg-[#0f0f0f] px-4 py-3 text-[#f5f5f0] focus:border-[#c9a77c] focus:ring-[#c9a77c]/20 focus:outline-none">
                                        <option value="no_breakfast">No Breakfast</option>
                                        <option value="with_breakfast">With Breakfast (+₱500)</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="special-request" class="block text-sm font-medium text-[#f5f5f0] mb-2">Special Request</label>
                                    <textarea id="special-request" name="special_request" rows="4" placeholder="Add any special request" class="w-full rounded-3xl border border-[#2a2a2a] bg-[#0f0f0f] px-4 py-3 text-[#f5f5f0] focus:border-[#c9a77c] focus:ring-[#c9a77c]/20 focus:outline-none"></textarea>
                                </div>
                            </div>
                            <div class="grid gap-4">
                                <div>
                                    <label for="check-in-date" class="block text-sm font-medium text-[#f5f5f0] mb-2">Check-in Date</label>
                                    <input id="check-in-date" name="check_in" type="date" class="w-full rounded-3xl border border-[#2a2a2a] bg-[#0f0f0f] px-4 py-3 pr-10 text-[#f5f5f0] appearance-auto focus:border-[#c9a77c] focus:ring-[#c9a77c]/20 focus:outline-none" />
                                </div>
                                <div>
                                    <label for="check-out-date" class="block text-sm font-medium text-[#f5f5f0] mb-2">Check-out Date</label>
                                    <input id="check-out-date" name="check_out" type="date" class="w-full rounded-3xl border border-[#2a2a2a] bg-[#0f0f0f] px-4 py-3 pr-10 text-[#f5f5f0] appearance-auto focus:border-[#c9a77c] focus:ring-[#c9a77c]/20 focus:outline-none" />
                                </div>
                            </div>
                        </div>
                        <div class="xl:col-span-2 grid gap-4 sm:grid-cols-[1.4fr_0.8fr] items-end">
                            <div class="rounded-3xl border border-[#2a2a2a] bg-[#0f0f0f]/90 p-6 min-h-[170px] flex flex-col justify-between">
                                <div>
                                    <p class="text-xs uppercase tracking-[0.25em] text-[#8a8a8a]">Estimated Price</p>
                                    <p id="estimated-price" class="font-serif text-4xl sm:text-5xl text-[#c9a77c] mt-3">₱0.00</p>
                                </div>
                                <p id="estimated-nights" class="text-sm text-[#8a8a8a] mt-4">0 night(s)</p>
                            </div>
                            <button type="submit" id="submit-reservation" class="w-full h-full rounded-3xl bg-[#c9a77c] px-6 py-5 text-base sm:text-lg font-semibold text-[#0f0f0f] transition hover:bg-[#e8d5a7]">
                                Submit Reservation
                            </button>
                        </div>
                    </form>
                </section>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const bookingSuccessModal = document.getElementById('booking-success-modal');
            const bookingSuccessClose = document.getElementById('booking-success-close');
            const bookingSuccessOk = document.getElementById('booking-success-ok');
            const roomTypeSelect = document.getElementById('room-type');
            const roomNumberSelect = document.getElementById('room-number');
            const breakfastSelect = document.getElementById('breakfast-offer');
            const checkInInput = document.getElementById('check-in-date');
            const checkOutInput = document.getElementById('check-out-date');
            const estimatedPriceEl = document.getElementById('estimated-price');
            const estimatedNightsEl = document.getElementById('estimated-nights');

            const roomNumberOptions = Array.from(roomNumberSelect.querySelectorAll('option'));

            const updateRoomNumbers = () => {
                const selectedType = roomTypeSelect.value.toLowerCase();
                const matching = roomNumberOptions.filter(option => option.dataset.roomType?.toLowerCase() === selectedType);

                roomNumberSelect.innerHTML = '';

                if (matching.length === 0) {
                    const fallback = document.createElement('option');
                    fallback.textContent = 'No available rooms for selected type';
                    fallback.value = '';
                    fallback.disabled = true;
                    fallback.selected = true;
                    roomNumberSelect.appendChild(fallback);
                    return;
                }

                matching.forEach(option => {
                    roomNumberSelect.appendChild(option.cloneNode(true));
                });
            };

            const updateEstimate = () => {
                const selectedTypeOption = roomTypeSelect.selectedOptions[0];
                const roomPrice = parseFloat(selectedTypeOption?.dataset.price || '0');
                const breakfastFee = breakfastSelect.value === 'with_breakfast' ? 500 : 0;
                const checkIn = checkInInput.value ? new Date(checkInInput.value) : null;
                const checkOut = checkOutInput.value ? new Date(checkOutInput.value) : null;
                let nights = 0;

                if (checkIn && checkOut && checkOut > checkIn) {
                    nights = Math.round((checkOut - checkIn) / (1000 * 60 * 60 * 24));
                }

                const total = roomPrice * nights + breakfastFee;
                estimatedPriceEl.textContent = `₱${total.toLocaleString('en-PH', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
                estimatedNightsEl.textContent = `${nights} night(s)`;
            };

            roomTypeSelect.addEventListener('change', () => {
                updateRoomNumbers();
                updateEstimate();
            });
            breakfastSelect.addEventListener('change', updateEstimate);
            checkInInput.addEventListener('change', updateEstimate);
            checkOutInput.addEventListener('change', updateEstimate);

            if (bookingSuccessModal) {
                bookingSuccessModal.classList.remove('opacity-0', 'pointer-events-none');
                bookingSuccessModal.classList.add('opacity-100');

                const hideModal = () => {
                    bookingSuccessModal.classList.remove('opacity-100');
                    bookingSuccessModal.classList.add('opacity-0', 'pointer-events-none');
                };

                bookingSuccessOk?.addEventListener('click', hideModal);
                bookingSuccessModal.addEventListener('click', (event) => {
                    if (event.target === bookingSuccessModal) {
                        hideModal();
                    }
                });
            }

            updateRoomNumbers();
            updateEstimate();
        });
    </script>
</x-app-layout>