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


Route::get('/home', function () {
    return view('welcome');
});


// 3.「http://XXXXXX.jp/XXX というアクセスが来たときに、 AAAControllerのbbbというAction に渡すRoutingの設定」を書いてみてください。
Route::get('/XXX', 'AAAController@bbb');

//4. admin/profile/create にアクセスしたら ProfileController の add Action に、admin/profile/edit にアクセスしたら ProfileController の edit Action に割り当てるように設定
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
    /*
        通常のページの表示にはgetを受け取り、
        フォームを送信したときに受け取る場合にはpostを受け取るように指定する。
    */
    // news
    Route::get('news/create', 'Admin\NewsController@add');
    Route::get('news/delete', 'Admin\NewsController@delete');
    //Route::get('news/update', 'Admin\NewsController@update');
    Route::post('news/create', 'Admin\NewsController@create');
    Route::get('news', 'Admin\NewsController@index');
    Route::get('news/edit', 'Admin\NewsController@edit');
    Route::post('news/edit', 'Admin\NewsController@update');
    Route::get('news/delete', 'Admin\NewsController@delete');
    // profile
    Route::get('profile/create', 'Admin\ProfileController@add');
    Route::get('profile/edit', 'Admin\ProfileController@edit');
    Route::post('profile/create', 'Admin\ProfileController@create');
    Route::post('profile/edit', 'Admin\ProfileController@update');
});

Auth::routes();

Route::get('/', 'NewsController@index');
Route::get('/profile', 'NewsController@profile');