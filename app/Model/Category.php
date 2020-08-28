<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $request_data)
 * @property mixed products
 * @property mixed id
 */
class Category extends Model
{
    protected $fillable = ['name', 'description'];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
