<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Customer\Domain\Repository\CustomerRepository;
use Src\Customer\Infrastructure\Repository\DBCustomerRepository;
use Src\Task\Infrastructure\Repository\DBTaskRepository;
use Src\Task\Domain\Repository\TaskRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(CustomerRepository::class, DBCustomerRepository::class);
        $this->app->bind(TaskRepository::class, DBTaskRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //


    }
}
