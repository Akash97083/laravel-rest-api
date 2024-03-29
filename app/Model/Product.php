<?php

namespace App\Model;

use App\Transformers\ProductTransformer;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed|string status
 * @property mixed transactions
 * @property mixed categories
 * @property mixed seller_id
 * @property mixed seller
 * @property mixed quantity
 * @property mixed image
 * @property mixed description
 * @property mixed id
 * @property mixed name
 * @property mixed created_at
 * @property mixed updated_at
 * @method static create(array $data)
 */
class Product extends Model
{
    public $transformer = ProductTransformer::class;

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

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
