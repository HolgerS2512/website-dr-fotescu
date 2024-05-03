<?php

use App\Http\Controllers\Admin\PostController;
use Illuminate\Support\Facades\Route;

/*
|
|--------------------------------------------------------------------------
| Blog post Routes
|--------------------------------------------------------------------------
|
*/

Route::get('administration/post/create', [PostController::class, 'create']);

Route::post('administration/post/store', [PostController::class, 'store']);

Route::get('administration/post/edit/{id}', [PostController::class, 'edit']);

Route::put('administration/post/update/{postId}/{conId}', [PostController::class, 'update']);

Route::patch('administration/post/update/visible/{id}', [PostController::class, 'visible']);

Route::patch('administration/post/update/up/{id}', [PostController::class, 'up']);

Route::patch('administration/post/update/down/{id}', [PostController::class, 'down']);

Route::get('administration/post/delete/{id}', [PostController::class, 'destroy']);
