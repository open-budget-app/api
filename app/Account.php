<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = ['name'];

    /**
     * Get the budget that has this account.
     */
    public function budget()
    {
        return $this->belongsTo('App\Budget');
    }

}
