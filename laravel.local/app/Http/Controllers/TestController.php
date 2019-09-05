<?php

namespace App\Http\Controllers;


use App\Models\Article;

class TestController extends Controller
{
    public function index()
    {
        $article = new Article();
        $article->title = 'Первая новость';
        $article->subtitle = 'подзаголовок 1';
        $article->content = 'FFFFFFF JJJJJJJJJJJJJJJJJJJJJJJ';
        $article->arch = false;
        $article->rubric = 'Спорт';
        $article->save();

        return view('test', ['name' => 'Ivan']);
    }

}
