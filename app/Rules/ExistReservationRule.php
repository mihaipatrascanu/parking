<?php

namespace App\Rules;

use App\Models\Spot;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Carbon\Carbon;

class ExistReservationRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(public $spot_id = null)
    {

    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (!$this->spot_id) {
            return false;
        }

        return Spot::where('id', $this->spot_id)->whereHas('reservations', function (Builder $query) use ($value) {
                $query->where([
                    ['start', '<=', Carbon::parse(Arr::get($value, 'end'))],
                    ['end', '>=', Carbon::parse(Arr::get($value, 'start'))],
                ]);
            })->count() === 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Reservation for this interval is not posible';
    }
}
