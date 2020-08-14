<?php

use App\Carousel;
use App\Product;
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

Route::get('sign-in/github', 'Auth\LoginController@github')->name('login.github');
Route::get('sign-in/github/redirect', 'Auth\LoginController@githubRedirect');
Route::get('sign-in/google', 'Auth\LoginController@google')->name('login.google');;
Route::get('sign-in/google/redirect', 'Auth\LoginController@googleRedirect');
Route::get('sign-in/facebook', 'Auth\LoginController@facebook')->name('login.facebook');;
Route::get('sign-in/facebook/redirect', 'Auth\LoginController@facebookRedirect');
Auth::routes(['verify' => true]);


Route::get('/', function () {
  $carousels = Carousel::get();
  $products = Product::where([
    ['quantity', '>', '0'],
    'is_sold' => '1',
  ])->inRandomOrder()->take(9)->get();
  return view('index', compact('carousels', 'products'));
})->name('home');

Route::get('men/categories', 'MenController@getAllcategories')->name('men.getCategories');
Route::get('men/search', 'MenController@search')->name('men.search');
Route::resource('men', 'MenController');

Route::get('women/categories', 'WomenController@getAllcategories')->name('women.getCategories');
Route::get('women/search', 'WomenController@search')->name('women.search');
Route::resource('women', 'WomenController');

Route::get('product/categories/create', 'ProductController@createCategories')->name('product.categories.create');
Route::post('product/categories/create', 'ProductController@storeCategories')->name('product.categories.store');
Route::get('product/styles/create', 'ProductController@createStyles')->name('product.styles.create');
Route::post('product/styles/create', 'ProductController@storeStyles')->name('product.styles.store');
Route::get('product/create/{search}', 'ProductController@showSearch')->name('product.showSearch');
Route::resource('product', 'ProductController');


Route::get('purchase_list.{user_id}', 'PurchaseCartController@getPurchaseList')->name('purchase_list');
Route::resource('purchase_cart', 'PurchaseCartController');

Route::get('orders/success', 'OrdersController@success')->name('orders.success');
Route::get('orders/lists', 'OrdersController@getLists')->name('orders.lists');
Route::resource('orders', 'OrdersController');

Route::get('administrators/carousel', 'AdministratorsController@getCarousel')->name('administrators.getCarousel');
Route::post('administrators/carousel', 'AdministratorsController@setCarousel')->name('administrators.setCarousel');
Route::resource('administrators', 'AdministratorsController');

Route::resource('carousel', 'CarouselController');

Route::resource('about_me', 'AboutMeController');

Route::resource('news', 'NewsController');
