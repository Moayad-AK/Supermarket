<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

abstract class ParentController extends Controller
{
    protected $model;
    protected $table;
    protected $transformer;

    public function __construct($model, $transformer, $table)
    {
        $this->model = $model;
        $this->transformer = $transformer;
        $this->table = $table;
    }

    public abstract function search($products, $params);

    public function parentIndex(Request $request)
    {
        $products = $this->query();

        $products = $this->search($products, $request->all());
        $products = $this->sort($products, $request->all());

        $products = $products->get();
        return $this->transformer->transformGeneralMany($products);
    }

    public function query()
    {
        return ($this->model)::query();
    }

    public function parentStore(Request $request)
    {
        $product = new $this->model($request->all());
        $product->save();
        return $this->transformer->transformDetails($product);
    }

    public function parentUpdate(Request $request, $id)
    {
        $product = $this->query()->find($id);
        if (empty($product))
            return Response()->json(['massage' => 'Not found'], 404);

        $product->update($request->all());
        $updated = $this->query()->find($product->id);
        return $this->transformer->transformDetails($updated);
    }

    public function parentShow(Request $request, $id)
    {
        $product = $this->query()->find($id);
        if (empty($product))
            return Response()->json(['massage' => 'Not found'], 404);

        return $this->transformer->transformDetails($product);

    }

    public function parentDestroy(Request $request, $id)
    {
        $product = $this->query()->find($id);
        if (empty($product))
            return Response()->json(['massage' => 'Not found'], 404);

        $beforeDelete = $product;
        $product->delete();
        return $this->transformer->transformDetails($beforeDelete);


    }

    public function sort($products, $params)
    {
        if (array_key_exists('field', $params))
            if (Schema::hasColumn($this->table, $params['field'])) {
                $products = $products->orderBy($params['field']);
            }


        return $products;
    }
}
