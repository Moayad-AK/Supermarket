<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\ProductDeleteRequest;
use App\Http\Requests\Product\ProductIndexRequest;
use App\Http\Requests\Product\ProductShowRequest;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Http\Transformers\ProductTransformer;
use App\Models\Product;

class ProductController extends ParentController
{
    public function __construct()
    {
        parent::__construct(Product::class, new ProductTransformer, 'products');
    }

    public function index(ProductIndexRequest $request)
    {
        return parent::parentIndex($request);
    }

    public function store(ProductStoreRequest $request)
    {
        return parent::parentStore($request);
    }

    public function update(ProductUpdateRequest $request, $id)
    {
        return parent::parentUpdate($request, $id);
    }

    public function show(ProductShowRequest $request, $id)
    {
        return parent::parentShow($request, $id);
    }

    public function destroy(ProductDeleteRequest $request, $id)
    {
        return parent::parentDestroy($request, $id);
    }

    public function search($products, $params)
    {
        if (array_key_exists('name', $params))
            $products = $products->where('name', 'like', '%' . $params['name'] . '%');
        if (array_key_exists('category_id', $params))
            $products = $products->where('category_id', $params['category_id']);

        return $products;
    }
}
