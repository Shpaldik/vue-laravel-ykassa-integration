<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function switch(Request $request)
    {
        $locale = $request->input('locale');

        if (!in_array($locale, ['en', 'ru'])) {
            $locale = config('app.locale');
        }

        session(['locale' => $locale]);

        return response()->noContent(); // не перенаправляем, это просто POST-запрос
    }
}
