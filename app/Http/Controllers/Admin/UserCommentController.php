<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Throwable;

class UserCommentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(User $user)
    {
        return $this->createOrEdit($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Comment $comment
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Comment $comment)
    {
        return $this->createOrEdit($comment->model, $comment->id);
    }

    /**
     * @param User $user
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    private function createOrEdit(User $user, $id = null)
    {
        $data['comment'] = Comment::query()
            ->findOrNew($id);
        $data['user'] = $user;

        return view('admin.comment.modal-save', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostCommentRequest $request
     * @return JsonResponse
     */
    public function store(PostCommentRequest $request)
    {
        return $this->storeOrUpdate($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostCommentRequest $request
     * @param Comment $comment
     * @return JsonResponse
     */
    public function update(PostCommentRequest $request, Comment $comment): JsonResponse
    {
        return $this->storeOrUpdate($request, $comment->id);
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    private function storeOrUpdate(Request $request, $id = null): JsonResponse
    {
        $success = true;
        DB::beginTransaction();
        try {
            $values = $request->validated();
            $values = array_merge(
                Arr::except($values, ['post_id']),
                [
                    'model_type' => Post::class,
                    'model_id' => $values['post_id'],
                ]
            );
            Comment::query()->updateOrCreate(['id' => $id], $values);
            DB::commit();
        } catch (Throwable $exception) {
            DB::rollBack();
            $success = false;
        }

        return response()->json([
            'success' => $success,
            'dismissModal' => true,
            'reloadPage' => true,
            'toast' => [
                'type' => 'info',
                'title' => 'Information',
                'message' => 'Solicitud exitosa',
            ]
        ]);
    }

    /**
     * @param Comment $comment
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function destroyModal(Comment $comment)
    {
        $data['comment'] = $comment;

        return view('admin.comment.modal-destroy', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $success = true;
        DB::beginTransaction();
        try {
            $comment->delete();
            DB::commit();
        } catch (Throwable $exception) {
            DB::rollBack();
            $success = false;
        }

        return response()->json([
            'success' => $success,
            'dismissModal' => true,
            'reloadPage' => true,
            'toast' => [
                'type' => 'info',
                'title' => 'Information',
                'message' => 'Solicitud exitosa',
            ]
        ]);
    }
}
