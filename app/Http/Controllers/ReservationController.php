<?php

namespace App\Http\Controllers;

use App\Reservation;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         $reservations = Reservation::all();

        return response()->json($reservations);
        
    }

    public function showByUser(Request $request)
    {
        // $reservations = $request->user()->reservations;

        // return response()->json($reservations);
        return $request->user()->reservations;
    }

    public function showByReservation($orderID)
    {   
        $reservation = Reservation::where("order_id","=", $orderID)->firstOrFail();

        return response()->json($reservation);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'start_address' => ['required', 'max:255'],
            'end_address' => ['required', 'max:255'],
            'start_address_geo' => ['required', 'max:255'],
            'end_address_geo' => ['required', 'max:255'],
            'amount_of_people' => ['required', 'max:255'],
            'pickup_date' => ['required'],
            'fare_price' => ['required'],
            'distance' => ['required'],
            'travel_time' => ['required'],
            'map_url' => ['required'],
            'payment_id' => [],
            'order_id' => [],
            'status' => [],
            'refundIsAsked' => [],
            'orderIsComplete' => [],
            'user_id' => ['required', 'integer']
        ]);

        $reservation = Reservation::create($request->all());

        $user = User::find(Auth::user()->id);

        $user->sendReservationConfirmation($reservation,$user->name);

    
        
        // sendReservationConfirmation()
        return response()->json($reservation, 201);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        return response()->json($reservation);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'start_address' => ['required', 'max:255'],
            'end_address' => ['required', 'max:255'],
            'start_address_geo' => ['required', 'max:255'],
            'end_address_geo' => ['required', 'max:255'],
            'amount_of_people' => ['required', 'max:255'],
            'pickup_date' => ['required'],
            'fare_price' => ['required'],
            'distance' => ['required'],
            'travel_time' => ['required'],
            'map_url' => ['required'],
            'payment_id' => [],
            'order_id' => [],
            'status' => [],
            'refundIsAsked' => [],
            'orderIsComplete' => [],
            'user_id' => ['required', 'integer']
        ]);
        
        $reservation = Reservation::findOrFail($id);
        $reservation->update($request->all());

        return response()->json($reservation, 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
