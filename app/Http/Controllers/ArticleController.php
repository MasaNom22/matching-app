<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use App\Article;

use App\Http\Requests\ArticleRequest;

use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function create()
    {
        //use Illuminate\Support\Facades\Auth;が必要
        $user = Auth::user();

        return view('articles.create', [
            'user' => $user
        ]);
    }
}
