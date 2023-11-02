<?php

use App\Http\Controllers\Api\V1\CreatePostController;
use App\Http\Controllers\Api\V1\GetAllAuthorController;
use App\Http\Controllers\Api\V1\GetAllPostController;
use App\Http\Controllers\Api\V1\LoginController;
use App\Http\Controllers\Api\V1\LogoutController;
use App\Http\Controllers\Api\V1\RegisterController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function (Router $router) {
    $router->post('login', LoginController::class);
    $router->post('register', RegisterController::class);
});

Route::prefix('v1')->middleware('auth:sanctum')->group(function (Router $router) {
    $router->post('/logout', LogoutController::class);

    $router->get('/posts', GetAllPostController::class);
    $router->post('/posts', CreatePostController::class);

    $router->get('/authors', GetAllAuthorController::class);
});
