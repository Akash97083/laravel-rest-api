<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Product;
use App\Model\Seller;
use App\Model\User;
use Illuminate\Http\Request;

class SellerProductController extends ApiController
{
    public function index(Seller $seller)
    {
        $products = $seller->products;
        return $this->successResponse(['products' => $products], 200);
    }

    public function store(Request $request, User $seller)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'quantity' => 'required|min:1',
            'image' => 'required|image'
        ]);

        $data = $request->only(['name', 'description', 'quantity', 'image']);

        $data['status'] = Product::UNAVAILABLE_PRODUCT;
        $data['image'] = '1.jpg';
        $data['seller_id'] = $seller->id;

        $product = Product::create($data);

        return $this->successResponse(['product' => $product], 200);
    }
}
