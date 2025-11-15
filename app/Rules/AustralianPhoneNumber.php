<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberUtil;

class AustralianPhoneNumber implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $phoneUtil = PhoneNumberUtil::getInstance();

        try {
            $number = $phoneUtil->parse($value, 'AU');

            if (! $phoneUtil->isValidNumberForRegion($number, 'AU')) {
                $fail("The {$attribute} field must be a valid Australian phone number.");
            }
        } catch (NumberParseException $e) {
            $fail("The {$attribute} field must be a valid Australian phone number.");
        }
    }
}
