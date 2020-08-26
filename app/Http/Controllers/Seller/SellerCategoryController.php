<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Model\Seller;

class SellerCategoryController extends ApiController
{
    public function index(Seller $seller)
    {
        $categories = $seller->products()
            ->has('categories')
            ->with('categories')
            ->get()
            ->pluck('categories')
            ->collapse()
            ->unique('id')
            ->values();

        return $this->successResponse(['categories' => $categories], 200);
    }
}
