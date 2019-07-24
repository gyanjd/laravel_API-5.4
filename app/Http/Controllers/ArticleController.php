<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get articles
        // $articles = Article::paginate(3);
        $articles = Article::select('id','title', 'body')->paginate(3);
        //return
        return json_encode($articles);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $article = $request->isMethod('put') ? Article::findOrFail
        ($request->article_id) : new Article;

        $article->id = $request->input('article_id');
        $article->title = $request->input('title');
        $article->body = $request->input('body');

        if($article->save()){
            return json_encode($article);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get single article
        $article = Article::select('title', 'body')->findOrFail($id);
        //with array
            // $asd = ["fdgf"=>"sdf", "hghf"=>"gf"];
            // $article['variable'] = $asd;
        
        //with single value
        $article['variable'] = 'hekdnncon';

        return json_encode($article);
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        if($article->delete())
        {
            return "deleted";
        }        
        
    }
}
