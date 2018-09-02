<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryGroup extends Model
{
    /**
     * Get all the categories of a category group
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
