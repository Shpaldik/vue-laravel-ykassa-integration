<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UpdateLastActivity
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->last_activity === null || now()->diffInMinutes($user->last_activity) > 1) {
                $user->last_activity = Carbon::now();
                $user->save();
            }
        }

        return $next($request);
    }
}
