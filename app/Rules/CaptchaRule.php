<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Http\Service\CaptchaService;

class CaptchaRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $captcha = new CaptchaService($value);
        $response = $captcha->validate($value);

        if (! $response['success']) {
            $fail('Invalid captcha response');
        }

    }
}
