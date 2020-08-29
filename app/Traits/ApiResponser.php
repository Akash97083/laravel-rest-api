<?php

namespace App\Traits;

use Ramsey\Collection\Collection;

trait ApiResponser
{
    protected function successResponse($data, $code)
    {
        $key_name = array_key_first($data);
        $collection = array_shift($data);

        $transformer = $collection->first()->transformer;
        $collection = $this->transformData($collection, $transformer);

        $sort_data = $this->sortData(array_shift($collection));

        $data = [$key_name => $sort_data];

        $data = array_merge(['success' => true], $data);
        return response()->json($data, $code);
    }

    protected function successMessage($message, $code)
    {
        $data = ['success' => true, 'message' => $message];
        return response()->json($data, $code);
    }

    protected function errorMessage($message, $code)
    {
        $data = ['success' => false, 'message' => $message];
        return response()->json($data, $code);
    }

    protected function validationResponse($data, $code)
    {
        $data = array_merge(['success' => false], $data);
        return response()->json($data, $code);
    }

    protected function sortData($collection)
    {
        $collection = collect($collection);

        if (request()->has('sort_by')) {
            $attribute = request('sort_by');
            $collection = $collection->sortBy($attribute);
        }

        return $collection;
    }

    protected function transformData($data, $transformer)
    {
        return fractal($data, new $transformer)->toArray();
    }
}
