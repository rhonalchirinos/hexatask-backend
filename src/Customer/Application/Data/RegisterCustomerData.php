<?php

namespace Src\Customer\Application\Data;

use Spatie\LaravelData\Data;

class RegisterCustomerData extends Data
{
    public function __construct(
        public string $fullName,
        public string $email,
        public string $password,
    ) {}


    public static function rules(): array
    {
        return [
            'email' => ['required', 'email', 'unique:customers,email'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }
}
