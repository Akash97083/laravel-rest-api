<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed|string status
 * @property mixed transactions
 * @method static create(array $data)
 */
class Product extends Model
{
    const AVAILABLE_PRODUCT = 'available';
    const UNAVAILABLE_PRODUCT = 'unavailable';

    protected $fillable = [
        'name', 'description', 'quantity', 'status', 'image', 'seller_id'
    ];

    protected $hidden = ['pivot'];

    public function isAvailable()
    {
        return $this->status === Product::AVAILABLE_PRODUCT;
    }

    public function seller() {
        return $this->belongsTo(Seller::class);
    }

    public function categories() {
        return $this->belongsToMany(Category::class);
    }

    public function transactions() {
        return $this->hasMany(Transaction::class);
    }
}
