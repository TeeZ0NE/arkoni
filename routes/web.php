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

Route::get('/', function () {
    // return session('mykey');
    return View::make('welcome');
});
//TODO: Remove this route
Route::get('some{id?}{ram?}', function (Request $request) {
    echo 'request '.$request->input('id');
    // echo '<br>'.$request->input('ram','default');
    // print_r($request->all());
    // echo "/n/r\n\r\t".$request->query('ram','defA').PHP_EOL.'<br>';
    if ($request->exists('ram')) {
        echo "<br>_ram=".$request->ram.'<br>';
        if (isset(json_decode($request->ram)->k2)) {
            echo "<p>".json_decode($request->ram)->k2."</p>";
        } else {
            echo '<p>not set k2</p>';
        };
    }
    foreach ($request->all() as $key => $value) {
        echo $key.'=='.$value;
    }
    Cookie::queue('nameKey', 'Myvalue2', 2);
    echo ($request->session()->exists('mykey'))?'key is '.session('mykey'):'hasnt key';
    echo '<br>name='.$request->cookie('name');
    $request->flash();
    echo '<br> old name is='.$request->old('name').'<br>';
    //return response('Hello World', 200)->header('Content-Type', 'text/plain');
    session(['mykey'=>'som V2']);
    // print_r($request->session()->all());
    echo ($request->session()->has('mykey'))?'key is '.session('mykey'):'hasnt key';
    // Log::info('some info appear here',["messag"=>"ohoho"]);
})->middleware('auth');


Auth::routes();
// Logining Admin(s)
Route::get('/home', 'HomeController@index')->name('home');




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
    Route::prefix('/categories')->group(function () {
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

Route::prefix('site')->group(function () {
    Route::get('/', 'SiteController@index')->name('site.index');
});
