<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use Src\Customer\Infrastructure\Actions\CustomerAction;
use Src\Customer\Infrastructure\Actions\LoginCustomerAction;
use Src\Customer\Infrastructure\Actions\LogoutCustomerAction;
use Src\Customer\Infrastructure\Actions\RegisterCustomerAction;
use Src\Task\Infrastructure\Actions\TaskAction;

Route::post('signup', RegisterCustomerAction::class);
Route::post('login', LoginCustomerAction::class);

Route::middleware('auth:customer')->group(function () {
    Route::get('me', CustomerAction::class);

    Route::apiResource('tasks', TaskAction::class);
    Route::delete('logout',  LogoutCustomerAction::class);
});
