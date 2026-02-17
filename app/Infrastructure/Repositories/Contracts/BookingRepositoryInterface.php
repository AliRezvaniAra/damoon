<?php
namespace App\Infrastructure\Repositories\Contracts;

use App\Models\Booking;

interface BookingRepositoryInterface
{
    public function create(array $data): Booking;

}
