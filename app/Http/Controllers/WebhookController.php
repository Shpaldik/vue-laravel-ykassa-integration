<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Transaction;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        Log::info('YooKassa Webhook payload:', $request->all());

        $payload = $request->all();
        if (($payload['event'] ?? '') !== 'payment.succeeded') {
            return response()->json(['status' => 'ignored']);
        }

        $paymentId = data_get($payload, 'object.id');
        Log::info("Looking up transaction {$paymentId}");
        $transaction = Transaction::where('yookassa_payment_id', $paymentId)->first();

        if (! $transaction) {
            Log::warning("Transaction not found: {$paymentId}");
            return response()->json(['status' => 'not_found'], 404);
        }

        // Если уже succeeded — пропускаем
        if ($transaction->status === 'succeeded') {
            Log::info("Transaction {$paymentId} already succeeded");
            return response()->json(['status' => 'already_processed']);
        }

        // Обновляем
        $transaction->status = 'succeeded';
        $transaction->save();

        // Правильный инкремент баланса — через модель пользователя
        $user = $transaction->user;
        $oldBalance = $user->balance;
        $user->increment('balance', $transaction->amount);
        $user->refresh();

        Log::info('Balance updated for user', [
            'user_id'     => $user->id,
            'old_balance' => $oldBalance,
            'new_balance' => $user->balance,
        ]);

        return response()->json(['status' => 'ok']);
    }

}
