<?php

namespace App\Model;

/**
 * @method static has(string $string)
 */
class Seller extends User
{
    public function products() {
        return $this->hasMany(Product::class);
    }
}
