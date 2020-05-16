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

Route::get('/', 'ShopController@index');                                  //ショップトップページ

Route::group(['middleware' => ['auth']], function () {

    Route::get('/mycart', 'ShopController@myCart');
    Route::post('/mycart', 'ShopController@addMycart');
    Route::post('/cartdelete', 'ShopController@deleteCart');
    Route::post('/checkout', 'ShopController@checkout');
    Route::get('/mypage', 'ShopController@mypage');

    //アイテムの詳細＆処理選択画面
    Route::post('/actSelect', 'ShopController@actSelect');

    //追加情報の入力
    Route::get('/stockAdd', 'ShopController@stockInput');
    //追加情報の確認
    Route::post('/stockConfirm', 'ShopController@stockConfirm');
    //追加情報の追加
    Route::post('/stockComplete', 'ShopController@stockComplete');

    //削除するアイテムの選択画面
    Route::get('/delSelect', 'ShopController@delSelect');
    //削除するアイテムの確認画面
    Route::post('/delConfirm', 'ShopController@delConfirm');
    //アイテムの削除を実行
    Route::post('/delComplete', 'ShopController@delComplete');

    //編集するアイテムの選択画面
    Route::get('/editSelect', 'ShopController@editSelect');
    //編集内容入力画面画面
    Route::post('/editInput', 'ShopController@editInput');
    //編集するアイテムの確認画面
    Route::post('/editConfirm', 'ShopController@editConfirm');
    //編集するアイテムの確認画面
    Route::post('/editComplete', 'ShopController@editComplete');

});

Route::post('/detail', 'ShopController@stockDetail');
Route::post('/brand', 'ShopController@brandSelect');
Route::post('/search', 'ShopController@search');


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
