<?php

namespace App\Http\Controllers;

use App\Http\Requests\AvailableProduct\AvailableProductDeleteRequest;
use App\Http\Requests\AvailableProduct\AvailableProductIndexRequest;
use App\Http\Requests\AvailableProduct\AvailableProductShowRequest;
use App\Http\Requests\AvailableProduct\AvailableProductStoreRequest;
use App\Http\Requests\AvailableProduct\AvailableProductUpdateRequest;
use App\Http\Transformers\AvailableProductTransformer;
use App\Models\AvailableProduct;
use Illuminate\Http\Request;

class AvailableProductController extends ParentController
{
    public function __construct()
    {
        parent::__construct(AvailableProduct::class, new AvailableProductTransformer, 'available_products');
    }

    public function index(AvailableProductIndexRequest $request)
    {
        return parent::parentIndex($request);
    }

    public function store(AvailableProductStoreRequest $request)
    {
        if (!auth('sanctum')->check()) {return 'unauthenticated';}
        $product = new $this->model($request->all());
        $expire_date = $request->input('expire_date');
        $auth = auth('sanctum')->user();
        $product->user_id = $auth->id;
        $product->expire_date = $expire_date;
        $product->save();

        return $this->transformer->transformDetails($product);
    }

    public function update(AvailableProductUpdateRequest $request, $id)
    {
        return parent::parentUpdate($request, $id);
    }

    public function show(AvailableProductShowRequest $request, $id)
    {
        $product = $this->query()->find($id);
        if (empty($product))
            return Response()->json(['massage' => 'Not found'], 404);

        $product->view_count += 1;
        $product->save();

        return $this->transformer->transformDetails($product);
    }

    public function destroy(AvailableProductDeleteRequest $request, $id)
    {
        return parent::parentDestroy($request, $id);
    }

    public function search($products, $params)
    {
        if (array_key_exists('expire_date', $params))
            $products = $products->whereDate('expire_date', 'like', '%' . $params['expire_date'] . '%');
        if (array_key_exists('name', $params))
            $products = $products->where('name', 'like', '%' . $params['name'] . '%');
        if (array_key_exists('category_id', $params))
            $products = $products->where('category_id', $params['category_id']);


        return $products;
    }

    public function like(Request $request)
    {
        $validatedData = $request->validate([
            'id' => ['required','integer' , 'exists:available_products,id'],

        ]);
        $id = $request->input('id');
        $product = AvailableProduct::query()->find($id);
        $product->like_count += 1;
        $product->save();

        return $this->transformer->transformDetails($product);


    }
}
