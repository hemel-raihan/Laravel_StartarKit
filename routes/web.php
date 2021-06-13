<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
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

Route::get('command', function () {
    \Artisan::call('backup:run');
});

Auth::routes();

Route::get('/login/{provider}', [LoginController::class, 'redirectToProvider'])->name('login.provider');
Route::get('/login/{provider}/callback', [LoginController::class, 'handleProvider'])->name('login.callback');

/*Route::group(['as'=>'login.','prefix'=>'login'],function(){
    Route::get('/{provider}','LoginController@redirectToProvider')->name('provider');
    Route::get('/{provider}/callback','LoginController@handleProvider')->name('callback');
});*/

//Route::view('/test','layouts.frontend.test');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


