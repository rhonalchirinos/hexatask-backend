<?php

namespace Src\Customer\Infrastructure\Actions;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Src\Customer\Application\CustomerUseCase;
use Src\Customer\Application\Data\CustomerData;

/**
 *
 */
class CustomerAction
{
    public function __construct(private CustomerUseCase $customerUseCase) {}

    /**
     * Provision a new web server.
     */
    public function __invoke(Request $request)
    {
        $customer = $this->customerUseCase->getCustomerById(auth('customer')->id());

        return CustomerData::fromModel($customer);
    }
}
