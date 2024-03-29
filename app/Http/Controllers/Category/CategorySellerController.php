<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Model\Category;
use Illuminate\Http\Request;

class CategorySellerController extends ApiController
{
    public function index(Category $category)
    {
        $sellers = $category->products()
            ->with('seller')
            ->get()
            ->pluck('seller')
            ->unique('id')
            ->values();

        return $this->successResponse(['sellers' => $sellers], 200);
    }
}
