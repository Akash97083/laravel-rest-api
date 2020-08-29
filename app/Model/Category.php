<?php

namespace App\Model;

use App\Transformers\CategoryTransformer;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $request_data)
 * @property mixed products
 * @property mixed id
 * @property mixed name
 * @property mixed created_at
 * @property mixed updated_at
 * @property mixed description
 */
class Category extends Model
{
    public $transformer = CategoryTransformer::class;

    protected $fillable = ['name', 'description'];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
