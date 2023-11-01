<?php

use App\Http\Controllers\Admin\PostController;
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

Route::get('/', [WelcomeController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group([], function (Router $router) {
    $router->get('posts/{post}/destroy-modal', [PostController::class, 'destroyModal'])
        ->name('posts.destroy-modal');
    $router->resource('posts', PostController::class);
});
