<?php
/**
 * Created by : alex
 * Date: 03.08.2019
 * Time: 12:44
 */

namespace App\Http\Controllers;


use App\Models\Article;
use App\Models\Author;

class WelcomeController extends Controller
{
    public function showLatestNews()
    {
        $news = Article::all()->take(5);

        return view('welcome', ['articles' => $news]);

    }
}

