<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\ApiController;
use App\Model\Buyer;

class BuyerSellerController extends ApiController
{
    public function index(Buyer $buyer)
    {
        $sellers = $buyer->transactions()->with('product.seller')
            ->get()
            ->pluck('product.seller')
            ->unique('id') // remove duplicate user but keep empty object {}
            ->values(); // remove empty object and recreate index

        return $this->successResponse(['sellers' => $sellers], 200);
    }
}
