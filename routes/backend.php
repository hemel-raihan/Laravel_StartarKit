<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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



Route::group(['as'=>'app.','prefix'=>'app','namespace'=>'Backend','middleware'=>['auth']],function(){
    Route::get('/dashboard','DashboardController')->name('dashboard');
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');

    //for profile
    Route::get('profile','ProfileController@index')->name('profile.index');
    Route::put('profile','ProfileController@update')->name('profile.update');

    //for security
    Route::get('profile/security','ProfileController@changePassword')->name('profile.password.change');
    Route::put('profile/security','ProfileController@updatePassword')->name('profile.password.update');


    //for backup
    Route::resource('backups','BackupController')->only(['index','store','destroy']);
//for page
    Route::resource('pages','PageController');

    //for menu
    Route::resource('menus','MenuController');

    //for menu
    Route::resource('menus','MenuController');
    Route::group(['as'=>'menus.', 'prefix'=>'menus/{id}'],function(){
          Route::post('order', 'MenuBuilderController@order')->name('order');
          Route::get('builder', 'MenuBuilderController@index')->name('builder');


          Route::get('item/create', 'MenuBuilderController@itemCreate')->name('item.create');
          Route::post('item/store', 'MenuBuilderController@itemStore')->name('item.store');

          Route::get('item/{itemId}/edit', 'MenuBuilderController@itemEdit')->name('item.edit');
          Route::put('item/{itemId}/update', 'MenuBuilderController@itemUpdate')->name('item.update');

          Route::delete('item/{itemId}/destroy', 'MenuBuilderController@itemDestroy')->name('item.destroy');
    });
});
