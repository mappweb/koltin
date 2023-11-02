<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\PostWithCommentAndAuthorResource;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CreatePostController extends Controller
{
    /**
     * Handle a login request to the application.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $validator = $this->requestValidate($request);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation Error',
                'data' => $validator->errors(),
            ], 422);
        }

        return response()->json([
            'message' => 'Post created successfully',
            'user' => new PostWithCommentAndAuthorResource($this->create($request->all())),
        ]);
    }

    /**
     * Create a new post instance after a valid registration.
     *
     * @param array $data
     * @return \App\Models\Post
     */
    private function create(array $data)
    {
        return Post::query()
            ->create([
                'title' => $data['title'],
                'content' => $data['content'],
            ]);
    }

    /**
     * Validate the input request.
     *
     * @param Request $request
     * @return \Illuminate\Validation\Validator
     */
    private function requestValidate(Request $request)
    {
        return Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string', 'min:3'],
        ]);
    }
}
