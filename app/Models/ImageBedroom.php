<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImageBedroom extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    /**
     * Get the bedroom that owns the ImageBedroom
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bedroom(): BelongsTo
    {
        return $this->belongsTo(Bedroom::class, 'bedrooms_id');
    }
}
