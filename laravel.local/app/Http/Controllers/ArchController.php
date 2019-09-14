<?php

namespace App\Http\Controllers;


use App\Models\Article;
use Illuminate\Http\Request;

class ArchController extends Controller
{
    public function moveToArchive(Request $request)
    {
        $articles = Article::getByDateAndRubric($request['date'], $request['rubrics']);
        if(!empty($articles)){
            foreach ($articles as $article) {
                $article['arch'] = 1;
                $article->save();
            }
        }
    }

}
