<?php

namespace App\Providers;

use App\Repositories\Eloquent\BookingRepository;
use App\Repositories\Eloquent\ResourceRepository;
use App\Repositories\Interfaces\BookingRepositoryInterface;
use App\Repositories\Interfaces\ResourceRepositoryInterface;
use Carbon\Laravel\ServiceProvider;


class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(BookingRepositoryInterface::class, BookingRepository::class);
        $this->app->bind(ResourceRepositoryInterface::class, ResourceRepository::class);
    }
}
