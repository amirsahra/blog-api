<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;

trait Searchable
{
    protected function multiSearch(Model $model, array $items)
    {
        $enumItems = ['gender', 'status', 'type'];
        $queryResult = $model->query();
        foreach ($items as $key => $value) {
            if (in_array($key, $enumItems))
                $queryResult = $queryResult->whereIn("$key", [$value]);
            else
                $queryResult = $queryResult->whereLike("$key", "$value");
        }
        return $queryResult->get() ?? [];
    }

}
