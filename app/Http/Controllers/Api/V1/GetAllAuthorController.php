<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\UserWithCommentAndPostResource;
use App\Models\User;
use App\Traits\PaginateJsonResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetAllAuthorController extends Controller
{
    use PaginateJsonResponse;

    /**
     * Get all authors with comments and authors.
     *
     * @param Request $request
     * @return JsonResponse
     */
   public function __invoke(Request $request): JsonResponse
   {
       $paginator = User::query()->paginate(
           $request->get('perPage', 10),
           ['*'],
           'page',
           $request->get('page', 1),
       );

       return response()->json([
           'message' => 'User lists successfully',
           'data' => $this->paginate($paginator, UserWithCommentAndPostResource::class),
       ]);
   }
}
