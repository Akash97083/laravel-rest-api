<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Model\Category;
use App\Model\Product;

class ProductCategoryController extends ApiController
{
    public function index(Product $product)
    {
        $categories = $product->categories;
        return $this->successResponse(['categories' => $categories], 200);
    }

    public function update(Product $product, Category $category)
    {
        $product->categories()->syncWithoutDetaching([$category->id]);
        return $this->successResponse(['categories' => $product->categories], 200);
    }

    public function destroy(Product $product, Category $category)
    {
        if (!$product->categories()->find($category->id)) {
            return $this->errorResponse('The specified category is not a category of this product', 404);
        }

        $product->categories()->detach([$category->id]);

        return $this->successResponse(['categories' => $product->categories], 200);
    }
}
