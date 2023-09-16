<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::all();
        return response()->json($reservations);
    }

    public function store(ReservationRequest $reservationRequest)
    {
        $input = $reservationRequest->validated();
        $reservation = Reservation::create($input);
        return response()->json(['data' => $reservation, 'success' => 'Reservation created successfully']);
    }

    public function show($id)
    {
        $reservation = Reservation::findOrFail($id);
        return response()->json($reservation);
    }

    public function update($id, ReservationRequest $reservationRequest)
    {
        $reservation = Reservation::findOrFail($id);
        $input = $reservationRequest->validated();
        $reservation->update($input);
        return response()->json(['data'=> $reservation,'success' => 'Reservation updated successfully']);
    }

    public function destroy(Request $request)
    {
        Reservation::findOrFail($request->id);
        return response()->json('success', 'Reservation deleted successfully');
    }
}
