<?php


namespace App\Http\Transformers;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class ParentTransformer
{
    public function transformDetailsMany(Collection $collection)
    {
        return $collection->map(function ($item) {
            return $this->transformDetails($item);
        })->toArray();
    }

    public abstract function transformDetails(Model $model);

    public function transformGeneralMany(Collection $collection)
    {
        return $collection->map(function ($item) {
            return $this->transformGeneral($item);
        })->toArray();
    }

    public abstract function transformGeneral(Model $model);

    public function transformLightMany(Collection $collection)
    {
        return $collection->map(function ($item) {
            return $this->transformLight($item);
        })->toArray();
    }

    public abstract function transformLight(Model $model);
}
