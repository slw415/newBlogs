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

Route::get('/','IndexController@index');
//更新用户权限列表缓存
Route::get('/cache','IndexController@cache');

Auth::routes();
//退出
Route::get('/user/out','IndexController@out');

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => 'auth:users'], function () {
    //修改个人信息
    Route::get('/edit','IndexController@edit');
    Route::post('/update','IndexController@update');
});
//导航页
Route::get('/list/{id}', 'ListController@index');
//搜索
Route::get('/search', 'ListController@search');
//文章显示
Route::get('/article/{id}', 'ListController@article');
//ajax提交评论
Route::post('/comment','ListController@comment');
//留言板
Route::get('/message','MessageController@index');
Route::post('/message','MessageController@message');
