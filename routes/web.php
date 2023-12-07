<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/articles', [ArticleController::class, 'ShowListArticles'])->name('articles.liste-articles');
Route::get('/article/{id}', [ArticleController::class, 'ShowArticle'])->name('articles.show-article');

// Route pour afficher le formulaire d'édition
Route::get('/article/edit/{id}', [ArticleController::class, 'ShowEditArticle'])->name('articles.edit-article');

// Route pour la mise à jour de l'article
//Route::put('/article/update/{id}', [ArticleController::class, 'update'])->name('articles.edit-article');
// Route::middleware(['role:admin'])->group(function () {
//     Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
//     // Autres routes réservées à l'administrateur
// })