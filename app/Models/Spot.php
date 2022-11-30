<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class Spot extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function parking()
    {
        return $this->belongsTo(Parking::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function scopeFilter(Builder $query, array $filters)
    {
        return $query->whereDoesntHave('reservations', function (Builder $query) use ($filters) {
            $query->where([
                ['start', '<=', Carbon::parse(Arr::get($filters, 'end'))],
                ['end', '>=', Carbon::parse(Arr::get($filters, 'start'))],
            ]);
        });
    }
}
