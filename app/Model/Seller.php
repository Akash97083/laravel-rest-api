<?php

namespace App\Model;

use App\Transformers\SellerTransformer;
use Illuminate\Database\Eloquent\Builder;

/**
 * @method static has(string $string)
 * @property mixed products
 */
class Seller extends User
{
    public $transformer = SellerTransformer::class;

    protected static function booted()
    {
        // static::addGlobalScope(new SellerScope);

        static::addGlobalScope('seller', function (Builder $builder) {
            $builder->has('products');
        });
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
