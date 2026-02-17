<?php

namespace App\Http\Controllers;

use App\Application\Services\BookingService;
use App\utilities\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class BookController extends Controller
{
    public function store(Request $request, BookingService $service): JsonResponse
    {
        $data = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'user_name' => 'required',
            'user_email' => 'required',
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after_or_equal:check_in_date',
        ]);

        $booking = $service->reserve(
            $data["room_id"],
            $data["user_name"],
            $data["user_email"],
            $data["check_in_date"],
            $data["check_out_date"],
        );
        //@todo payment logics should add here (using payment repository should be here) + final reserve email
        return Response::json([
            'message' => 'Booked',
            'booking' => $booking
        ]);
    }
}
