<?php
namespace App\Domain\Entities;

class Room
{
    public int $id;
    public int $hotelId;
    public string $roomNumber;
    public int $capacity;
    public float $pricePerNight;

    public function __construct(int $id, int $hotelId, string $roomNumber, float $pricePerNight)
    {
        $this->id = $id;
        $this->hotelId = $hotelId;
        $this->roomNumber = $roomNumber;
        $this->pricePerNight = $pricePerNight;
    }
}
