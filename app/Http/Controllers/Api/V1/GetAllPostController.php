<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\PostWithCommentAndAuthorResource;
use App\Models\Post;
use App\Traits\PaginateJsonResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetAllPostController extends Controller
{
    use PaginateJsonResponse;

    /**
     * Get all posts with comments and authors.
     *
     * @param Request $request
     * @return JsonResponse
     */
   public function __invoke(Request $request): JsonResponse
   {
       $paginator = Post::query()->paginate(
           $request->get('perPage', 10),
           ['*'],
           'page',
           $request->get('page', 1),
       );

       return response()->json([
           'message' => 'Post list successfully',
           'data' => $this->paginate($paginator, PostWithCommentAndAuthorResource::class),
       ]);
   }
}
