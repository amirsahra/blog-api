<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;

trait Searchable
{

    /**
     * @param Model $model
     * @param array $likeFields Values that must be exactly like to it in the table
     * @param array $equalFields Values that must be exactly equal to it in the table
     * @return array|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    protected function multiSearch(Model $model, array $likeFields, array $equalFields = [])
    {
        $queryResult = $model->query();
        foreach ($likeFields as $key => $value) {
            $queryResult = $queryResult->whereLike("$key", "$value");
        }

        foreach ($equalFields as $key => $value) {
            $queryResult = $queryResult->whereIn("$key", [$value]);
        }

        return $queryResult->get() ?? [];
    }

}
