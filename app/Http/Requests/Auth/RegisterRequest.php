<?php

namespace App\Http\Requests\Auth;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'             => 'required|string|max:255',
            'email'            => 'required|string|email|unique:users,email',
            'password'         => ['required','confirmed', Password::defaults()],
            'captcha_token'    => 'required|string',
        ];
    }

    protected function passedValidation()
    {
        $resp = Http::asForm()->post(config('services.google_recaptcha.url'), [
            'secret' => config('services.google_recaptcha.secret'),
            'response' => $this->captcha_token,
            'remoteip' => $this->ip(),
            
        ])->json();

        if(!($resp['success'] ?? false) || ($resp['score'] ?? 0) < 0.5){
            throw ValidationException::withMessages([
                'captcha_token' => 'Captcha Failed. Please try again',
            ]);
        }
    }
}
