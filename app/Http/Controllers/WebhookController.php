<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        $payload = $request->json()->all();

        if (($payload['event'] ?? null) === 'payment.succeeded') {
            $payment = $payload['object'];
            $transaction = Transaction::where('yookassa_payment_id', $payment['id'])->first();

            if ($transaction && $transaction->status !== 'succeeded') {
                $transaction->update(['status' => 'succeeded']);
                $transaction->user->increment('balance', $transaction->amount);
            }
        }

        return response()->json(['message' => 'OK']);
    }
}
