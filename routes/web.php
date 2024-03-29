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

// ユーザ登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');
// 認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');
Route::prefix('login')->name('login.')->group(function () {
    Route::get('/{provider}', 'Auth\LoginController@redirectToProvider')->name('{provider}');
    Route::get('/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('{provider}.callback');
});
Route::prefix('register')->name('register.')->group(function () {
    Route::get('/{provider}', 'Auth\RegisterController@showProviderUserRegistrationForm')->name('{provider}');
    Route::post('/{provider}', 'Auth\RegisterController@registerProviderUser')->name('{provider}');
});
// ゲストユーザーログイン
Route::get('guest', 'Auth\LoginController@guestLogin')->name('login.guest');

Route::group(['middleware' => 'auth'], function () {
    //投稿一覧画面表示
    Route::get('/', 'ArticleController@index')->name('articles.index');
    //いいねした記事を表示
    Route::get('/likes/index', 'LikeController@index')->name('likes.index');
    //画像投稿画面
    Route::get('/form', 'UploadImageController@show')->name("upload_form");
    //画像アップロード
    Route::post('/upload', 'UploadImageController@upload')->name("upload_image");
    //画像削除
    Route::delete('/delete/{id}', 'UploadImageController@destroy')->name("image.delete");
    // お問い合わせ入力ページ
    Route::get('/contacts', 'ContactController@index')->name('contacts.index');
    // 確認ページ
    Route::post('/contacts/confirm', 'ContactController@confirm')->name('contacts.confirm');
    // DB挿入、メール送信
    Route::post('/contacts/process', 'ContactController@process')->name('contacts.process');
    // 完了ページ
    Route::get('/contacts/complete', 'ContactController@complete')->name('contacts.complete');
});
//ユーザー関係
Route::group(['prefix' => 'users', 'middleware' => 'auth'], function () {
    //ユーザー一覧画面
    Route::get('index', 'UserController@index')->name('users.index');
    //ユーザー詳細画面
    Route::get('show/{user}', 'UserController@show')->name('users.show');
    //ユーザー編集画面
    Route::get('edit/{user}', 'UserController@edit')->name('users.edit');
    //ユーザー更新
    Route::patch('update/{user}', 'UserController@update')->name('users.update');
    //ユーザーをフォロー
    // Route::post('follow/{id}', 'UserController@follow')->name('users.follow');
    Route::put('/{name}/follow', 'UserController@follow')->name('users.follow');
    //ユーザーをアンフォロー
    Route::delete('/{name}/follow', 'UserController@unfollow')->name('users.unfollow');
    //フォローユーザー一覧表示
    Route::get('followings/{id}', 'UserController@followings')->name('users.followings');
    //フォロワー一覧表示
    Route::get('followers/{id}', 'UserController@followers')->name('users.followers');
    //マッチングユーザー一覧画面
    Route::get('/matching/{user}', 'UserController@follow_each')->name('users.matchs');
});
Route::group(['middleware' => 'auth'], function () {
    Route::prefix('articles')->name('articles.')->group(function () {
        //コメント表示画面
        Route::get('/show/{article}', 'ArticleController@show')->name('show');
        //コメント投稿画面表示
        Route::get('/create', 'ArticleController@create')->name('create');
        //コメント投稿機能
        Route::post('/store', 'ArticleController@store')->name('store');
        //コメント編集機能
        Route::get('/edit/{article}', 'ArticleController@edit')->name('edit');
        //コメント更新
        Route::patch('/update/{article}', 'ArticleController@update')->name('update');
        //コメント削除
        Route::delete('/{article}', 'ArticleController@destroy')->name('destroy');
        //csvDownload
        Route::get('/download_csv', 'ArticleController@download_csv')->name('CsvDownload');
    });
});
//いいね・いいねを外すボタン
Route::prefix('articles')->name('articles.')->group(function () {
    Route::put('/{article}/like', 'ArticleController@like')->name('like')->middleware('auth');
    Route::delete('/{article}/like', 'ArticleController@unlike')->name('unlike')->middleware('auth');
});

Route::group(['prefix' => 'chat', 'middleware' => 'auth'], function () {
    Route::post('show', 'ChatController@show')->name('chat.show');
    Route::post('chat', 'ChatController@chat')->name('chat.chat');
});

Route::get('/tags/{name}', 'TagController@show')->name('tags.show');
