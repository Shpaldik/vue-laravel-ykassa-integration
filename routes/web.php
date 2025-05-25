<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\WebhookController;


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
});

Route::post('/balance/top-up', [BalanceController::class, 'createPayment'])->name('balance.topup');
    Route::get('/yookassa/success', [BalanceController::class, 'success'])
         ->name('yookassa.success');
Route::post('/yookassa/webhook', [WebhookController::class, 'handle'])->withoutMiddleware([\Illuminate\Session\Middleware\StartSession::class]);


require __DIR__.'/auth.php';
