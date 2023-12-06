<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
class ArticleController extends Controller
{


    public function index()
{
    $articles = Article::all();
    return response()->json($articles);
}
public function show($articleId)
{
    // Récupérez l'article avec l'utilisateur associé
    $article = Article::with('user')->findOrFail($articleId);

    // Retourner l'article sous forme de réponse JSON
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


}
