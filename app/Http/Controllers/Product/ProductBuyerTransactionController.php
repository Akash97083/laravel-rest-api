<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Model\Product;
use App\Model\Transaction;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductBuyerTransactionController extends ApiController
{
    public function store(Request $request, Product $product, User $buyer)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        if ($buyer->id === $product->seller_id) {
            return $this->errorMessage('The buyer must be different from the seller', 409);
        }

        if (!$buyer->isVerified()) {
            return $this->errorMessage('The buyer must be a verified user', 409);
        }

        if (!$product->seller->isVerified()) {
            return $this->errorMessage('The seller must be a verified user', 409);
        }

        if (!$product->isAvailable()) {
            return $this->errorMessage('The product is not available', 409);
        }

        if ($product->quantity < $request->quantity) {
            return $this->errorMessage('The product does not have enough units for this transaction', 409);
        }

        // DB::transaction feature
        // if transaction save error for any reason, the stored product table reverse the previous data
        // this means if any operation/transaction will be fail, all the stored data will be reverse for this transaction
        return DB::transaction(function () use ($request, $product, $buyer) {
            $product->quantity -= $request->quantity;
            $product->save();

           $transaction = Transaction::create([
               'quantity' => $request->quantity,
               'buyer_id' => $buyer->id,
               'product_id' => $product->id
           ]);

           return $this->successResponse(['transaction' => $transaction], 200);
        });
    }
}
