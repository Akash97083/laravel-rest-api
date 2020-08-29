<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class HelperController extends Controller
{
    public static function pagination($data)
    {
        $page = request('page') ?? 1;
        $per_page = request('per_page') ?? 2;
        $offset = ($page - 1) * $per_page;
        $total = $data->count();

        $options = [
            'path' => LengthAwarePaginator::resolveCurrentPath()
        ];

        $data = $data->slice($offset, $per_page)->values();

        $paginated_results = new LengthAwarePaginator($data, $total, $per_page, $page, $options);

        if ($page > $paginated_results->lastPage()) {
            return redirect($paginated_results->url($paginated_results->lastPage()));
        }

        return $paginated_results;
    }
}
