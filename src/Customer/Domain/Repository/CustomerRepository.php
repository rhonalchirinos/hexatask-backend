<?php

namespace Src\Customer\Domain\Repository;

use Src\Customer\Domain\Customer;

interface CustomerRepository
{
    public function findById(int $id): ?Customer;
    public function findAll(): array;
    public function save(Customer $customer): void;
    public function delete(Customer $customer): void;
}
