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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['namespace'=>"App\Http\Controllers"],function(){
        Route::group(['middleware'=>"auth"],function(){

            // admin Routes
            Route::group(['prefix'=>'admin','middleware'=>'admin'],function(){
                 Route::get('/','HomeController@admin')->name('admin');
                Route::get('/me/{id}','UserController@editUser')->name('edit-admin');
              Route::resource('user', 'UserController');
              Route::patch('/password-change/{id}' ,'UserController@changePassword')->name('change-password');
             Route::resource('banner','BannerController')->except('show');
             Route::resource('brand','BrandController')->except('show');
             Route::resource('category','CategoryController');
             Route::resource('product', 'ProductController');
             Route::resource('page', 'PageController')->except(['create','store','destroy']);
            });

        //Seller Routes
          
        Route::group(['prefix' => 'seller', 'middleware' => 'seller'], function () {
            Route::get('/', 'HomeController@aeller')->name('seller');
        });


        //Customer 
        Route::group(['prefix' => 'customer', 'middleware' => 'customer'], function () {
            Route::get('/', 'HomeController@customer')->name('customer');
        });


     });

     Route::get('get-category','CategoryController@getAllCategories')->name('get-category');
});
