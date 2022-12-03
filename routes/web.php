<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\ShopController;



//Frontend begin
//Home
Route::prefix('home')->group(function (){
    Route::get('','App\Http\Controllers\Front\HomeController@index')->name('home.index');



});

//Contact
Route::prefix('contact')->group(function () {
    Route::get('','App\Http\Controllers\Front\ContactController@index')->middleware('App\Http\Middleware\CheckMemberLogin')->name('contact.index');
    Route::post('userContact/{id}','App\Http\Controllers\Front\ContactController@submit')->name('userContact');
});

//Blog
Route::prefix('blog')->group(function () {
    Route::get('item/{id}','App\Http\Controllers\Front\BlogController@show')->name('blog.item');
    Route::post('comment/{id}','App\Http\Controllers\Front\BlogController@postComment')->middleware('App\Http\Middleware\CheckMemberLogin')->name('blog.postComment');
    Route::get('','App\Http\Controllers\Front\BlogController@index')->name('blog.Show');
});


//Shop
Route::prefix('shop')->group(function () {
    Route::get('product/{id}','App\Http\Controllers\Front\ShopController@show')->name('shop.product');
    Route::post('product/{id}','App\Http\Controllers\Front\ShopController@postComment')->middleware('App\Http\Middleware\CheckMemberLogin')->name('shop.postComment');
    Route::get('','App\Http\Controllers\Front\ShopController@index')->name('shop.show');
    Route::get('{categoryName}','App\Http\Controllers\Front\ShopController@category');
    Route::get('like/{id}','App\Http\Controllers\Front\ProductLikesController@like')->middleware('App\Http\Middleware\CheckMemberLogin')->name('like');

});

Route::get('myFavourite','App\Http\Controllers\Front\ProductLikesController@index')->middleware('App\Http\Middleware\CheckMemberLogin')->name('like.index');


//Check cart
Route::prefix('cart')->group(function () {
    Route::get('add/{id}','App\Http\Controllers\Front\CartController@add')->name('cart.add');
    Route::post('add/{id}','App\Http\Controllers\Front\CartController@add')->name('cart.add');
    Route::get('delete/{id}','App\Http\Controllers\Front\CartController@delete')->name('cart.delete');
    Route::get('destroy','App\Http\Controllers\Front\CartController@destroy')->name('cart.destroy');
    Route::get('/','App\Http\Controllers\Front\CartController@index')->name('cart.show');
    Route::get('/update','App\Http\Controllers\Front\CartController@update')->name('cart.update');
});

//Check Order
Route::prefix('checkout')->middleware('App\Http\Middleware\CheckMemberLogin')->group(function () {
    Route::get('/','App\Http\Controllers\Front\CheckOutController@index')->name('checkout.show');
    Route::post('/','App\Http\Controllers\Front\CheckOutController@add')->name('checkout.add');
    Route::get('/vnPayCheck','App\Http\Controllers\Front\CheckOutController@vnPayCheck')->name('checkout.vnp');
    Route::get('/result','App\Http\Controllers\Front\CheckOutController@result')->name('checkout.result');
});

//Login
Route::prefix('home')->group(function () {
    Route::get('login', 'App\Http\Controllers\Front\AccountController@login')->name('login.show');
    Route::post('', 'App\Http\Controllers\Front\AccountController@checkLogin')->name('login.check');
    Route::get('logout', 'App\Http\Controllers\Front\AccountController@logout')->name('logout');
    Route::get('register', 'App\Http\Controllers\Front\AccountController@register')->name('register.show');
    Route::post('register', 'App\Http\Controllers\Front\AccountController@postRegister')->name('register.add');
    Route::get('forgot-password', 'App\Http\Controllers\Front\AccountController@forgotPassword')->name('forgot.show');
    Route::post('forgot-password', 'App\Http\Controllers\Front\AccountController@checkUser')->name('checkUser');
    Route::post('reset-password/{id}', 'App\Http\Controllers\Front\AccountController@checkReset')->name('reset');
    Route::get('reset-password/{id}', 'App\Http\Controllers\Front\AccountController@resetPassword')->name('resetPassword');

    Route::prefix('my_order')->middleware('CheckMemberLogin')->group(function (){
        Route::get('/','App\Http\Controllers\Front\AccountController@myOrderIndex')->name('myOrderIndex');
        Route::get('/{id}','App\Http\Controllers\Front\AccountController@myOrderShow')->name('myOrderShow');
    });


});

//Frontend end

//Admin begin
Route::prefix('admin')->middleware('App\Http\Middleware\CheckAdminLogin')->group(function (){

    Route::resource('user','App\Http\Controllers\Admin\UserController');
    Route::resource('category','App\Http\Controllers\Admin\ProductCategoryController');
    Route::resource('brand','App\Http\Controllers\Admin\BrandController');
    Route::resource('product/{product_id}/image','App\Http\Controllers\Admin\ProductImageController');
    Route::resource('product/{product_id}/detail','App\Http\Controllers\Admin\ProductDetailController');
    Route::resource('product','App\Http\Controllers\Admin\ProductController');
    Route::resource('order','App\Http\Controllers\Admin\OrderController');
    Route::resource('blog','App\Http\Controllers\Admin\BlogController');
    Route::resource('comment','App\Http\Controllers\Admin\CommentController');
    Route::resource('slider','App\Http\Controllers\Admin\SliderController');

    Route::post('product/search','App\Http\Controllers\Admin\ProductController@search')->name('product.search');

    Route::prefix('login')->group(function() {
        Route::get('','App\Http\Controllers\Admin\HomeController@getLogin')->withoutMiddleware('App\Http\Middleware\CheckAdminLogin')->name('admin.login');
        Route::post('','App\Http\Controllers\Admin\HomeController@postLogin')->withoutMiddleware('App\Http\Middleware\CheckAdminLogin')->name('admin.post');
    });

    Route::get('logout','App\Http\Controllers\Admin\HomeController@logout')->name('admin.logout');
    Route::get('dashboard','App\Http\Controllers\Admin\DashboardController@index')->name('dashboard');

    Route::get('contact','App\Http\Controllers\Admin\ContactController@index')->name('admin.contact');
    Route::post('contact/delete/{id}','App\Http\Controllers\Admin\ContactController@destroy')->name('admin.destroyContact');
    Route::get('contact/{id}','App\Http\Controllers\Admin\ContactController@show')->name('admin.showContact');
    Route::post('contact/post/{id}','App\Http\Controllers\Admin\ContactController@replyMessage')->name('admin.postMessage');
});
//Admin end

