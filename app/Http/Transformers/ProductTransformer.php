<?php


namespace App\Http\Transformers;


use Illuminate\Database\Eloquent\Model;

class ProductTransformer extends ParentTransformer
{
    public function transformDetails(Model $model)
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
//            'category' => (new CategoryTransformer)->transformLight($model->category),
//            'available_products' => (new AvailableProductTransformer)->transformGeneralMany($model->availableProducts),
        ];
    }

    public function transformGeneral(Model $model)
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
//            'category' => (new CategoryTransformer)->transformLight($model->category),
        ];
    }

    public function transformLight(Model $model)
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
        ];
    }
}
