<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Room;

class RoomsController extends Controller
{
    //
    public function checkAvailableRooms($clinet_id, Request $request)
    {
        $dateFrom = $request->input('dateFrom'); // get dates from input form
        $dateTo = $request->input('dateTo');
        $client = new Client(); // Create instances from model
        $room = new Room();

        $data = [];
        $data['dateFrom'] = $dateFrom;
        $data['dateTo'] = $dateTo;
        $data['rooms'] = $room->getAvailableRooms($dateFrom, $dateTo);
        $data['client'] = $client->find($clinet_id);

        return view('rooms/checkAvailableRooms', $data);
    }
}
