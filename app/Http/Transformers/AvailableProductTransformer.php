<?php


namespace App\Http\Transformers;


use Illuminate\Database\Eloquent\Model;

class AvailableProductTransformer extends ParentTransformer
{

    public function transformDetails(Model $model)
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
            'category' => (new CategoryTransformer)->transformLight($model->category),
            'image' => $model->image,
            'expire_date' => $model->expire_date,
            'contact_info' => $model->contact_info,
            'quantity' => $model->quantity,
            'price' => $model->price,
            'unit' => $model->unit,
            'like_count' => $model->like_count,
            'view_count' => $model->view_count
        ];
    }

    public function transformGeneral(Model $model)
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
            'image' => $model->image,
            'price' => $model->price,
            'unit' => $model->unit,
            'view_count' => $model->view_count,
            'like_count' => $model->like_count

        ];
    }

    public function transformLight(Model $model)
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
            'price' => $model->price,
            'unit' => $model->unit
        ];
    }
}
