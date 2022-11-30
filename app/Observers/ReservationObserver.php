<?php

namespace App\Observers;

use App\Models\Reservation;
use Illuminate\Support\Str;

class ReservationObserver
{
    
    public function creating(Reservation $reservation)
    {
        
        Reservation::query()
                ->whereNull('status')
                ->where('user_id', $reservation->user_id)
                ->delete();
        
        // $reservation->uuid = Str::uuid();

    }
    
}
