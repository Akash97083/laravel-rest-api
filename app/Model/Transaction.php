<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed product
 */
class Transaction extends Model
{
    protected $fillable = [
        'quantity', 'buyer_id', 'product_id'
    ];

    public function buyer() {
        return $this->belongsTo(Buyer::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
