<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RepeatType extends Model
{
    /**
     * Get the budget that belongs to this repeat type.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function budget()
    {
        return $this->belongsTo(Budget::class);
    }
}
