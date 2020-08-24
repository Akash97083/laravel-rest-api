<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Model\Category;
use Illuminate\Http\Request;
use function GuzzleHttp\Promise\all;

class CategoryController extends ApiController
{
    public function index()
    {
        $categories = Category::all();
        return $this->successResponse(['categories' => $categories], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required'
        ]);

        $request_data = $request->only(['name', 'description']);

        $category = Category::create($request_data);

        return $this->successResponse(['category' => $category], 201);
    }

    public function show(Category $category)
    {
        return $this->successResponse(['category' => $category], 200);
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required'
        ]);

        $category->fill($request->only([
            'name',
            'description'
        ]));

        if ($category->isClean()) {
            return $this->errorResponse('You need to specify different value to update', 422);
        }

        $category->save();

        return $this->successResponse(['category' => $category], 201);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return $this->successResponse(['category' => $category], 201);
    }
}
