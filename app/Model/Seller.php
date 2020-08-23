<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Builder;

/**
 * @method static has(string $string)
 */
class Seller extends User
{
    protected static function booted()
    {
        // static::addGlobalScope(new SellerScope);

        static::addGlobalScope('seller', function (Builder $builder) {
            $builder->has('products');
        });
    }

    public function products() {
        return $this->hasMany(Product::class);
    }
}
