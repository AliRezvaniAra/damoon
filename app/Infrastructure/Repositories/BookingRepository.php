<?php
namespace App\Infrastructure\Repositories;

use App\Infrastructure\Repositories\Contracts\BookingRepositoryInterface;
use App\Models\Booking;


class BookingRepository implements BookingRepositoryInterface
{
    public function create(array $data): Booking
    {
        return Booking::create($data);
    }
}
