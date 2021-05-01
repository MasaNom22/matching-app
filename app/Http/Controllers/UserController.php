<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

use App\UploadImage;

use App\User;
use App\Article;
use App\Tag;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::All();
        return view('users.index', [
            "users" => $users,
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $articles = Article::where('user_id', $user->id)->get()->load(['likes','user']);
        // ユーザの投稿数を取得
        $user->loadCount('articles');
        // ユーザのフォロワーをカウント
        $user->loadCount('followers');
        // ユーザのフォローユーザーを取得
        $user->loadCount('followings');
        

        // ユーザ詳細ビューでそれを表示
        return view('users.show', [
            'user' => $user,
            'articles' => $articles,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //アップロードした画像を取得
        $upload = UploadImage::find($user->id);
        $tagNames = $user->tags->map(function ($tag) {
            return ['text' => $tag->name];
        });

        return view('users.edit', [
            'user' => $user,
            'image' => $upload,
            'tagNames' => $tagNames,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        //ユーザーの上書き
        $user->name = $request->name;
        $user->email = $request->email;
        $user->age = $request->age;
        $user->save();
        
        $user->tags()->detach();
        $request->tags->each(function ($tagName) use ($user) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $user->tags()->attach($tag);
        });
        
        return redirect()->route('users.show', [
            'user' => $user,
            'id' => $user->id,
        ]);
    }


    
    //  public function follow($id)
    // {
    //     // 認証済みユーザ（閲覧者）が、 idのユーザをフォローする
    //     \Auth::user()->follow($id);
    //     // 前のURLへリダイレクトさせる
    //     // return back();
    //     $users=User::All();
    //     return view('users.index', [
    //         "users" => $users,
    //         ]);
    // }
    public function follow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();

        if ($user->id === $request->user()->id) {
            return abort('404', 'Cannot follow yourself.');
        }

        $request->user()->followings()->detach($user);
        $request->user()->followings()->attach($user);

        return ['id' => $user->id];
    }
    // public function unfollow($id)
    // {
    //     // 認証済みユーザ（閲覧者）が、 idのユーザをアンフォローする
    //     \Auth::user()->unfollow($id);
    //     // 前のURLへリダイレクトさせる
    //     // return back();
    //     $users=User::All();
    //     return view('users.index', [
    //         "users" => $users,
    //         ]);
    // }
    
    public function unfollow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();
        
        if ($user->id === $request->user()->id) {
            return abort('404', 'Cannot follow yourself.');
        }

        $request->user()->followings()->detach($user);

        return ['id' => $user->id];
    }
    
    public function followings($id)
    {
        $user = User::findOrFail($id);
        // ユーザのフォローユーザーをカウント
        $user->loadCount('followings');
        // ユーザのフォローユーザーを取得
        $followings = $user->followings()->get();
        

        return view('users.followings', [
            'user' => $user,
            'users' => $followings,
        ]);
    }
    
    public function followers($id)
    {
        $user = User::findOrFail($id);
        // ユーザのフォロワーをカウント
        $user->loadCount('followers');

        // ユーザのフォロワーを取得
        $followers = $user->followers()->get();

        return view('users.followers', [
            'user' => $user,
            'users' => $followers,
        ]);
    }
    

    
    public function follow_each($id)
    {
        $user=User::find($id);
        $users=User::All();
        //相互フォロー中のユーザを返す
        return view('users.matchings', [
            'user' => $user,
            "users" => $users,
        ]);
    }
    
    public function chatRoomUsers()
    {
        return $this->hasMany('App\ChatRoomUsers');
    }
    
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }
}
