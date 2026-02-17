<?php
namespace App\Jobs;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class BookingEmailJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels,Dispatchable;

    public Booking $reservationModel;

    public function __construct(Booking $reservation)
    {
        $this->reservationModel = $reservation;
    }

    public function handle(): void
    {
        //send email here
    }
}
