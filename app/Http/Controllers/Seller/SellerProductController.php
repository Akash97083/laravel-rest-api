<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Seller;
use Illuminate\Http\Request;

class SellerProductController extends ApiController
{
    public function index(Seller $seller)
    {
        $products = $seller->products;
        return $this->successResponse(['products' => $products], 200);
    }
}
