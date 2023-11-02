<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostRequest;
use App\Models\Post;
use App\Repositories\Contracts\ModelRepository;
use App\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;

class PostController extends Controller
{
    /**
     * @var PostRepositoryInterface
     */
    private PostRepositoryInterface $postRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->middleware('auth');
        $this->postRepository = $postRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, Builder $table)
    {
        if ($request->ajax()) {
            $query = Post::query()
                ->where('created_by', '=', Auth::id());
            return DataTables::eloquent($query)
                ->addColumn('title', function (Post $post) {
                    return $post->title;
                })
                ->addColumn('content', function (Post $post) {
                    return strip_tags($post->content);
                })
                ->editColumn('action', function (Post $post) {
                    return view('admin.post.parts.actions', ['resource' => 'posts', 'params' => ['post' => $post->id]]);
                })
                ->toJson();
        }
        $table->parameters([
            'responsive' => true,
            'searching' => false,
            'lengthChange' => false,
            'processing' => true,
            'serverSide' => true,
            'language' => [
                'url' => '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json',
            ],
        ]);
        $table->addColumn(['data' => 'title', 'name' => 'title', 'title' => __('models/post.fillable.title')]);
        $table->addColumn(['data' => 'content', 'name' => 'content', 'title' => __('models/post.fillable.content')]);
        $table->addAction(['title' => __('general.tables.action')]);
        $data['table'] = $table;

        return view('admin.post.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return $this->createOrEdit();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Post $post)
    {
        return $this->createOrEdit($post->id);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    private function createOrEdit($id = null)
    {
        $data['post'] = Post::query()
            ->findOrNew($id);

        return view('admin.post.modal-save', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     * @return JsonResponse
     */
    public function store(PostRequest $request)
    {
        return $this->storeOrUpdate($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostRequest $request
     * @param Post $post
     * @return JsonResponse
     */
    public function update(PostRequest $request, Post $post): JsonResponse
    {
        return $this->storeOrUpdate($request, $post->id);
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
            $this->postRepository->createOrUpdate($request->validated(), $id);
            DB::commit();
        } catch (Throwable $exception) {
            DB::rollBack();
            $success = false;
        }

        return response()->json([
            'success' => $success,
            'dismissModal' => true,
            'refreshTable' => true,
            'toast' => [
                'type' => 'info',
                'title' => 'Information',
                'message' => 'Solicitud exitosa',
            ]
        ]);
    }

    /**
     * @param  Post $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function destroyModal(Post $post)
    {
        $data['post'] = $post;

        return view('admin.post.modal-destroy', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return JsonResponse
     */
    public function destroy(Post $post): JsonResponse
    {
        $success = true;
        DB::beginTransaction();
        try {
            $post->delete();
            DB::commit();
        } catch (Throwable $exception) {
            DB::rollBack();
            $success = false;
        }

        return response()->json([
            'success' => $success,
            'dismissModal' => true,
            'refreshTable' => true,
            'toast' => [
                'type' => 'info',
                'title' => 'Information',
                'message' => 'Solicitud exitosa',
            ]
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Post $post)
    {
        $data['post'] = $post;

        return view('show-blog', $data);
    }
}
