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

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');


// ユーザ登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');
// 認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

//画像投稿画面
Route::get('/form', 'UploadImageController@show')->name("upload_form");
//画像アップロード
Route::post('/upload', 'UploadImageController@upload')->name("upload_image");
//ユーザー関係
Route::group(['prefix' => 'users', 'middleware' => 'auth'], function () {
    //ユーザー詳細画面
    Route::get('show/{id}', 'UserController@show')->name('users.show');
    //ユーザー編集画面
    Route::get('edit/{id}', 'UserController@edit')->name('users.edit');
    //ユーザー更新
    Route::patch('update/{id}', 'UserController@update')->name('users.update');
});

