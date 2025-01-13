<?php

namespace App\Http\Service;

use Illuminate\Support\Facades\Http;

class CaptchaService
{
    protected ?string $url = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';

    public function __construct(private string $secret_key)
    {
        $this->secret_key = config('app.captcha.secret_key');
    }

    public function validate(?string $cfResponse = null): array
    {
        $captchaResponse = is_null($cfResponse)
        ? request()->get('cf-turnstile-response')
        : $cfResponse;

        $response = Http::asJson()
        ->timeout(30)
        ->connectTimeout(10)
        ->throw(
            fn () => back()->with('error', 'An unkown error occured, please refresh the page and try again.')
        )
        ->post($this->url, [
            'secret' => $this->secret_key,
            'response' => $captchaResponse,
        ]);

        return count($response->json())
            ? $response->json()
            : [
                'success' => false,
                'message' => 'Unknow error occured, please try again',
            ];
    }
}
