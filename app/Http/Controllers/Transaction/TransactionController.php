<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\ApiController;
use App\Model\Transaction;
use Illuminate\Http\Request;

class TransactionController extends ApiController
{
    public function index()
    {
        $transactions = Transaction::all();
        return $this->successResponse(['transactions' => $transactions], 200);
    }

    public function show(Transaction $transaction)
    {
        return $this->successResponse(['transaction' => $transaction], 200);
    }
}
