<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::group(['middleware' => 'auth'], function() {
Route::get('/', 'ArticleController@index')->name('articles.index');
});


// ユーザ登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');
// 認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');
// ゲストユーザーログイン
Route::get('guest', 'Auth\LoginController@guestLogin')->name('login.guest');

//画像投稿画面
Route::get('/form', 'UploadImageController@show')->name("upload_form");
//画像アップロード
Route::post('/upload', 'UploadImageController@upload')->name("upload_image");
//ユーザー関係
Route::group(['prefix' => 'users', 'middleware' => 'auth'], function () {
    //ユーザー一覧画面
    Route::get('index', 'UserController@index')->name('users.index');
    //ユーザー詳細画面
    Route::get('show/{id}', 'UserController@show')->name('users.show');
    //ユーザー編集画面
    Route::get('edit/{id}', 'UserController@edit')->name('users.edit');
    //ユーザー更新
    Route::patch('update/{id}', 'UserController@update')->name('users.update');
    //ユーザーをフォロー
    Route::post('follow/{id}', 'UserController@follow')->name('users.follow');
    //ユーザーをアンフォロー
    Route::delete('unfollow/{id}', 'UserController@unfollow')->name('users.unfollow');
    //フォローユーザー確認
    Route::get('followings/{id}', 'UserController@followings')->name('users.followings');
});
//コメント表示画面
Route::get('/articles/index', 'ArticleController@index')->name('articles.index');
//コメント投稿画面表示
Route::get('/articles/create', 'ArticleController@create')->name('articles.create');
//コメント投稿機能
Route::post('/articles/store', 'ArticleController@store')->name('articles.store');
//コメント編集機能
Route::get('/articles/edit/{id}', 'ArticleController@edit')->name('articles.edit');
//ユーザー更新
Route::patch('/articles/update/{id}', 'ArticleController@update')->name('articles.update');
//コメント削除
Route::delete('/articles/{id}', 'ArticleController@destroy')->name("articles.destroy");

