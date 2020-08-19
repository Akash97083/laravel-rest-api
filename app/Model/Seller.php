<?php

namespace App\Model;

class Seller extends User
{
    public function products() {
        return $this->hasMany(Product::class);
    }
}
