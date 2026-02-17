<?php

namespace App\Application\Services;

use App\Infrastructure\Repositories\Contracts\RoomRepositoryInterface;
use App\Infrastructure\Repositories\Contracts\BookingRepositoryInterface;
use App\Domain\Exceptions\NotEnoughCapacityException;
use App\Domain\Entities\Booking as DomainReservation;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BookingService
{
    public function __construct(
        protected RoomRepositoryInterface    $roomRepo,
        protected BookingRepositoryInterface $reservationRepo
    )
    {
    }

    public function reserve(int    $roomId,
                            string $userName,
                            string $userEmail,
                            string $checkInDate = '',
                            string $checkOutDate = ''): DomainReservation
    {
        //for prevent lock a room by two or more users in the same time

        return DB::transaction(function () use ($roomId, $userName, $userEmail, $checkInDate, $checkOutDate) {
            $room = $this->roomRepo->findForUpdate($roomId);

            if (!$room) {
                throw new NotEnoughCapacityException('Room not found');
            }

            // compute reserved amount in date range
            $start = Carbon::parse($checkInDate);
            $end = Carbon::parse($checkOutDate);
            $totalPrice = 0;
            for ($date = $start; $date->lte($end); $date->addDay()) {
                $reservedAmount = Booking::where('room_id', $roomId)
                    ->whereDate('check_in_date', $date)
                    ->count('id');
                if ($room->capacity < $reservedAmount) {
                    throw new NotEnoughCapacityException('Not enough capacity in selected dates');
                }
                $reservedAmount = Booking::where('room_id', $roomId)
                    ->whereDate('check_out_date', $date)
                    ->count('id');
                if ($room->capacity < $reservedAmount) {
                    throw new NotEnoughCapacityException('Not enough capacity in selected dates');
                }
                $totalPrice += $room->price_per_night;
            }

            $reservation = $this->reservationRepo->create([
                'room_id' => $roomId,
                'user_name' => $userName,
                'user_email' => $userEmail,
                'check_in_date' => $checkInDate,
                'check_out_date' => $checkOutDate,
                'total_price' => $totalPrice,
            ]);

            $domainReservation = new DomainReservation(
                $reservation->room_id,
                $reservation->user_name,
                $reservation->user_email,
                $reservation->total_price,
                $reservation->check_in_date,
                $reservation->check_out_date
            );


            \App\Jobs\BookingEmailJob::dispatch($reservation);

            return $domainReservation;
        });

    }

}
