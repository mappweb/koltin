<?php

namespace App\Traits;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

trait PaginateJsonResponse
{
    /**
     * @param LengthAwarePaginator $paginator
     * @param  $resource
     * @return array
     */
    public function paginate(LengthAwarePaginator $paginator, $resource): array
    {
        return [
            'firstItem' => $paginator->firstItem(),
            'lastItem' => $paginator->lastItem(),
            'perPage' => $paginator->perPage(),
            'currentPage' => $paginator->currentPage(),
            'lastPage' => $paginator->lastPage(),
            'total' => $paginator->total(),
            'items' => $resource::collection($paginator->items()),
        ];
    }
}
