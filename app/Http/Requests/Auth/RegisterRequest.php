<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CaptchaRule;
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
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'tag' => 'required|string|max:255|unique:users',
            'cf-turnstile-response' => ['required', new CaptchaRule],
        ];
    }

    public function validated($key = null, $default = null): array
    {
        $validated = parent::validated();
        unset($validated['cf-turnstile-response']);

        return $validated;
    }
}

