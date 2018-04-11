<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    //
    public function client()
    {
        return $this->belongsTo('App\Client', 'client_id', 'id'); // belongsTo('model', 'Fk', 'localKey's)
    }

    public function room()
    {
        return $this->belongsTo('App\Room', 'room_id', 'id');
    }
}
