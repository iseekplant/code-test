<?php

namespace Tests\Unit;

use App\Rules\AustralianPhoneNumber;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PhoneNumberValidatorTest extends TestCase
{
    #[Test]
    public function it_accepts_valid_au_phone_numbers(): void
    {
        $rule = new AustralianPhoneNumber();

        $validNumbers = [
            '0400000000',
            '+61400000000',
            '1300123456',
            '(02) 9876 5432',
        ];

        foreach ($validNumbers as $number) {
            $validator = Validator::make(
                ['contact_phone' => $number],
                ['contact_phone' => [$rule]]
            );

            $this->assertTrue(
                $validator->passes(),
                "Expected '{$number}' to be valid, but validation failed."
            );
        }
    }

    #[Test]
    public function it_rejects_invalid_or_non_au_phone_numbers(): void
    {
        $rule = new AustralianPhoneNumber();

        $invalidNumbers = [
            '12345',
            '+15553334444',
            'abcdefg',
            '+441234567890',
            '0000000000',
        ];

        foreach ($invalidNumbers as $number) {
            $validator = Validator::make(
                ['contact_phone' => $number],
                ['contact_phone' => [$rule]]
            );

            $this->assertTrue(
                $validator->fails(),
                "Expected '{$number}' to be invalid, but validation passed."
            );
        }
    }
}
