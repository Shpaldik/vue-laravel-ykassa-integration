<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        // 1) сначала смотрим сессию
        $lang = Session::get('locale');

        // 2) иначе – из Accept-Language
        if (! $lang) {
            $lang = substr($request->header('Accept-Language', ''), 0, 2);
        }

        // 3) если не из доступных – берём fallback
        $available = config('app.available_locales', ['en','ru']);
        if (! in_array($lang, $available)) {
            $lang = config('app.fallback_locale', 'en');
        }

        App::setLocale($lang);

        return $next($request);
    }
}
