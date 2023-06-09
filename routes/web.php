<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// web.php
Route::group(['middleware' => 'auth'], function(){
  Route::get('/video_chat', [App\Http\Controllers\VideoChatController::class, 'index'])->name('video_chat');
  //Route::get('video_chat', 'VideoChatController@index');
  Route::post('auth/video_chat', [App\Http\Controllers\VideoChatController::class, 'auth'])->name('auth');
  //Route::post('auth/video_chat', 'VideoChatController@auth');
});
