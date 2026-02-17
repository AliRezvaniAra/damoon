<?php
namespace App\Providers;

use App\Infrastructure\Repositories\BookingRepository;
use App\Infrastructure\Repositories\Contracts\BookingRepositoryInterface;
use App\Infrastructure\Repositories\RoomRepository;
use Illuminate\Support\ServiceProvider;
use App\Infrastructure\Repositories\Contracts\RoomRepositoryInterface;

class BookingServiceProvider extends ServiceProvider
{

    public $bindings = [
        RoomRepositoryInterface::class => RoomRepository::class,
        BookingRepositoryInterface::class => BookingRepository::class,
    ];
    public function register(): void
    {
        $this->app->bind(RoomRepositoryInterface::class, RoomRepository::class);
        $this->app->bind(BookingRepositoryInterface::class, BookingRepository::class);

    }

    public function boot()
    {
    }
}
