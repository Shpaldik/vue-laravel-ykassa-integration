<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use YooKassa\Client;

class YooKassaController extends Controller
{
    public function success(Request $request)
    {
        $user = auth()->user();
        $client = new Client();
        $client->setAuth(
            config('services.yookassa.shop_id'),
            config('services.yookassa.secret_key')
        );

        // Обновляем статус всех "pending" платежей
        $transactions = $user->transactions()->where('status', 'pending')->get();
        $total = 0;

        foreach ($transactions as $transaction) {
            $payment = $client->getPaymentInfo($transaction->yookassa_payment_id);
            if ($payment->getStatus() === 'succeeded') {
                $transaction->status = 'succeeded';
                $transaction->save();

                $total += $transaction->amount;
            }
        }

        if ($total > 0) {
            $user->balance += $total;
            $user->save();
        }

        return Inertia::render('PaymentSuccess', [
            'message' => 'Ваш платёж успешно проведён!',
        ]);
    }
}
