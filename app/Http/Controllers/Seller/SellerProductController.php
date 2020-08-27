<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Product;
use App\Model\Seller;
use App\Model\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

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
            'image' => 'image'
        ]);

        $data = $request->only(['name', 'description', 'quantity', 'image']);

        $data['status'] = Product::UNAVAILABLE_PRODUCT;
        $data['image'] = '1.jpg';
        $data['seller_id'] = $seller->id;

        $product = Product::create($data);

        return $this->successResponse(['product' => $product], 200);
    }

    public function update(Request $request, Seller $seller, Product $product)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'quantity' => 'required|min:1',
            'status' => 'in:' . Product::AVAILABLE_PRODUCT . ',' . Product::UNAVAILABLE_PRODUCT,
            'image' => 'image'
        ]);

        $this->checkSeller($seller, $product);

        $product->fill($request->only(['name', 'description', 'quantity']));

        if ($request->has('status')) {
            $product->status = $request->status;

            if ($product->isAvailable() && $product->categories()->count() === 0) {
                return $this->errorResponse('An active product must have at least one category', 409);
            }
        }

        if ($product->isClean()) {
            return $this->errorResponse('You need to specify a different value to update', 422);
        }

        $product->save();

        return $this->successResponse(['product' => $product], 200);
    }

    public function destroy(Seller $seller, Product $product)
    {
        $this->checkSeller($seller, $product);
        $product->delete();

        return $this->successResponse(['product' => $product], 200);
    }

    public function checkSeller($seller, $product)
    {
        if ($seller->id !== $product->seller_id) {
            throw new HttpException(422, 'The specified seller is not the actual seller of the product');
        }
    }
}
