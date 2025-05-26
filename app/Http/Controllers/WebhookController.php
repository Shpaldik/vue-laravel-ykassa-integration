<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Transaction;

class WebhookController extends Controller
{
    /**
     * Обрабатывает POST от YooKassa. Ожидаем payload с event='payment.succeeded'.
     */
    public function handle(Request $request)
    {
        Log::info('YooKassa Webhook payload:', $request->all());

        $payload = $request->all();

        if (data_get($payload, 'event') !== 'payment.succeeded') {
            return response()->json(['status' => 'ignored']);
        }

        $paymentId = data_get($payload, 'object.id');
        $transaction = Transaction::where('yookassa_payment_id', $paymentId)->first();

        if (! $transaction) {
            Log::warning("Transaction not found: {$paymentId}");
            return response()->json(['status' => 'not_found'], 404);
        }

        if ($transaction->status === 'succeeded') {
            return response()->json(['status' => 'already_processed']);
        }

        $transaction->status = 'succeeded';
        $transaction->save();

        $user = $transaction->user;
        $oldBalance = $user->balance;
        $user->increment('balance', $transaction->amount);
        $user->refresh();

        Log::info('Balance updated via Webhook', [
            'user_id'     => $user->id,
            'old_balance' => $oldBalance,
            'new_balance' => $user->balance,
        ]);

        return response()->json(['status' => 'ok']);
    }
}
