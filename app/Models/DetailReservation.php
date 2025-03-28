<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailReservation extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    /**
     * Get the user that owns the DetailReservation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reservation(): BelongsTo
    {
        return $this->belongsTo(Reservation::class, 'reservations_id');
    }

    public function bedroom(): BelongsTo
    {
        return $this->belongsTo(Bedroom::class, 'bedrooms_id');
    }
}
