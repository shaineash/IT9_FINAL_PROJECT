<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function create(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        if ($booking->status === 'cancelled') {
            return redirect()->route('user.bookings.show', $booking)
                ->with('error', 'Cancelled bookings cannot be paid.');
        }

        if ($booking->payment && $booking->payment->status === 'completed') {
            return redirect()->route('user.bookings.show', $booking)
                ->with('success', 'Payment already completed for this booking.');
        }

        $booking->load('room');

        return view('user.payments.create', compact('booking'));
    }

    public function store(Request $request, Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        if ($booking->status === 'cancelled') {
            return redirect()->route('user.bookings.show', $booking)
                ->with('error', 'Cancelled bookings cannot be paid.');
        }

        $validated = $request->validate([
            'payment_method' => 'required|in:card,paypal,bank_transfer',
            'cardholder_name' => 'required|string|max:150',
            'card_number' => ['required', 'string', 'regex:/^[0-9\s]{13,23}$/'],
            'expiration_date' => ['required', 'regex:/^(0[1-9]|1[0-2])\/\d{2}$/'],
            'cvv' => 'required|digits_between:3,4',
            'billing_address' => 'required|string|max:255',
        ]);

        $cardNumber = preg_replace('/\D/', '', $validated['card_number']);
        $last4 = substr($cardNumber, -4);
        $cardBrand = $this->guessCardBrand($cardNumber);

        // Use transaction to ensure atomicity of payment creation and booking status update
        DB::transaction(function () use ($booking, $validated, $last4, $cardBrand) {
            Payment::create([
                'booking_id' => $booking->id,
                'user_id' => Auth::id(),
                'payment_method' => $validated['payment_method'],
                'cardholder_name' => $validated['cardholder_name'],
                'card_brand' => $cardBrand,
                'card_last4' => $last4,
                'billing_address' => $validated['billing_address'],
                'amount' => $booking->total_price,
                'status' => 'completed',
                'transaction_reference' => Str::upper('PAY'.Str::random(10)),
            ]);

            // Keep status as pending — admin confirms the booking
            // Only update if still in initial pending state
            if ($booking->status === 'pending') {
                $booking->update(['status' => 'pending']);
            }
        });

        return redirect()->route('user.bookings.show', $booking)
            ->with('success', 'Payment received. Your booking is now awaiting confirmation.');
    }

    private function guessCardBrand(string $number): string
    {
        if (preg_match('/^4[0-9]{12}(?:[0-9]{3})?$/', $number)) {
            return 'Visa';
        }

        if (preg_match('/^5[1-5][0-9]{14}$/', $number)) {
            return 'Mastercard';
        }

        if (preg_match('/^3[47][0-9]{13}$/', $number)) {
            return 'American Express';
        }

        return 'Card';
    }
}
