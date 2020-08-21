<?php

namespace App\Http\Controllers;

use App\Model\Buyer;
use Illuminate\Http\Request;

class BuyerController extends Controller
{
    public function index()
    {
        $buyers = Buyer::has('transactions')->get();
        return response()->json(['data' => $buyers], 200);
    }

    public function show(Buyer $buyer)
    {
        return response()->json(['data' => $buyer], 200);
    }
}
