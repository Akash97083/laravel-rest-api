<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed product
 * @property mixed id
 * @property mixed quantity
 * @property mixed buyer_id
 * @property mixed product_id
 * @property mixed created_at
 * @property mixed updated_at
 * @method static create(array $array)
 */
class Transaction extends Model
{
    protected $fillable = [
        'quantity', 'buyer_id', 'product_id'
    ];

    public function buyer()
    {
        return $this->belongsTo(Buyer::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
