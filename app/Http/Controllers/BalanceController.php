<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use YooKassa\Client;
use App\Models\Transaction;
use Inertia\Inertia;

class BalanceController extends Controller
{
    /**
     * Показывает Inertia-страницу «Баланс» со всеми данными:
     *  - текущий баланс пользователя ($user->balance),
     *  - форма пополнения (минимум из config),
     *  - последние 10 транзакций (постранично).
     */
    public function index(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = $request->user()->load(['transactions' => function($q) {
            // последние 10 операций, по дате DESC
            $q->orderBy('created_at', 'desc')->paginate(10);
        }]);

        // минимальная сумма в конфиге: config('services.yookassa.min_amount')
        $minAmount = config('services.yookassa.min_amount');

        return Inertia::render('Balance/Index', [
            'user'       => $user,
            'transactions'=> $user->transactions, // здесь лежит LengthAwarePaginator
            'minAmount'  => $minAmount,
        ]);
    }

    /**
     * Создаёт платёж в YooKassa и сохраняет транзакцию со статусом pending.
     * Затем выполняет редирект браузера на confirmation_url.
     */
    public function createPayment(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:' . config('services.yookassa.min_amount'),
            'email'  => 'required|email',
        ]);

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

        // Сохраняем транзакцию с привязкой к пользователю:
        Transaction::create([
            'user_id'             => $user->id,
            'yookassa_payment_id' => $payment->getId(),
            'amount'              => $amount,
            'currency'            => 'RUB',
            'status'              => $payment->getStatus(), // чаще всего "pending"
        ]);

        // Редирект на страницу оплаты YooKassa:
        $confirmationUrl = $payment->getConfirmation()->getConfirmationUrl();

        // Inertia::location() даёт полноценный JS-редирект:
        return Inertia::location($confirmationUrl);
    }
}
