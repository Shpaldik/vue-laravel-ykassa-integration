<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use YooKassa\Client;
use App\Models\Transaction;
use Inertia\Inertia;
use App\Models\User;

class BalanceController extends Controller
{
    public function createPayment(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:' . config('services.yookassa.min_amount'),
            'email'  => 'required|email',
        ]);

        /** @var \App\Models\User $user */
        $user   = $request->user();
        $amount = number_format($request->amount, 2, '.', '');

        $client = new Client();
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

        // Сохраняем запись о транзакции в БД
        Transaction::create([
            'user_id'             => $user->id,
            'yookassa_payment_id' => $payment->getId(),
            'amount'              => $amount,
            'currency'            => 'RUB',
            'status'              => $payment->getStatus(),
        ]);

        // Вместо обычного redirect() для Inertia используем Inertia::location()
        $confirmationUrl = $payment->getConfirmation()->getConfirmationUrl();
        return Inertia::location($confirmationUrl);
    }

     public function success(Request $request, $user )
    {
        $user = auth()->user()->fresh();

        return Inertia::render('PaymentSuccess', [
            'message' => 'Ваш платёж успешно проведён!',
        ]);

    }
}
