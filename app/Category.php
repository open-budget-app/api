<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
    ];

    /**
     * Get the category group that this category belongs to
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categoryGroup()
    {
        return $this->belongsTo(CategoryGroup::class);
    }
}
