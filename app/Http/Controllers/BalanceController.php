<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use YooKassa\Client;
use App\Models\Transaction;

class BalanceController extends Controller
{

public function createPayment(Request $request)
    {

        $request->validate([
            'amount' => 'required|numeric|min:' . config('services.yookassa.min_amount'),
            'email'  => 'required|email',
        ]);

        $user   = $request->user();
        $amount = number_format($request->amount, 2, '.', '');

        $client = new Client();
        // Передаём оба параметра: shop_id и secret_key
        $client->setAuth(
            config('services.yookassa.shop_id'),
            config('services.yookassa.secret_key')
        );

        $payment = $client->createPayment([
            'amount'       => ['value' => $amount, 'currency' => 'RUB'],
            'confirmation' => [
                'type'       => 'redirect',
                'return_url' => route('yookassa.success'),
            ],
            'capture'      => true,
            'description'  => 'Пополнение баланса ' . $user->email,
        ], uniqid('', true));

        Transaction::create([
            'user_id'               => $user->id,
            'yookassa_payment_id'   => $payment->getId(),
            'amount'                => $amount,
            'currency'              => 'RUB',
            'status'                => $payment->getStatus(),
        ]);

        return redirect($payment->getConfirmation()->getConfirmationUrl());
    }


}
