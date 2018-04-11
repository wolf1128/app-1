<?php

namespace App\Http\Controllers;
use App\Client as Client;   // Note: our imports must be after the namespace
use App\Room as Room;
use App\Reservation as Reservation;

use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    //
    public function bookRoom($client_id, $room_id, $date_in, $date_out)
    {
        $reservation = new Reservation();   // Create instance from models
        $client_instance = new Client();
        $room_instance = new Room();

        $client = $client_instance->find($client_id);
        $room = $room_instance->find($room_id);
        $reservation->date_in = $date_in;
        $reservation->date_out = $date_out;

        //magic part! We need to tell the reservation to associate the room and the client
        $reservation->room()->associate($room); // -?- room()
        $reservation->client()->associate($client); // -?- client()
        if( $room_instance->isRoomBooked( $room_id, $date_in, $date_out ) ) // controll concurrent processing .
        {
            abort(405, 'Trying to book an already booked room.');// Send a ERROR with a message .
        }
        $reservation->save();


        return redirect()->route('clients'); // redirect to index VIEW
        // return view('reservations/bookRoom');
    }
}
