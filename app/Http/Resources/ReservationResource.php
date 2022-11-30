<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'           => $this->id,
            'spot_id'      => (int)$this->spot_id,
            'start'        => $this->start->toDateTimeString(),
            'end'          => $this->end->toDateTimeString(),
            'created_at'   => $this->created_at->toDateTimeString()
        ];
    }
}
