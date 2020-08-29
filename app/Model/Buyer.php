<?php

namespace App\Model;

use App\Scopes\BuyerScope;
use App\Transformers\BuyerTransformer;
use Illuminate\Database\Eloquent\Builder;

/**
 * @method static has(string $string)
 * @property mixed transactions
 */
class Buyer extends User
{
    public $transformer = BuyerTransformer::class;

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
