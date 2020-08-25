<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\ApiController;
use App\Model\Transaction;

class TransactionCategoryController extends ApiController
{
    public function index(Transaction $transaction)
    {
        $categories = $transaction->product->categories;
        return $this->successResponse(['categories' => $categories], 200);
    }
}
