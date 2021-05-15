<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\ArticleRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Article::class, 'article');
    }

    public function index()
    {
        $articles = Article::all()->sortByDesc('created_at')
            ->load(['user', 'likes']);
        return view('articles.index', [
            'articles' => $articles,
        ]);
    }

    public function show(Article $article)
    {
        return view('articles.show', [
            'article' => $article,
        ]);
    }

    public function create()
    {
        //use Illuminate\Support\Facades\Auth;が必要
        $user = Auth::user();

        return view('articles.create', [
            'user' => $user,
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

    public function edit(Article $article)
    {
        return view('articles.edit', ['article' => $article]);
    }

    public function update(Article $article, Request $request)
    {
        $request->validate([
            'body' => 'required',
        ]);
        $article->body = $request->body;
        $article->save();

        return redirect()->route('articles.index');
    }

    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('articles.index');
    }

    //     public function like($id)
    //     {
    //          \Auth::user()->like($id);

//         return back();
    //     }
    public function like(Request $request, Article $article)
    {
        $article->likes()->detach($request->user()->id);
        $article->likes()->attach($request->user()->id);

        return [
            'id' => $article->id,
            'countLikes' => $article->count_likes,
        ];
    }

    // public function unlike($id)
    // {
    //     \Auth::user()->unlike($id);
    //     // 前のURLへリダイレクトさせる
    //     return back();
    // }
    public function unlike(Request $request, Article $article)
    {
        $article->likes()->detach($request->user()->id);

        return [
            'id' => $article->id,
            'countLikes' => $article->count_likes,
        ];
    }

    public function download_csv(Request $request)
    {

        return response()->streamDownload(
            function () {
                // 出力バッファをopen
                $stream = fopen('php://output', 'w');
                // 文字コードをShift-JISに変換
                stream_filter_prepend($stream, 'convert.iconv.utf-8/cp932//TRANSLIT');
                // ヘッダー
                fputcsv($stream, [
                    'name',
                    '記事内容',
                ]);
                $articles = Article::all()->sortByDesc('created_at')
                    ->load(['user', 'likes']);
                // データ
                foreach ($articles as $article) {
                    fputcsv($stream, [
                        $article->user->name,
                        $article->body,
                    ]);
                }
                fclose($stream);
            },
            '投稿一覧.csv',
            [
                'Content-Type' => 'application/octet-stream',
            ]
        );
    }
}
