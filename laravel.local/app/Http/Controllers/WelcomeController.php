<?php
/**
 * Created by : alex
 * Date: 03.08.2019
 * Time: 12:44
 */

namespace App\Http\Controllers;


use App\Models\Article;
use App\Models\Rubric;

class WelcomeController extends Controller
{
    public function showLatestNews()
    {
        $news = Article::getLatestNews();
        return view('welcome', ['articles' => $news]);

    }
}

