<?php

namespace Src\Customer\Infrastructure\Actions;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * 
 */
class LogoutCustomerAction
{

    /**
     * Provision a new web server.
     */
    public function __invoke(Request $request)
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());

            return response()->json(
                [
                    'message' => 'Successfully logged out'
                ],
                200
            );
        } catch (TokenInvalidException $e) {
            Log::error($e->getTraceAsString());

            return response()->json(
                [
                    'error' => 'Token is invalid'
                ],
                400
            );
        }
    }
}
