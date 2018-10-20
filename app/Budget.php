<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    protected $fillable = [
        'name',
        'user_id',
    ];

    protected $hidden = [
        'user_id'
    ];

    /**
     * Get the accounts for the budget.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function accounts()
    {
        return $this->hasMany(Account::class);
    }

    /**
     * Get the category groups for the budget.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categoryGroups()
    {
        return $this->hasMany(CategoryGroup::class);
    }

    /**
     * Get the payees for the budget.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payees()
    {
        return $this->hasMany(Payee::class);
    }

    /**
     * Get the repeat types for the budget.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function repeatTypes()
    {
        return $this->hasMany(RepeatType::class);
    }

    /**
     * Get the user that owns this Budget
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
