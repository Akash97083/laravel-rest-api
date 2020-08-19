<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed|string status
 */
class Product extends Model
{
    const AVAILABLE_PRODUCT = 'available';
    const UNAVAILABLE_PRODUCT = 'unavailable';

    protected $fillable = [
        'name',
        'description',
        'quantity',
        'status',
        'image',
        'seller_id'
    ];

    public function isAvailable()
    {
        return $this->status === Product::AVAILABLE_PRODUCT;
    }
}
