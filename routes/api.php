<?php
header('Access-Control-Allow-Origin:  *');
header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization, token, Token');

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('login', 'UserController@login')->name('login');
Route::post('logout', 'UserController@logout')->name('logout');
//Route::post('register', 'UserController@register');

Route::group(['middleware' => 'auth:api'], function(){

// categories
    Route::get('categories','CategoryController@index')->name('category');
    Route::get('categories/{id}','CategoryController@show')->name('category.show');
    Route::post('categories','CategoryController@store')->name('category.store');
    Route::put('categories/{id}','CategoryController@update')->name('category.update');
    Route::delete('categories/{id}','CategoryController@destroy')->name('category.destroy');

// products
    Route::get('products','ProductController@index')->name('products');
    Route::get('products/{id}','ProductController@show')->name('product.show');
    Route::post('products','ProductController@store')->name('product.store');
    Route::put('products/{id}','ProductController@update')->name('product.update');
    Route::delete('products/{id}','ProductController@destroy')->name('producty.destroy');



});



