<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use App\Models\User;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        // Если email уже подтвержден
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false).'?verified=1');
        }

        // Если email не был подтвержден, подтверждаем его
        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));

            // Обновляем статус пользователя на 2 (активен)
            $user = $request->user();
            $user->status = 2;
            $user->save();
        }

        return redirect()->intended(route('dashboard', absolute: false).'?verified=1');
    }
}
