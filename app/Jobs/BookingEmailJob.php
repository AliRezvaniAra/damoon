<?php
namespace App\Jobs;

use App\Models\Booking;
use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use PHPMailer\PHPMailer\PHPMailer;

class BookingEmailJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels,Dispatchable;

    public Booking $reservationModel;
    public Hotel $hotel;
    public Room $room;

    public function __construct(Booking $reservation)
    {
        $this->reservationModel = $reservation;
        $this->room = Room::find($reservation->room_id);
        $this->hotel = Hotel::find($this->room->hotel_id);


    }

    public function handle(): void
    {
//        dd([$this->reservationModel,$this->room,$this->hotel]);
        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';
        $mail->isSMTP();
        $mail->Host = env("MAIL_HOST");
        $mail->SMTPAuth = true;
        $mail->Username = env("MAIL_USERNAME");
        $mail->Password = env("MAIL_PASSWORD");
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = env("MAIL_PORT");
        $mail->setFrom(env("MAIL_USERNAME"), "Damoon Travel");
        $mail->addReplyTo($this->reservationModel->user_email);
        $mail->addAddress($this->reservationModel->user_email, mb_encode_mimeheader($this->reservationModel->user_name));
        $mail->isHTML(true);
        $mail->Subject = 'Book Info';
        $mail->Body = view("mail.bookInfo")->with("book", $this->reservationModel)->with("room", $this->room)->with("hotel", $this->hotel);
        $mail->AltBody = "successfully booked";
        $mail->send();
    }
}
