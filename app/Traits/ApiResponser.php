<?php

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;

trait ApiResponser
{
    private function successResponse($data, $code)
    {
        return response()->json($data, $code);
    }

    protected function errorResponse($message, $code)
    {
        return response()->json(['error' => $message, 'code' => $code], $code);
    }

    protected function showAll(Collection $collection, $code = 200)
    {
        if ($collection->isEmpty()) {
            return $this->successResponse(['data' => $collection], $code);
        }
        $transformer = $collection->first()->transformer;

        $collection = $this->filterData($collection, $transformer);
        $collection = $this->sortData($collection, $transformer);
        $collection = $this->paginateData($collection);

        $collection = $this->transformData($collection, $transformer);
        return $this->successResponse($collection, $code);
    }

    protected function showOne(Model $model, $code = 200)
    {
        $transformer = $model->transformer;

        $model = $this->transformData($model, $transformer);

        return $this->successResponse($model, $code);
    }

    protected function transformData($data, $transformer)
    {
        $transformation = fractal($data, new $transformer);
        return $transformation->toArray();
    }

    protected function sortData(Collection $collection, $transformer)
    {
        // evaluate sort order
        $sort_order = request()->has('sort_order') ? request()->sort_order : 'asc';

        // sort data
        if (request()->has('sort_by')) {
            $attribute = $transformer::originalAttribute(request()->sort_by);
            if ($sort_order === 'desc') {
                $collection = $collection->sortByDesc->{$attribute};
            } else {
                $collection = $collection->sortBy->{$attribute};
            }
        }
        return $collection;
    }

    protected function filterData(Collection $collection, $transformer)
    {
        foreach (request()->query as $query => $value) {
            $attribute = $transformer::originalAttribute($query);

            if (isset($attribute, $value)) {
                $collection = $collection->where($attribute, $value);
            }
        }

        return $collection;
    }

    protected function paginateData(Collection $collection)
    {
        Validator::validate(request()->all(), [
            'per_page' => 'integer|min:2|max:50',
        ]);

        $page = LengthAwarePaginator::resolveCurrentPage();

        $perPage = request()->has('per_page') ? (int) request()->per_page : 15;

        $results = $collection->slice(($page -1) * $perPage, $perPage)->values();

        $paginated = new LengthAwarePaginator($results, $collection->count(), $perPage, $page, [
            'path' => LengthAwarePaginator::resolveCurrentPath()
        ]);

        $paginated->appends(request()->all());

        return $paginated;
    }
}
