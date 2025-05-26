<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\WebhookController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\PaymentController;


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin'       => Route::has('login'),
        'canRegister'    => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion'     => PHP_VERSION,
    ]);
});


Route::post('/locale', function () {
    $lang = request()->validate(['locale' => 'required|in:en,ru'])['locale'];
    Session::put('locale', $lang);
    return back(303);
})->name('locale.switch');


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile',   [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile',[ProfileController::class, 'destroy'])->name('profile.destroy');


     Route::get('/balance', [BalanceController::class, 'index'])
         ->name('balance.index');

    // 2) Создать платёж → редирект на YooKassa:
    Route::post('/balance/top-up', [BalanceController::class, 'createPayment'])
         ->name('balance.topup');

    // 3) Return URL — куда YooKassa возвращает пользователя:
    Route::get('/yookassa/success', [PaymentController::class, 'success'])
         ->name('yookassa.success');

    // 4) Получить JSON: текущий баланс (нужно, если хотим динамику через fetch/Axios):
    Route::get('/api/user/balance', [ProfileController::class, 'balance'])
         ->middleware('auth:sanctum'); 

    // 5) Список транзакций (Inertia-страница или JSON? сделаем Inertia):
    Route::get('/transactions', [TransactionController::class, 'index'])
         ->name('transactions.index');
});

Route::post('/webhook/yookassa', [WebhookController::class, 'handle'])
     ->name('webhook.yookassa');

require __DIR__.'/auth.php';
