<?php

namespace App\Model;

/**
 * @method static has(string $string)
 */
class Buyer extends User
{
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
