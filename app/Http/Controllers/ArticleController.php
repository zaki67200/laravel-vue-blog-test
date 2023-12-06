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

public function ShowListArticles()
{
    return view ('articles.liste-articles');
}




}
