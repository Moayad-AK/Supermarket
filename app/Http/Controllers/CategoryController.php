<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CategoryDeleteRequest;
use App\Http\Requests\Category\CategoryIndexRequest;
use App\Http\Requests\Category\CategoryShowRequest;
use App\Http\Requests\Category\CategoryStoreRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Http\Transformers\CategoryTransformer;
use App\Models\Category;

class CategoryController extends ParentController
{
    public function __construct()
    {
        parent::__construct(Category::class, new CategoryTransformer, 'categories');
    }

    public function index(CategoryIndexRequest $request)
    {
        return parent::parentIndex($request);
    }

    public function store(CategoryStoreRequest $request)
    {
        return parent::parentStore($request);
    }

    public function update(CategoryUpdateRequest $request, $id)
    {
        return parent::parentUpdate($request, $id);
    }

    public function show(CategoryShowRequest $request, $id)
    {
        return parent::parentShow($request, $id);
    }

    public function destroy(CategoryDeleteRequest $request, $id)
    {
        return parent::parentDestroy($request, $id);
    }

    public function search($products, $params)
    {
        if (array_key_exists('name', $params))
            $products = $products->where('name', 'like', '%'.$params.'%');

        return $products;
    }
}
