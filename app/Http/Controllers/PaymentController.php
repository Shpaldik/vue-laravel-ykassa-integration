<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use YooKassa\Client;
use App\Models\Transaction;
use Inertia\Inertia;

class PaymentController extends Controller
{
    /**
     * Обработчик return_url (GET /yookassa/success).
     * Проверяем все «pending» транзакции пользователя, обновляем статус и баланс.
     */
    public function success(Request $request)
    {
        $user = $request->user();

        $client = new Client();
        $client->setAuth(
            config('services.yookassa.shop_id'),
            config('services.yookassa.secret_key')
        );

        $transactions = $user->transactions()->where('status', 'pending')->get();
        $totalAdded = 0;

        foreach ($transactions as $transaction) {
            $payment = $client->getPaymentInfo($transaction->yookassa_payment_id);
            if ($payment->getStatus() === 'succeeded') {
                $transaction->status = 'succeeded';
                $transaction->save();

                $user->increment('balance', $transaction->amount);
                $totalAdded += $transaction->amount;
            }
        }

        if ($totalAdded > 0) {
            $user->refresh();
        }

        return Inertia::render('PaymentSuccess', [
            'message'      => 'Ваш платёж успешно проведён!',
            'added_amount' => $totalAdded,
            'balance'      => $user->balance,
        ]);
    }
}
