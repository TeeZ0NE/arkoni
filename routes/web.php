<?php
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




Auth::routes();
// Logining Admin(s)
//Route::get('/home', 'HomeController@index')->name('home');




Route::prefix('admin')->group(function () {
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::get('/login', 'Auth\AdminloginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminloginController@login')->name('admin.login.submit');
    // Restoring (resseting) Admin passwords
    Route::prefix('/password')->group(function () {
        Route::post('/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
        Route::get('/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
        Route::post('/reset', 'Auth\AdminResetPasswordController@reset');
        Route::get('/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.resset');
    });
    // Categories
    Route::prefix('/categories')->group(/**
     *
     */
        function () {
        Route::get('/', 'CategoriesController@index')->name('cats');

        Route::group(['middleware'=>['purify']], function () {
            Route::get('/query', 'CategoriesController@search')->name('cats.search');
            Route::post('/', 'CategoriesController@store')->name('cat.store');
            Route::post('/renname/query', 'CategoriesController@update')->name('cat.update');
        });

        Route::get('/delete/{id}', 'CategoriesController@delete')->name('cat.delete');
    });
    // Brands
    Route::prefix('/brands')->group(function () {
        Route::get('/', 'BrandsController@index')->name('brands');

        Route::group(['middleware'=>['purify']], function () {
            Route::get('/query', 'BrandsController@search')->name('brands.search');
            Route::post('/', 'BrandsController@store')->name('brand.store');
            Route::get('/renname/query', 'BrandsController@update')->name('brand.update');
        });

        Route::get('/delete/{id}', 'BrandsController@delete')->name('brand.delete');
    });

    // Attributes
    Route::prefix('/attributes')->group(function () {
        Route::get('/', 'AttributesController@index')->name('attrs');

        Route::group(['middleware'=>['purify']], function () {
            Route::get('/query', 'AttributesController@search')->name('attrs.search');
            Route::post('/', 'AttributesController@store')->name('attr.store');
            Route::get('/renname/query', 'AttributesController@update')->name('attr.update');
        });

        Route::get('/delete/{id}', 'AttributesController@delete')->name('attr.delete');
    });
    // Items
    Route::get('items/query', 'ItemsController@search')->name('items.search');
    Route::resource('items', 'ItemsController');

    // Reviews
// Users
});

//site route
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ],
    function()
    {
        Route::get('/', 'Site\SiteController@front')->name('home');

        Route::get('/catalog', 'Site\CSPController@catalog')->name('catalog');
        Route::get('/c-{name}', 'Site\CSPController@category')->name('category');
        Route::get('/s-{name}', 'Site\CSPController@sub_category')->name('sub-category');
        Route::get('/p-{name}', 'Site\CSPController@product')->name('product');

        Route::get('/stars', 'Site\StarsController@index');
    });

