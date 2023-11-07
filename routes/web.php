<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;

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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/post/{post}', 'App\Http\Controllers\PostController@show')->name('post');
Route::get('/roles', 'App\Http\Controllers\RoleController@index')->name('roles.index');
Route::get('/permissions', 'App\Http\Controllers\PermissionController@index')->name('permissions.index');
Route::post('/roles/store', 'App\Http\Controllers\RoleController@store')->name('roles.store');
Route::delete('/roles/{role}/destroy', 'App\Http\Controllers\RoleController@destroy')->name('roles.destroy');




Route::middleware('auth')->group(function (){
    Route::get('/admin', 'App\Http\Controllers\AdminController@index')->name('admin.index');
    Route::get('/admin/viewPost','App\Http\Controllers\PostController@index')->name('posts.viewIndex');

    Route::get('/admin/posts/create', 'App\Http\Controllers\PostController@create')->name('post.create');
    Route::any('/admin/posts','App\Http\Controllers\PostController@store')->name('post.store');
    Route::get('/admin/posts/{post}edit','App\Http\Controllers\PostController@edit')->name('post.edit');

    Route::delete('/admin/posts/{post}/delete','App\Http\Controllers\PostController@destroy')->name('post.destroy');
    Route::Patch('/admin/posts/{post}/update', 'App\Http\Controllers\PostController@update')->name('post.update');
    Route::get('admin/users/{user}/profile', 'App\Http\Controllers\UserController@show')->name('user.profile.show');
    Route::put('admin/users/{user}/update', 'App\Http\Controllers\UserController@update')->name('user.profile.update');
    Route::delete('admin/users/{user}/destroy','App\Http\Controllers\UserController@destroy')->name('user.destroy');


});
Route::middleware('role:admin')->group(function (){
    Route::get('admin/users', 'App\Http\Controllers\UserController@index')->name('users.index');


});
Route::middleware(['role:admin','auth'])->group(function (){
    Route::put('admin/users/{user}/attach','App\Http\Controllers\UserController@attach')->name('user.role.attach');
    Route::put('admin/users/{user}/detach','App\Http\Controllers\UserController@detach')->name('user.role.detach');



});
