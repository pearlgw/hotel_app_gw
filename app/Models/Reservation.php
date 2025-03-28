<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    /**
     * Get the user that owns the Reservation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(User::class, 'order_id');
    }

    /**
     * Get all of the detail_transaction for the Reservation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detail_reservation(): HasMany
    {
        return $this->hasMany(DetailReservation::class, 'reservations_id', 'id');
    }
}
