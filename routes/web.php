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

Route::group(["prefix"=>"admin","namespace"=>"Admin"],function(){
    Route::get('login', "LoginController@login");
    Route::post('dologin', "LoginController@dologin");
});
Route::group(['prefix'=>"/admin",'namespace'=>'Admin',"middleware"=>"islogin"],function(){
    Route::get('logout', "LoginController@logout");
    Route::get('index', function(){
        return view("admin.index");
    });
    Route::get('welcome', function(){
        return view("admin.welcome");
    });

});
// Route::get('/admin/login', "Admin\LoginController@login");
