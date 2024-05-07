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

Route::get('administration/post/delete/content/{deId}/{enId}/{ruId}', [PostController::class, 'deleteContent']);

Route::get('administration/post/delete/{postId}/{conId}', [PostController::class, 'destroy']);
