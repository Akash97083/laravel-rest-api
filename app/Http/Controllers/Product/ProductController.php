<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Model\Product;
use Illuminate\Http\Request;

class ProductController extends ApiController
{
    public function index()
    {
        $products = Product::all();
        return $this->successResponse(['products' => $products], 200);
    }

    public function show(Product $product)
    {
        return $this->successResponse(['product' => $product], 200);
    }
}
