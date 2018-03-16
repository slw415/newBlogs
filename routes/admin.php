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
Route::group(['prefix' => 'admin'], function () {
    Route::get('login', 'LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'LoginController@login');
    Route::group(['middleware' => 'auth:admin'], function () {
            Route::get('/','IndexController@index');
            Route::get('/logout', 'IndexController@logout');
            //显示创建后台用户
            Route::get('/create','PostController@loginshow');
            //创建后台用户
            Route::post('/create/post','PostController@loginpost');
            //权限
            Route::resource('/permissions','PostController');
            //角色
            //更改当前权限
            Route::post('/roles/permissions/{role}','RoleController@permission');
            Route::resource('/roles','RoleController');
            //显示所有权限
            Route::get('/all/roles/permissions/{role}','RoleController@permissions');

    });

});