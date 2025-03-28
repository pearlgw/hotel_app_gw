<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Facility extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    /**
     * Get the bedroom that owns the Facility
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bedroom(): BelongsTo
    {
        return $this->belongsTo(Bedroom::class, 'bedrooms_id');
    }
}
