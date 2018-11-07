<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryBudget extends Model
{
    protected $guarded = ['id'];

    /**
     * Get the category that this category budget belongs to
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
