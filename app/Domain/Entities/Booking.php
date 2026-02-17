<?php
namespace App\Domain\Entities;

use Carbon\Carbon;

class Booking
{
    public int $roomId;
    public string $userName;

    public string $userEmail;
    public float $totalPrice;
    public string $checkInDate;
    public string $checkOutDate;

    public function __construct(
                                int $roomId,
                                string $userName,
                                string $userEmail,
                                float $totalPrice,
                                string $checkInDate = '',
                                string $checkOutDate = '')
    {
        $this->roomId = $roomId;
        $this->userName = $userName;
        $this->userEmail = $userEmail;
        $this->totalPrice = $totalPrice;
        $this->checkInDate = $checkInDate;
        $this->checkOutDate = $checkOutDate;
    }
}
