<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/users', [UserController::class, 'index']);

Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
// Route pour un article spécifique
Route::get('article/{id}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/article/edit/{id}', [ArticleController::class, 'edit']);
Route::post('/article/update/{id}', [ArticleController::class, 'update']);