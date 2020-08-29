<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HelperController;
use App\Model\Category;
use App\Model\Seller;
use Illuminate\Http\Request;

class SellerBuyerController extends ApiController
{
    public function index(Seller $seller)
    {
        $buyers = $seller->products()
            ->has('transactions')
            ->with('transactions.buyer')
            ->get()
            ->pluck('transactions')
            ->collapse()
            ->pluck('buyer')
            ->unique('id')
            ->values();

        return HelperController::pagination($buyers);
        return $this->successResponse(['buyers' => $buyers], 200);
    }
}
