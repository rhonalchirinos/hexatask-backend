<?php

namespace Src\Customer\Infrastructure\Actions;

use Illuminate\Http\Request;
use Src\Customer\Application\CustomerUseCase;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 *
 */
class LoginCustomerAction
{
    public function __construct(private CustomerUseCase $CustomerUseCase) {}

    /**
     * Provision a new web server.
     */
    public function __invoke(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
        $token = $this->CustomerUseCase->loginCustomer($credentials);

        if ($token === false) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json(['token' => $token]);
    }
}
