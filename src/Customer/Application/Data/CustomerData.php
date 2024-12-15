<?php

namespace Src\Customer\Application\Data;

use Spatie\LaravelData\Data;
use Src\Customer\Domain\Customer;

class CustomerData extends Data
{
    public function __construct(
        public string $fullName,
        public string $email,
    ) {}


    public static function fromModel(Customer $customer): self
    {
        return new self(
            fullName: $customer->getFullName(),
            email: $customer->getEmail(),
        );
    }
}
