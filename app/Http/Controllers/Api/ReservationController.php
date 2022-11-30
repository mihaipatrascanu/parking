<?php

namespace App\Http\Controllers\Api;

use App\Models\Reservation;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReservationResource;
use App\Http\Requests\ReservationStoreRequest;
use App\Http\Requests\ReservationDeleteRequest;
use App\Http\Requests\ReservationUpdateRequest;

class ReservationController extends Controller
{

    use ApiResponses;
    
    public function index(Request $request, Reservation $reservation): ReservationResource
    {
        return new ReservationResource($reservation);
    }

    /**
     * Create Reservation
     *
     * @bodyParam start string required . Example: 2022-12-04T00:00:00.000Z
     * @bodyParam end string required . Example: 2022-12-07T10:00:00.000Z
     * @bodyParam spot_id string required . Example: 3
     * @return \Illuminate\Http\Response
     */
    public function store(ReservationStoreRequest $request)
    {
        $reservation = $request->user()->reservations()->create($request->validated());
        
        return $this->success(new ReservationResource($reservation),'Reservation created');
    }

    /**
     * Update Reservation
     *
     * @bodyParam start string required . Example: 2022-12-04T00:00:00.000Z
     * @bodyParam end string required . Example: 2022-12-07T10:00:00.000Z
     * @return \Illuminate\Http\Response
     */
    public function update(ReservationUpdateRequest $request, Reservation $reservation)
    {
        
        $reservation->update($request->validated());

        return $this->success(new ReservationResource($reservation->fresh()),'Reservation updated');
    }

    /**
     * Delete Reservation
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(ReservationDeleteRequest $request, Reservation $reservation)
    {
        $reservation->delete();

        return response()->json([], 204);
    }
}
