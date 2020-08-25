<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\ApiController;
use App\Model\Buyer;

class BuyerTransactionController extends ApiController
{
    public function index(Buyer $buyer)
    {
        $transactions = $buyer->transactions;
        return $this->successResponse(['transactions' => $transactions], 200);
    }
}
