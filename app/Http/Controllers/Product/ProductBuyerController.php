<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\HelperController;
use App\Model\Product;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductBuyerController extends ApiController
{
    public function index(Product $product)
    {
        $buyers = $product->transactions()
            ->with('buyer')
            ->get()
            ->pluck('buyer')
            ->unique('id')
            ->values();

        return HelperController::pagination($buyers);

        //return $this->successResponse(['buyers' => $buyers], 200);
    }
}
