<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bedroom extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    /**
     * Get the category_bedroom that owns the Bedroom
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category_bedroom(): BelongsTo
    {
        return $this->belongsTo(CategoryBedroom::class, 'category_bedrooms_id');
    }

    public function facility(): HasOne
    {
        return $this->hasOne(Facility::class, 'bedrooms_id', 'id');
    }

    public function detail_transaction(): HasOne
    {
        return $this->hasOne(DetailTransaction::class, 'bedrooms_id', 'id');
    }

    public function detail_reservation(): HasOne
    {
        return $this->hasOne(DetailReservation::class, 'bedrooms_id', 'id');
    }

    public function image_bedroom(): HasMany
    {
        return $this->hasMany(ImageBedroom::class, 'bedrooms_id', 'id');
    }
}
