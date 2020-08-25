<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\ApiController;
use App\Model\Buyer;

class BuyerTransactionsController extends ApiController
{
    public function index(Buyer $buyer)
    {
        $transactions = $buyer->transactions;
        return $this->successResponse(['transactions' => $transactions], 200);
    }
}
