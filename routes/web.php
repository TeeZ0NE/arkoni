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
    Route::get('/', 'Admin\AdminController@index')->name('admin.dashboard');
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
    Route::prefix('/categories')->group(function () {
        Route::get('/', 'Admin\CategoryController@index')->name('cats.index');
        Route::get('/delete/{cat}', 'Admin\CategoryController@destroy')->name('cat.destroy');
        Route::get('/{id}/edit', 'Admin\CategoryController@edit')->name('cat.edit');
        Route::group(['middleware' => ['purify']], function () {
            Route::get('/create', 'Admin\CategoryController@create')->name('cats.create');
            Route::get('/query', 'Admin\CategoryController@search')->name('cats.search');
            Route::post('/update', 'Admin\CategoryController@update')->name('cat.update');
            Route::post('/store', 'Admin\CategoryController@store')->name('cat.store');
        });
    });

    // SubCategory
    Route::group(['middleware' => ['purify']], function () {
        Route::get('subcategory/query', 'Admin\SubCategoryController@search')->name('subcategory.search');
        Route::resource('subcategory', 'Admin\SubCategoryController');
    });
    // Brands
    Route::prefix('/brands')->group(function () {
        Route::get('/', 'Admin\BrandController@index')->name('brands');

        Route::group(['middleware' => ['purify']], function () {
            Route::get('/query', 'Admin\BrandController@search')->name('brands.search');
            Route::post('/', 'Admin\BrandController@store')->name('brand.store');
            Route::post('/update', 'Admin\BrandController@update')->name('brand.update');
        });
        Route::get('/delete/{id}', 'Admin\BrandController@delete')->name('brand.delete');
    });

    // Attributes
    Route::prefix('/attributes')->group(function () {
        Route::get('/', 'Admin\AttributesController@index')->name('attrs');
        Route::group(['middleware' => ['purify']], function () {
            Route::get('/query', 'Admin\AttributesController@search')->name('attrs.search');
            Route::post('/', 'Admin\AttributesController@store')->name('attr.store');
            Route::post('/update', 'Admin\AttributesController@update')->name('attr.update');
        });
        Route::get('/delete/{id}', 'Admin\AttributesController@delete')->name('attr.delete');
    });
    // Items
    Route::get('items/query', 'Admin\ItemsController@search')->name('items.search');
    Route::resource('items', 'Admin\ItemsController');

    // Reviews
// Users
});

//site route
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Route::get('/', 'Site\SiteController@front')->name('home');
        Route::get('/catalog', 'Site\CSPController@catalog')->name('catalog');
        Route::get('/c-{name}', 'Site\CSPController@category')->name('category');
        Route::get('/s-{name}', 'Site\CSPController@sub_category')->name('sub-category');
        Route::get('/p-{name}', 'Site\CSPController@product')->name('product');
        Route::get('/stars', 'Site\StarsController@index');
        Route::get('/blog', 'Site\BlogController@index')->name('blog');
        Route::get('/b-{name}', 'Site\BlogController@inside')->name('blog-inside');
        Route::get('/contacts', 'Site\SiteController@contacts')->name('contacts');
    });

Route::get('info', function () {
    phpinfo();
});
