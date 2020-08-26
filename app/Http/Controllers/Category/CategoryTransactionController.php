<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Model\Category;
use Illuminate\Http\Request;

class CategoryTransactionController extends ApiController
{
    public function index(Category $category)
    {
        $transactions = $category->products()
            ->has('transactions')
            ->with('transactions')
            ->get()
            ->pluck('transactions')
            ->collapse();

        return $this->successResponse(['transactions' => $transactions], 200);
    }
}
