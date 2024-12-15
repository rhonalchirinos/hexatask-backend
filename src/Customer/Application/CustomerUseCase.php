<?php

namespace Src\Customer\Application;

use Src\Customer\Application\Data\RegisterCustomerData;
use Src\Customer\Domain\Customer;
use Src\Customer\Domain\Repository\CustomerRepository;

class CustomerUseCase
{
    /**
     * 
     */
    private $customerRepository;

    /**
     * 
     */
    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * 
     */
    public function createCustomer(array $data)
    {
        // validate 
        $validated  = RegisterCustomerData::validate($data);

        $customer = new Customer(
            full_name: $validated['fullName'],
            email: $validated['email'],
            password: $validated['password'],
        );

        $this->customerRepository->save($customer);
    }

    /**
     * 
     */
    public function loginCustomer(array $credentials)
    {
        return auth('customer')->attempt($credentials);
    }

    /**
     * 
     *
     */
    public function getCustomerById(int $id): ?Customer
    {
        return $this->customerRepository->findById($id);
    }
}
