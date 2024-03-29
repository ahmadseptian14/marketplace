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



Auth::routes();

// Client Side
Route::get('/', 'HomeController@index')->name('home');

Route::get('/categories', 'CategoryController@index')->name('categories');
Route::get('/categories/{id}', 'CategoryController@detail')->name('categories-detail');

Route::get('/details/{id}', 'DetailController@index')->name('details');
Route::post('/details/{id}', 'DetailController@add')->name('details-add');

Route::post('/checkout/callback', 'CheckoutController@callback')->name('midtrans-callback');

Route::get('/success', 'CartController@success')->name('success');

// Auth
Route::get('/register/success', 'Auth\RegisterController@success')->name('register-success');



Route::group(['middleware' => ['auth']], function () {
    Route::get('/cart', 'CartController@index')->name('cart');
    Route::post('/cart', 'CartController@submit');
    Route::get('/province/{id}/cities', 'CartController@getCities');


    // Alamat customer
    // Route::get('/alamat-customer', 'AlamatController@index')->name('alamat-customer.index');
    Route::get('/alamat-customer/create','AlamatController@create')->name('alamat-customer.create');
    Route::get('/getcity/{id}','AlamatController@getCity')->name('alamat-customer.getCity');
    Route::post('/simpan-alamat-customer', 'AlamatController@store')->name('alamat-customer.store');
    Route::get('/alamat/edit/{id}','AlamatController@edit')->name('alamat-customer.edit');
    Route::post('/alamat/update/{id}','AlamatController@update')->name('alamat-customer.update');

    Route::delete('/cart/{id}', 'CartController@delete')->name('cart-delete');

    Route::get('/checkout', 'CheckoutController@index')->name('checkout.index');
    Route::post('/checkout-store', 'CheckoutController@process')->name('checkout');

    Route::get('/history-transactions', 'TransactionsController@index')->name('history-transaction.index');
    Route::get('/history-transactions/detail/{id}', 'TransactionsController@show')->name('history-transaction.show');
    Route::post('/history-transactions/detail/{id}', 'TransactionsController@recieved')->name('history-transaction.recieved');

    // Dashboard
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    Route::get('/dashboard/products', 'DashboardProductController@index')->name('dashboard-products');
    Route::get('/dashboard/products/create', 'DashboardProductController@create')->name('dashboard-product-create');
    Route::post('/dashboard/products/create', 'DashboardProductController@store')->name('dashboard-product-store');
    Route::get('/dashboard/products/{id}', 'DashboardProductController@details')->name('dashboard-product-details');
    Route::post('/dashboard/products/{id}', 'DashboardProductController@update')->name('dashboard-product-update');
    Route::post('/dashboard/products/gallery/upload', 'DashboardProductController@uploadGallery')
        ->name('dashboard-product-gallery-upload');
    Route::get('/dashboard/products/gallery/delete/{id}', 'DashboardProductController@deleteGallery')
        ->name('dashboard-product-gallery-delete');


    Route::get('/dashboard/settings', 'DashboardSettingController@store')->name('dashboard-settings-store');
    Route::get('/alamat-customer', 'DashboardSettingController@account')->name('dashboard-settings-account');
    Route::get('/getcity/{id}','DashboardSettingController@getCity')->name('dashboard-settings.getCity');
    Route::post('/dashboard/account/{redirect}', 'DashboardSettingController@update')->name('dashboard-settings-redirect');
    Route::post('/dashboard/account', 'DashboardSettingController@updatePhoto')->name('dashboard-settings-photo');


    // review
    Route::get('/ulasan-produk', 'ReviewController@index')->name('review.index');
    Route::post('/review-post', 'ReviewController@store')->name('review.store');
});


Route::prefix('admin')
    ->namespace('Admin')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/', 'DashboardController@index')->name('admin-dashboard');
        Route::resource('category', 'CategoryController');
        Route::resource('user', 'UserController');
        Route::resource('product', 'ProductController');
        Route::resource('product-gallery', 'ProductGalleryController');

        // Discount
        Route::get('/product-discount', 'ProductController@discount')->name('product-discount.index');
        Route::get('/add-discount/{id}', 'ProductController@add_discount')->name('product-discount.add');
        Route::put('/update-discount/{id}', 'ProductController@update_discount')->name('product-discount.update');

        // Alamat
        Route::get('/alamat-toko', 'AlamatTokoController@index')->name('alamat-toko.index');
        Route::get('/getcity/{id}','AlamatTokoController@getCity')->name('alamat-toko.getCity');
        Route::post('/simpan-alamat-toko', 'AlamatTokoController@store')->name('alamat-toko.store');
        Route::get('/alamat-toko/edit/{id}','AlamatTokoController@edit')->name('alamat-toko.edit');
        Route::post('/alamat-toko/update/{id}','AlamatTokoController@update')->name('alamat-toko.update');


        // Transaksi
        Route::get('/transactions', 'DashboardTransactionController@index')->name('dashboard-transactions');
        Route::get('/transactions/{id}', 'DashboardTransactionController@details')->name('dashboard-transaction-details');
        Route::post('/transactions/{id}', 'DashboardTransactionController@update')->name('dashboard-transaction-update');
    });
