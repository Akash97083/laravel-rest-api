<?php

namespace App\Model;

use App\Scopes\BuyerScope;
use Illuminate\Database\Eloquent\Builder;

/**
 * @method static has(string $string)
 */
class Buyer extends User
{
    protected static function booted()
    {
        // static::addGlobalScope(new BuyerScope);

        static::addGlobalScope('buyer', function (Builder $builder) {
            $builder->has('transactions');
        });
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
