<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryBedroom extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    /**
     * Get all of the bedroom for the CategoryBedroom
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bedroom(): HasMany
    {
        return $this->hasMany(Bedroom::class, 'category_bedrooms_id', 'id');
    }
}
