<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Parking;
use Carbon\CarbonPeriod;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use App\Http\Requests\SpotRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\SpotResource;
use App\Http\Resources\SpotResourceCollection;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Resources\ParkingResourceCollection;


class SpotController extends Controller
{
    use ApiResponses;
    
    /**
     * Get all the spots available on the specific range
     *
     * @urlParam start required Example: 2022-12-01T00:00:00.000Z
     * @urlParam end required Example: 2022-12-02T00:00:00.000Z
     * @return \Illuminate\Http\Response
     */
    public function index(SpotRequest $request,Parking $parking)
    {
        //dd($request->all());
       return $this->success(new SpotResourceCollection(
                                $parking
                                ->spots()
                                ->filter($request->only('start','end'))
                                ->get()
                                ),
                            "Parking Spots");
    }

    /**
     * Get all the spots for a specific day
     *
     * @urlParam start required Example: 2022-12-01T00:00:00.000Z
     * @urlParam end required Example: 2022-12-02T00:00:00.000Z
     * @return \Illuminate\Http\Response
     */
    public function days(Request $request)
    {

        $period = CarbonPeriod::create($request->get('start'), $request->get('end'));

        foreach ($period as $date) {

            $range[$date->format('Y-m-d')] = $this->spots($date->format('Y-m-d'));
        }
    
        return $this->success($range, 'Number of spots per day');
    }

    private function spots($day)
    {
        $spot = new ParkingResourceCollection(
            Parking::withCount([
                'spots as free_spots' => function(Builder $query) use ($day){
                    $query->whereDoesntHave('reservations', function(Builder $query) use ($day) {
                        $query->whereRaw("? BETWEEN start AND end", [$day]);
                    });
        }
        ])->get());
   
        return $spot;
    }
}
