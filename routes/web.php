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
    return view('/admin.login');
});

Route::group(["prefix"=>"admin","namespace"=>"Admin"],function(){
    Route::get('login', "LoginController@login");
    Route::post('dologin', "LoginController@dologin");
    Route::get("user/incr","UserController@incr");

});
Route::group(['prefix'=>"/admin",'namespace'=>'Admin',"middleware"=>"islogin"],function(){
    Route::get('logout', "LoginController@logout");
    Route::get('index', function(){
        return view("admin.index");
    });
    Route::get('welcome', function(){
        return view("admin.welcome");
    });

    Route::resource("user","UserController");       //用户模块
    Route::post("user/index","UserController@index");
    Route::get("user/auth/{id}","UserController@auth");
    Route::post("user/doAuth","UserController@doAuth");
    Route::post("user/delAll","UserController@delAll");


    Route::post("role/index","RoleController@index");      
    Route::resource("role","RoleController");       //角色模块
    Route::get("role/auth/{id}","RoleController@auth");      //角色授权
    Route::post("role/doAuth","RoleController@doAuth");      //角色授权
    //
});
// Route::get('/admin/login', "Admin\LoginController@login");
