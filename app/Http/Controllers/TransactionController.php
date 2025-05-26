<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class TransactionController extends Controller
{
    /**
     * Показывает страницу «История транзакций» (последние 10 + пагинация).
     */
    public function index(Request $request)
    {
        $user = $request->user();

        // Берём пагинатор из модели User::transactions()
        $transactions = $user->transactions()
                             ->orderBy('created_at', 'desc')
                             ->paginate(10);

        return Inertia::render('Balance/Transactions', [
            'transactions' => $transactions,
        ]);
    }
}
