<?php

use Illuminate\Support\Facades\Auth;
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

Route::group(
    ['namespace' => 'admin', 'prefix' => 'admin', 'middleware' => ['auth']],
    function () {
        Route::get('dashboard', 'DashboardController@index');
        Route::get('categories', 'CategoriesController@index');
        Route::get('categories/create', 'CategoriesController@create');
        Route::post('categories/store', 'CategoriesController@store')->name('admin.categories.store');
        Route::get('categories/{id}/edit', 'CategoriesController@edit');
        Route::put('categories/update/{id}', 'CategoriesController@update')->name('admin.categories.update');
        Route::get('categories/delete/{id}', 'CategoriesController@destroy');
    }
);
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
