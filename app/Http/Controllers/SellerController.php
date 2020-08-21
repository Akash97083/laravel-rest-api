<?php

namespace App\Http\Controllers;

use App\Model\Seller;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function index()
    {
        $sellers = Seller::has('products')->get();
        return response()->json(['data' => $sellers], 200);
    }

    public function show(Seller $seller)
    {
        return response()->json(['data' => $seller], 200);
    }
}
