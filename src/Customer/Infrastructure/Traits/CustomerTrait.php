<?php

namespace Src\Customer\Infrastructure\Traits;

trait CustomerTrait
{
    public function getCustomer()
    {
        $customer_id = auth('customer')->id();
        $customer = $this->customerUserCase->getCustomerById($customer_id);

        return $customer;
    }
}
