<x-app-layout>
    <div class="max-w-7xl mx-auto px-6 py-8">
        @if(session('success'))
            <div id="payment-success-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-[#0f0f0f]/70 px-4 py-6 opacity-0 pointer-events-none transition-opacity duration-300">
                <div class="w-full max-w-md rounded-lg overflow-hidden border border-[#e7d8c4] bg-white shadow-[0_32px_120px_-60px_rgba(0,0,0,0.18)]">
                    <!-- Header -->
                    <div class="bg-[#e83b87] px-6 py-4">
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-semibold text-white uppercase tracking-wider">PAYMENT SUCCESSFUL</p>
                            <button id="payment-success-close-btn" type="button" class="text-white text-xl font-bold hover:opacity-80">✕</button>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="bg-[#4a9fd8] px-6 py-8 space-y-6">
                        <!-- Success Message -->
                        <div class="text-center">
                            <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-green-400 text-white mb-3">
                                <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            </div>
                            <p class="text-2xl font-bold text-green-400">Payment processed successfully!</p>
                        </div>

                        <!-- Receipt Details -->
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between items-center">
                                <span class="font-semibold text-[#1a3a52]">Receipt #:</span>
                                <span class="text-[#1a3a52]">{{ session('receipt_number', $booking->payment->transaction_reference ?? 'RCPT' . str_pad($booking->id, 5, '0', STR_PAD_LEFT)) }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="font-semibold text-[#1a3a52]">Amount:</span>
                                <span class="text-[#1a3a52]">P{{ session('amount_received', number_format($booking->payment->amount ?? $booking->total_price, 2)) }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="font-semibold text-[#1a3a52]">Change:</span>
                                <span class="text-[#1a3a52]">P{{ session('change_amount', '0.00') }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="font-semibold text-[#1a3a52]">Guest:</span>
                                <span class="text-[#1a3a52]">{{ $booking->guest_name ?? $booking->user->name ?? 'Guest' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="bg-white px-6 py-4 text-right border-t border-[#e7d8c4]">
                        <button id="payment-success-ok" type="button" class="inline-flex items-center justify-center rounded-lg border-2 border-[#4a9fd8] bg-white px-8 py-2 text-base font-semibold text-[#4a9fd8] transition hover:bg-[#4a9fd8] hover:text-white">OK</button>
                    </div>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 rounded-[24px] border border-red-500/20 bg-red-500/10 p-4 text-sm text-red-200">
                {{ session('error') }}
            </div>
        @endif

        <div id="payment-panel" class="space-y-6">
            <div class="rounded-[32px] border border-[#2a2a2a] bg-[#121212]/90 p-6 shadow-[0_40px_120px_-70px_rgba(0,0,0,0.9)]">
                <div class="mb-6 rounded-[24px] border border-[#2a2a2a] bg-[#121212] p-5">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <p class="text-xs uppercase tracking-[0.35em] text-[#c9a77c]/80">Payment Processing</p>
                            <h1 class="mt-3 text-3xl font-semibold text-[#f5f5f0]">For: {{ $booking->guest_name ?? $booking->user->name ?? 'Guest' }}</h1>
                            <p class="mt-2 text-sm text-[#8a8a8a]">Use the form below to process a guest payment, verify the received amount, and print the receipt.</p>
                        </div>

                        @php
                            $isPaid = ($booking->payment && $booking->payment->status === 'completed');
                            $paymentMethodLabel = $booking->payment ? ucfirst(str_replace('_', ' ', $booking->payment->payment_method)) : null;
                            $receiptNumber = session('receipt_number', $booking->payment->transaction_reference ?? null);
                            $amountPaid = session('amount_received', $booking->payment->amount ?? null);
                            $changePaid = session('change_amount', '0.00');
                        @endphp

                        <div class="flex items-center gap-3">
                            <span class="inline-flex rounded-full px-4 py-2 text-xs font-semibold tracking-wide border border-[#2a2a2a] {{ $isPaid ? 'bg-green-500/10 text-green-400' : 'bg-yellow-500/10 text-yellow-400' }}">
                                {{ $isPaid ? 'PAID' : 'PENDING' }}
                            </span>

                        @if($isPaid)
                                <button type="button"
                                        id="open-receipt-modal"
                                        class="inline-flex items-center justify-center rounded-full border border-[#c9a77c] bg-[#c9a77c]/10 px-4 py-2 text-sm font-semibold text-[#c9a77c] transition hover:bg-[#c9a77c]/20">
                                    [ Receipt ]
                                </button>
                            @endif
                        </div>

                        @if($isPaid)
                            <div id="receipt-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-[#0f0f0f]/70 px-4 py-6 opacity-0 pointer-events-none transition-opacity duration-300">
                                <div class="w-full max-w-md rounded-lg overflow-hidden border border-[#e7d8c4] bg-white shadow-[0_32px_120px_-60px_rgba(0,0,0,0.18)]">
                                    <div class="bg-[#c9a77c] px-6 py-4">
                                        <div class="flex items-center justify-between">
                                            <p class="text-sm font-semibold text-[#0f0f0f] uppercase tracking-wider">RECEIPT</p>
                                            <button id="receipt-modal-close-btn" type="button" class="text-[#0f0f0f] text-xl font-bold hover:opacity-80">✕</button>
                                        </div>
                                    </div>

                                    <div class="bg-[#121212] px-6 py-8 space-y-5">
                                        <div class="text-center">
                                            <p class="text-xs uppercase tracking-[0.35em] text-[#c9a77c]/90">Receipt #</p>
                                            <p id="receipt-number" class="mt-2 text-2xl font-semibold text-[#f5f5f0]">{{ $receiptNumber ?? 'RCPT' . str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</p>
                                        </div>

                                        <div class="space-y-3 text-sm">
                                            <div class="flex justify-between items-center">
                                                <span class="font-semibold text-[#c9a77c]">Guest:</span>
                                                <span class="text-[#f5f5f0]">{{ $booking->guest_name ?? $booking->user->name ?? 'Guest' }}</span>
                                            </div>

                                            <div class="flex justify-between items-center">
                                                <span class="font-semibold text-[#c9a77c]">Amount Paid:</span>
                                                <span class="text-[#f5f5f0]">₱{{ $amountPaid !== null ? $amountPaid : number_format($booking->payment->amount ?? $booking->total_price, 2) }}</span>
                                            </div>

                                            <div class="flex justify-between items-center">
                                                <span class="font-semibold text-[#c9a77c]">Change:</span>
                                                <span class="text-[#f5f5f0]">₱{{ $changePaid }}</span>
                                            </div>

                                            <div class="flex justify-between items-center">
                                                <span class="font-semibold text-[#c9a77c]">Method:</span>
                                                <span class="text-[#f5f5f0]">{{ session('receipt_method', $paymentMethodLabel ?? '—') }}</span>
                                            </div>

                                            <div class="flex justify-between items-center">
                                                <span class="font-semibold text-[#c9a77c]">Date Paid:</span>
                                                <span class="text-[#f5f5f0]">{{ optional($booking->payment?->created_at)->format('M d, Y') ?? now()->format('M d, Y') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="bg-white px-6 py-4 text-right border-t border-[#e7d8c4]">
                                        <button id="receipt-modal-ok" type="button" class="inline-flex items-center justify-center rounded-lg border border-[#c9a77c] bg-white px-8 py-2 text-base font-semibold text-[#0f0f0f] transition hover:bg-[#c9a77c]/20">OK</button>
                                    </div>
                                </div>
                            </div>
                        @endif
                        </div>

                    </div>
                </div>


                <div class="space-y-5">
                    <div class="rounded-3xl border border-[#2a2a2a] bg-[#111111] p-5">
                        <h2 class="text-sm uppercase tracking-[0.35em] text-[#c9a77c]/80">Reservation Summary</h2>
                        <div class="mt-4 space-y-4">
                            <div class="grid grid-cols-[160px_1fr] items-center gap-4 rounded-2xl border border-[#2a2a2a] bg-[#0f0f0f] px-4 py-3">
                                <span class="text-sm text-[#8a8a8a]">Reservation ID</span>
                                <span class="text-sm font-semibold text-[#f5f5f0]">#{{ $booking->id }}</span>
                            </div>
                            <div class="grid grid-cols-[160px_1fr] items-center gap-4 rounded-2xl border border-[#2a2a2a] bg-[#0f0f0f] px-4 py-3">
                                <span class="text-sm text-[#8a8a8a]">Guest Name</span>
                                <span class="text-sm font-semibold text-[#f5f5f0]">{{ $booking->guest_name ?? $booking->user->name ?? 'Guest' }}</span>
                            </div>
                            <div class="grid grid-cols-[160px_1fr] items-center gap-4 rounded-2xl border border-[#2a2a2a] bg-[#0f0f0f] px-4 py-3">
                                <span class="text-sm text-[#8a8a8a]">Room Number</span>
                                <span class="text-sm font-semibold text-[#f5f5f0]">#{{ $booking->room->room_number ?? '—' }}</span>
                            </div>
                            <div class="grid grid-cols-[160px_1fr] items-center gap-4 rounded-2xl border border-[#2a2a2a] bg-[#0f0f0f] px-4 py-3">
                                <span class="text-sm text-[#8a8a8a]">Room Type</span>
                                <span class="text-sm font-semibold text-[#f5f5f0]">{{ $booking->room->type ?? '—' }}</span>
                            </div>
                            <div class="grid grid-cols-[160px_1fr] items-center gap-4 rounded-2xl border border-[#2a2a2a] bg-[#0f0f0f] px-4 py-3">
                                <span class="text-sm text-[#8a8a8a]">Check-in</span>
                                <span class="text-sm font-semibold text-[#f5f5f0]">{{ $booking->check_in->format('Y-m-d') }}</span>
                            </div>
                            <div class="grid grid-cols-[160px_1fr] items-center gap-4 rounded-2xl border border-[#2a2a2a] bg-[#0f0f0f] px-4 py-3">
                                <span class="text-sm text-[#8a8a8a]">Check-out</span>
                                <span class="text-sm font-semibold text-[#f5f5f0]">{{ $booking->check_out->format('Y-m-d') }}</span>
                            </div>
                            <div class="grid grid-cols-[160px_1fr] items-center gap-4 rounded-2xl border border-[#2a2a2a] bg-[#0f0f0f] px-4 py-3">
                                <span class="text-sm text-[#8a8a8a]">Nights</span>
                                <span class="text-sm font-semibold text-[#f5f5f0]">{{ $booking->check_in->diffInDays($booking->check_out) }}</span>
                            </div>
                            <div class="grid grid-cols-[160px_1fr] items-center gap-4 rounded-2xl border border-[#2a2a2a] bg-[#0f0f0f] px-4 py-3">
                                <span class="text-sm text-[#8a8a8a]">Total Amount</span>
                                <span class="text-sm font-semibold text-[#f5f5f0]">₱{{ number_format($booking->total_price, 2) }}</span>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('admin.payments.store', $booking) }}" method="POST" class="space-y-5">
                        @csrf
                        <div class="rounded-3xl border border-[#2a2a2a] bg-[#111111] p-5">
                            <h2 class="text-sm uppercase tracking-[0.35em] text-[#c9a77c]/80">Select Payment Method</h2>
                            <div class="mt-4 grid gap-3 sm:grid-cols-3">
                                @foreach(['Cash', 'Credit Card', 'GCash', 'Debit Card', 'PayMaya', 'Bank Transfer'] as $method)
                                    <button type="button" class="payment-method-button rounded-full border border-[#2a2a2a] bg-[#121212] px-4 py-3 text-sm font-semibold text-[#f5f5f0] transition hover:border-[#c9a77c] hover:bg-[#c9a77c]/10 hover:text-[#f5f5f0]" data-method="{{ $method }}">{{ $method }}</button>
                                @endforeach
                            </div>
                            <div class="mt-4 rounded-full bg-[#c9a77c]/10 px-4 py-3 text-sm text-[#f5f5f0]">Selected: <span id="selected_method_label">Cash</span></div>
                            <input type="hidden" name="selected_method" id="selected_method" value="Cash" />
                        </div>

                        <div class="rounded-3xl border border-[#2a2a2a] bg-[#111111] p-5">
                            <h2 class="text-sm uppercase tracking-[0.35em] text-[#c9a77c]/80">Amount Received</h2>
                            <div class="mt-4 rounded-3xl border border-[#2a2a2a] bg-[#121212] px-4 py-3 flex items-center gap-3">
                                <span class="text-xl font-semibold text-[#c9a77c]">₱</span>
                                <input id="amount_received" name="amount_received" type="number" step="0.01" min="0" value="{{ old('amount_received', $booking->total_price) }}" class="w-full bg-transparent text-right text-xl font-semibold text-[#f5f5f0] placeholder:text-[#8a8a8a] outline-none" />
                            </div>
                            <div class="mt-4 grid gap-3 sm:grid-cols-4">
                                @foreach(['0', '100', '500', '1000'] as $preset)
                                    <button type="button" class="preset-amount rounded-full bg-[#121212] px-4 py-3 text-sm text-[#f5f5f0] transition hover:bg-[#c9a77c]/10 hover:text-[#f5f5f0]" data-value="{{ $preset }}">P{{ $preset }}</button>
                                @endforeach
                            </div>
                        </div>

                        <div class="rounded-3xl border border-[#2a2a2a] bg-[#111111] p-5">
                            <h2 class="text-sm uppercase tracking-[0.35em] text-[#c9a77c]/80">Change Calculation</h2>
                            <div class="mt-4 rounded-3xl border border-[#2a2a2a] bg-[#121212] px-4 py-4 text-center text-sm text-[#f5f5f0]">
                                <span class="block text-xs uppercase tracking-[0.35em] text-[#8a8a8a]">Change</span>
                                <span id="change_amount" class="mt-2 block text-3xl font-semibold text-[#c9a77c]">₱0.00</span>
                            </div>
                        </div>

                        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-end">
                            <a href="{{ route('admin.payments.index') }}" class="inline-flex items-center justify-center rounded-full border border-[#2a2a2a] bg-[#121212] px-6 py-3 text-sm font-semibold text-[#f5f5f0] hover:border-[#c9a77c] transition">Cancel</a>
                            <button type="submit" class="inline-flex items-center justify-center rounded-full bg-[#c9a77c] px-6 py-3 text-sm font-semibold text-[#0f0f0f] transition hover:bg-[#b89e6c]">Process Payment</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const paymentButtons = document.querySelectorAll('.payment-method-button');
            const selectedMethodInput = document.getElementById('selected_method');
            const selectedMethodLabel = document.getElementById('selected_method_label');
            const amountInput = document.getElementById('amount_received');
            const changeAmount = document.getElementById('change_amount');
            const totalAmount = {{ $booking->total_price }};

            let selectedMethod = selectedMethodInput?.value || 'Cash';

            function updateSelectedMethod(method) {
                selectedMethod = method;
                if (selectedMethodInput) {
                    selectedMethodInput.value = method;
                }
                if (selectedMethodLabel) {
                    selectedMethodLabel.textContent = method;
                }
                paymentButtons.forEach(button => {
                    button.classList.toggle('border-[#c9a77c]', button.dataset.method === method);
                    button.classList.toggle('bg-[#c9a77c]', button.dataset.method === method);
                    button.classList.toggle('text-[#0f0f0f]', button.dataset.method === method);
                    button.classList.toggle('text-[#f5f5f0]', button.dataset.method !== method);
                });
            }

            paymentButtons.forEach(button => {
                button.addEventListener('click', () => updateSelectedMethod(button.dataset.method));
            });

            document.querySelectorAll('.preset-amount').forEach(button => {
                button.addEventListener('click', () => {
                    if (!amountInput) {
                        return;
                    }
                    amountInput.value = button.dataset.value;
                    calculateChange();
                });
            });

            function calculateChange() {
                if (!amountInput || !changeAmount) {
                    return;
                }
                const received = parseFloat(amountInput.value) || 0;
                const change = received - totalAmount;
                changeAmount.textContent = `₱${change.toFixed(2)}`;
            }

            if (amountInput) {
                amountInput.addEventListener('input', calculateChange);
            }

            calculateChange();
            updateSelectedMethod(selectedMethod);

            const paymentSuccessModal = document.getElementById('payment-success-modal');

            const receiptModal = document.getElementById('receipt-modal');
            if (receiptModal) {
                const openReceiptModal = () => {
                    receiptModal.classList.remove('opacity-0', 'pointer-events-none', 'hidden');
                    receiptModal.classList.add('opacity-100', 'pointer-events-auto');
                };

                const closeReceiptModal = () => {
                    receiptModal.classList.remove('opacity-100', 'pointer-events-auto');
                    receiptModal.classList.add('opacity-0', 'pointer-events-none');
                    setTimeout(() => {
                        receiptModal.classList.add('hidden');
                        receiptModal.style.display = 'none';
                    }, 300);
                };

                document.getElementById('open-receipt-modal')?.addEventListener('click', openReceiptModal);
                document.getElementById('receipt-modal-ok')?.addEventListener('click', closeReceiptModal);
                document.getElementById('receipt-modal-close-btn')?.addEventListener('click', closeReceiptModal);

                receiptModal.addEventListener('click', (e) => {
                    if (e.target === receiptModal) closeReceiptModal();
                });
            }

            if (paymentSuccessModal) {

                paymentSuccessModal.classList.remove('opacity-0', 'pointer-events-none', 'hidden');
                paymentSuccessModal.classList.add('opacity-100', 'pointer-events-auto');

                const closeModal = () => {
                    paymentSuccessModal.classList.remove('opacity-100');
                    paymentSuccessModal.classList.add('opacity-0', 'pointer-events-none');
                    setTimeout(() => {
                        paymentSuccessModal.classList.add('hidden');
                        paymentSuccessModal.style.display = 'none';
                    }, 300);
                    document.getElementById('payment-panel')?.scrollIntoView({ behavior: 'smooth' });
                };

                const paymentSuccessOk = document.getElementById('payment-success-ok');
                paymentSuccessOk?.addEventListener('click', closeModal);

                const paymentSuccessClose = document.getElementById('payment-success-close-btn');
                paymentSuccessClose?.addEventListener('click', closeModal);
            }
        });
    </script>
</x-app-layout>
