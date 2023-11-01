<?php

use App\Http\Controllers\Admin\PostCommentController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserCommentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [WelcomeController::class, 'index'])->name('blog.index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->prefix('admin')
    ->group(function (Router $router) {
        //Blog
        $router->get('blog/{post}', [PostController::class, 'show'])->name('blog.show');
        $router->get('users/{user}/profile', [UserController::class, 'show'])->name('users.show');

        //Post
        $router->get('posts/{post}/destroy-modal', [PostController::class, 'destroyModal'])->name('posts.destroy-modal');
        $router->resource('posts', PostController::class);

        //Post comments.
        $router->get('posts/{post}/comments/create', [PostCommentController::class, 'create'])->name('comments.create');
        $router->get('posts/comments/{comment}/destroy-modal', [PostCommentController::class, 'destroyModal'])->name('comments.destroy-modal');
        $router->resource('posts/comments', PostCommentController::class)->except(['create']);

        //User comments.
        $router->get('users/user-comments/{comment}/destroy-modal', [UserCommentController::class, 'destroyModal'])->name('user-comments.destroy-modal');
        $router->get('users/{user}/user-comments/create', [UserCommentController::class, 'create'])->name('user-comments.create');
        $router->post('users/user-comments', [UserCommentController::class, 'store'])->name('user-comments.store');
        //$router->put('users/user-comments/{comment}', [UserCommentController::class, 'update'])->name('comments.update');
        $router->delete('users/user-comments/{comment}', [UserCommentController::class, 'destroy'])->name('user-comments.destroy');
        //$router->resource('users/user-comments', UserCommentController::class)->except(['create']);
    });
