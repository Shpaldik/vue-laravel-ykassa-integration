<?php

namespace App\Http\Controllers;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

class SetLocale
{
    public function handle(Request $request, Closure $next){
        $locale = session('locale');

        if(!$locale){
            $browserLang = substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0,2);
            $locale = in_array($browserLang, ['en', 'ru']) ? $browserLang : config('app.locale');
            session(['locale' => $locale]);
        }
        App::setLocale($locale);
        return $next($request);
    }
}
