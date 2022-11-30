<?php

namespace App\Http\Controllers\Api;

use App\Models\Price;
use App\Models\Parking;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Resources\ParkingResourceCollection;


class ParkingController extends Controller
{
    use ApiResponses;

    /**
     * Get all the info for a specific parking
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->success( 
            new ParkingResourceCollection(
                    Parking::withCount([
                        'spots as free_spots' => function(Builder $query){
                            $query->whereDoesntHave('reservations', function(Builder $query) {
                                $query->whereRaw("? BETWEEN start AND end", [now()]);
                            });
                }
            ])->get()),
            "Parking Info" );
    }


}
