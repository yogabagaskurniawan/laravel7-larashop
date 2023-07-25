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

// Route::get('/', function () {
//     return view('welcome');
// });

// admin access
Route::group(
    ['namespace' => 'admin', 'prefix' => 'admin', 'middleware' => ['auth','isAdmin:admin']],
    function () {
        // add product admin
        Route::get('products/create', 'ProductController@create');
        Route::post('products', 'ProductController@store');
        Route::delete('products/{id}', 'ProductController@destroy');
        
        //  categories
        Route::get('categories/create', 'CategoriesController@create');
        Route::post('categories/store', 'CategoriesController@store')->name('admin.categories.store');
        Route::get('categories/{id}/edit', 'CategoriesController@edit');
        Route::put('categories/update/{id}', 'CategoriesController@update')->name('admin.categories.update');
        Route::get('categories/delete/{id}', 'CategoriesController@destroy');

        // attribute
        Route::get('attributes/{id}/edit', 'AttributeController@edit');
        Route::put('attributes/{id}', 'AttributeController@update');
        Route::delete('attributes/{id}', 'AttributeController@destroy');
        
        // attribute options
        Route::delete('attributes/options/{optionID}', 'AttributeController@remove_option');
        Route::get('attributes/options/{optionID}/edit', 'AttributeController@edit_option');
        Route::put('attributes/options/{optionID}', 'AttributeController@update_option');

        // Hak access
        Route::get('users/create', 'UserController@create');
        Route::post('users/store', 'UserController@store')->name('admin.users.store');
        Route::get('users/{id}/edit', 'UserController@edit');
        Route::put('users/update/{id}', 'UserController@update')->name('admin.users.update');
        Route::get('users/delete/{id}', 'UserController@destroy');
    }
);    

// operator access
Route::group(
    ['namespace' => 'admin', 'prefix' => 'admin', 'middleware' => ['auth']],
    function () {
        Route::get('dashboard', 'DashboardController@index');
        
        // categories
        Route::get('categories', 'CategoriesController@index');
        
        // product
        Route::get('products', 'ProductController@index');
        Route::get('products/{id}/edit', 'ProductController@edit');
        Route::put('products/{id}', 'ProductController@update');
        
        // product image
        Route::get('products/{productID}/images','ProductController@images');
        Route::get('products/{productID}/add-image','ProductController@add_image');
        Route::post('products/images/{productID}','ProductController@upload_image');
        Route::delete('products/images/{imageID}','ProductController@remove_image');
        
        // attribute
        Route::get('attributes', 'AttributeController@index');
        Route::get('attributes/create', 'AttributeController@create');
        Route::post('attributes', 'AttributeController@store');

        // attribute options
        Route::get('attributes/{attributeID}/options', 'AttributeController@options');
        Route::post('attributes/options/{attributeID}', 'AttributeController@store_option');
        
        // Hak Access
        Route::get('hakaccess', 'UserController@index');
    }
);
Auth::routes();

// dashboard admin
// Route::get('/home', 'HomeController@index')->name('home');

// user
Route::get('/', 'HomeController@index')->name('home');
Route::get('/products', 'ProductController@index');
Route::get('/product/{slug}', 'ProductController@show');
