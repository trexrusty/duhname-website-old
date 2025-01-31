<?php

namespace App\Http\Requests\Social\Store;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Rules\CaptchaRule;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'content' => 'required|string|max:255',
            'community_id' => 'nullable|exists:communities,id',
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
