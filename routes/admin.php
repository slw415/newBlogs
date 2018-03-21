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
            //修改当前用户信息
             Route::get('/edit', 'IndexController@edit');
             Route::post('/update', 'IndexController@update');
            //显示创建后台用户
            Route::get('/create','PostController@loginshow');
            //创建后台用户
            Route::post('/create/post','PostController@loginpost');
            //后台用户列表
            Route::resource('/list','ListController');
            //更新用户列表缓存
            Route::get('/list/new/cache','ListController@cache');
            //权限
            Route::resource('/permissions','PostController');
            //更新用户权限列表缓存
            Route::get('/permissions/new/cache','PostController@cache');
            //角色
            //更改当前权限
            Route::post('/roles/permissions/{role}','RoleController@permission');
            Route::resource('/roles','RoleController');
            //更新用户权限列表缓存
            Route::get('/roles/new/cache','RoleController@cache');
            //显示所有权限
            Route::get('/all/roles/permissions/{role}','RoleController@permissions');

    });

});