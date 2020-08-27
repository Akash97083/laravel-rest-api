<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Model\Product;

class ProductTransactionController extends ApiController
{
    public function index(Product $product)
    {
        $transactions = $product->transactions;
        return $this->successResponse(['transactions' => $transactions], 200);
    }
}
