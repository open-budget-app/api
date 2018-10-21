<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payee extends Model
{
    protected $guarded = ['id'];

    /**
     * Get the budget that belongs to this payee
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function budget()
    {
        return $this->belongsTo(Budget::class);
    }
}
