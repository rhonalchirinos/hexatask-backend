<?php

namespace Src\Customer\Infrastructure\Actions;

use Illuminate\Http\Request;
use Src\Customer\Application\CustomerUseCase;

/**
 *
 */
class RegisterCustomerAction
{
    public function __construct(private CustomerUseCase $CustomerUseCase) {}

    /**
     * Provision a new web server.
     */
    public function __invoke(Request $request)
    {
        $customerData = $request->all();
        $this->CustomerUseCase->createCustomer($customerData);

        $token = $this->CustomerUseCase->loginCustomer([
            'email' => $customerData['email'],
            'password' => $customerData['password']
        ]);

        return response()->json(['token' => $token]);
    }
}
