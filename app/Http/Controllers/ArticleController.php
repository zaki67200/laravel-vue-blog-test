<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Cache;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Article;
class ArticleController extends Controller
{


    public function index()
{
    $articles = Article::all();
    return response()->json($articles);
}

// Fonction show avec eager loading et gestion des exceptions
public function show($articleId)
{
    try {
        $article = Article::with('user')->findOrFail($articleId);
        // Sélectionnez uniquement les champs nécessaires si besoin
        return response()->json($article);
    } catch (ModelNotFoundException $e) {
        return response()->json(['error' => 'Article non trouvé'], 404);
    }
}

// Fonction edit avec validation de l'ID et caching
public function edit($id)
{
    if (!is_numeric($id) || $id <= 0) {
        return response()->json(['error' => 'ID invalide'], 400);
    }

    // Utilisez le caching ici si nécessaire
    $article = Cache::remember("article_{$id}", 60, function () use ($id) {
        return Article::findOrFail($id);
    });

    return response()->json($article);
}

public function updateUserArticle(Request $request, $articleId) {
    $article = Article::find($articleId);
    // ... Logique de mise à jour de l'article
    return response()->json(['message' => 'Article updated successfully']);
}


public function update(Request $request, $id)
{
    $article = Article::findOrFail($id);

    if ($request->hasFile('image')) {
        // Suppression de l'ancienne image
        if ($article->imageUrl) {
            $oldFilename = basename($article->imageUrl);
            Storage::delete('public/images/' . $oldFilename);
        }

        // Stockage de la nouvelle image
        $filename = $request->image->store('images', 'public');
        $article->imageUrl = Storage::url($filename);
    }

    // Mise à jour des autres champs
    $article->update($request->except(['image']));

    return response()->json($article);
}
public function ShowListArticles()
{
    return view ('articles.liste-articles');
}

public function ShowArticle($id)
{
    $article = Article::findOrFail($id);
    return view('articles.show-article', ['article' => $article]);
}

// Afficher la vue Blade pour l'édition
public function ShowEditArticle($id)
{
    return view('articles.edit-article', ['articleId' => $id]);
}




}
