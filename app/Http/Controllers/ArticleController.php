<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use App\Article;

use App\Http\Requests\ArticleRequest;

use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
     public function index()
    {
        // 認証済みユーザを取得
        // $user = \Auth::user();
		//UserモデルにArticleモデルとの関係を書く
        //$articles = $user->articles()->orderBy('created_at', 'desc')->paginate(5);
	    $articles = Article::all()->sortByDesc('created_at');
        // タスク一覧ビューでそれを表示
        return view('articles.index', [
            'articles' => $articles,
        ]);
    }
    
    public function create()
    {
        //use Illuminate\Support\Facades\Auth;が必要
        $user = Auth::user();

        return view('articles.create', [
            'user' => $user
        ]);
    }
    
    public function store(ArticleRequest $request)
    {
        $article = new Article();
        $article->body = $request->body;
        $article->user_id = $request->user()->id;
        $article->save();
        
        return redirect()->route('articles.index');
        
    }
    
    public function edit($id)
    {
        $article = Article::find($id);
        
        return view('articles.edit', [
            'article' => $article,
        ]);
    }
    
     public function update($id, Request $request)
    {
        $article = Article::find($id);
    	$request->validate([
    		'body' => 'required',
		]);
    	$article->body = $request->body;
        $article->save();
        
        return redirect()->route('articles.index');
        
    }
    
    function destroy($id){
		$deleteArticle = Article::find($id);
		$deleteArticle->delete();
	
		return redirect()->route('articles.index');
	}
}
