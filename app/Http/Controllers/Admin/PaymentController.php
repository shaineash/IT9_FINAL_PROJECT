<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    /**
     * Display a listing of payments for admin review.
     */
    public function index(Request $request)
    {
        $query = Booking::with(['user', 'room', 'payment'])
            ->where(function ($query) {
                $query->where('status', 'confirmed')
                    ->orWhereHas('payment');
            });

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                    ->orWhere('guest_name', 'like', "%{$search}%")
                    ->orWhereHas('room', function ($roomQuery) use ($search) {
                        $roomQuery->where('room_number', 'like', "%{$search}%")
                            ->orWhere('type', 'like', "%{$search}%");
                    })
                    ->orWhereHas('payment', function ($paymentQuery) use ($search) {
                        $paymentQuery->where('transaction_reference', 'like', "%{$search}%")
                            ->orWhere('payment_method', 'like', "%{$search}%");
                    });
            });
        }

        $bookings = $query->latest()->paginate(15)->withQueryString();
        $todayPayments = Payment::whereDate('created_at', today())->count();
        $totalRevenue = Payment::sum('amount');

        return view('admin.payments.index', compact('bookings', 'todayPayments', 'totalRevenue'));
    }

    /**
     * Show the admin payment processing page for a booking.
     */
    public function create(Booking $booking)
    {
        $booking->load(['user', 'room', 'payment']);

        return view('admin.payments.process', compact('booking'));
    }

    /**
     * Process payment for a booking and generate a receipt.
     */
    public function store(Request $request, Booking $booking)
    {
        if ($booking->status === 'cancelled') {
            return back()->with('error', 'Cancelled bookings cannot be paid.');
        }

        $validated = $request->validate([
            'selected_method' => 'required|in:Cash,Credit Card,GCash,Debit Card,PayMaya,Bank Transfer',
            'amount_received' => 'required|numeric|min:0',
        ]);

        $amountReceived = (float) $validated['amount_received'];
        $totalAmount = (float) $booking->total_price;

        if ($amountReceived < $totalAmount) {
            return back()->withInput()->with('error', 'Amount received must cover the total amount due.');
        }

        $methodMap = [
            'Cash' => 'bank_transfer',
            'Credit Card' => 'card',
            'GCash' => 'bank_transfer',
            'Debit Card' => 'card',
            'PayMaya' => 'bank_transfer',
            'Bank Transfer' => 'bank_transfer',
        ];

        $payment = Payment::create([
            'booking_id' => $booking->id,
            'user_id' => $booking->user_id,
            'payment_method' => $methodMap[$validated['selected_method']],
            'cardholder_name' => $booking->guest_name ?? ($booking->user->name ?? 'Guest'),
            'card_brand' => $validated['selected_method'],
            'card_last4' => null,
            'billing_address' => 'Processed by admin',
            'amount' => $totalAmount,
            'status' => 'completed',
            'transaction_reference' => Str::upper('RCT' . now()->format('YmdHis') . Str::random(4)),
        ]);

        $booking->update(['status' => 'confirmed']);

        return redirect()->route('admin.payments.process', $booking)
            ->with([
                'success' => 'Payment accepted successfully.',
                'receipt_number' => $payment->transaction_reference,
                'receipt_method' => $validated['selected_method'],
                'amount_received' => number_format($amountReceived, 2),
                'change_amount' => number_format($amountReceived - $totalAmount, 2),
            ]);
    }
}
