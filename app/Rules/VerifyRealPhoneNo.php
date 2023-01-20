<?php

namespace App\Rules;

use Illuminate\Support\Facades\Http;
use Illuminate\Contracts\Validation\InvokableRule;

class VerifyRealPhoneNo implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        $response = Http::withHeaders([
            'apikey' => env('PHONE_VERIFICATION_KEY'),
        ])->get(env('PHONE_VERIFICATION_URL'), [
            'number' => $value,
        ]);

        $decoded = json_decode($response->body(), true);

        if($decoded['valid'] == false) {
            $fail('The :attribute is an invalid phone no.');
        }
    }
}
