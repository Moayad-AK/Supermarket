<?php


namespace App\Http\Transformers;


use Illuminate\Database\Eloquent\Model;

class CategoryTransformer extends ParentTransformer
{

    public function transformDetails(Model $model)
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
        ];
    }

    public function transformGeneral(Model $model)
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
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
