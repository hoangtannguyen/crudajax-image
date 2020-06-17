<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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



Route::group(['prefix' => '/customer'], function () {
    Route::get('/', "CustomerController@index")->name('c.index');
    Route::get('/all', "CustomerController@getAll")->name('c.getAll');
    Route::get('/show/{id}','CustomerController@show')->name('c.show');
    // Route::get('/trash', "ChucvuController@getTrash")->name('cv.getTrash');
    Route::get('/{id}', "CustomerController@findById")->name('cv.findById');
    // Route::get('/{id}/trash', "ChucvuController@findTrashById")->name('cv.findTrashById');
    Route::post('/cc', "CustomerController@store")->name('c.create');
    Route::put('/{id}', "CustomerController@update")->name('c.update');
    // Route::put('/{id}/restore', "ChucvuController@restore")->name('cv.restore');
    // Route::delete('/{id}', "ChucvuController@moveToTrash")->name('cv.moveToTrash');
    Route::delete('/{id}/destroy', "CustomerController@destroy")->name('c.destroy');

    Route::get('/show/{id}','CustomerController@show')->name('c.show');
});
