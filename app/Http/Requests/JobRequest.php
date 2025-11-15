<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\AustralianPhoneNumber;

class JobRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'contact_name' => 'required',
            'contact_phone' => ['required', new AustralianPhoneNumber()],
            'contact_email' => 'required',
            'location' => 'required',
            'details' => 'required',
        ];
    }
}
