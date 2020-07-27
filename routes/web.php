<?php

use App\Carousel;
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

Auth::routes();

Route::get('/', function () {
    $carousels = Carousel::get();
    return view('index', compact('carousels'));
})->name('home');

// Route::resource('men', 'MenController')->middleware('auth');
Route::get('men/tops/oxfords', 'MenController@showOxfords')->name('men.tops.oxfords');
Route::get('men/tops/businesses', 'MenController@showBusinesses')->name('men.tops.businesses');
Route::get('men/tops/casuals', 'MenController@showCasuals')->name('men.tops.casuals');
Route::get('men/categories', 'MenController@getAllcategories')->name('men.getCategories');
Route::resource('men', 'MenController');

// Route::resource('product', 'ProductController')->middleware('can:viewAny,App\Product');
Route::get('product/men/tops/create', 'ProductController@createMenTops')->name('product.men.tops.create');
Route::post('product/men/tops/create', 'ProductController@storeMenTops')->name('product.men.tops.store');
Route::resource('product', 'ProductController');

Route::get('purchase_list.{user_id}', 'PurchaseCartController@getPurchaseList')->name('purchase_list');
Route::resource('purchase_cart', 'PurchaseCartController');

Route::get('orders/success', 'OrdersController@success')->name('orders.success');
Route::get('orders/lists', 'OrdersController@getLists')->name('orders.lists');
Route::resource('orders', 'OrdersController');

Route::get('administrators/carousel', 'administratorsController@getCarousel')->name('administrators.getCarousel');
Route::post('administrators/carousel', 'administratorsController@setCarousel')->name('administrators.setCarousel');
Route::resource('administrators', 'administratorsController');

Route::resource('carousel', 'CarouselController');