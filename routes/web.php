<?php

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// URL::forceScheme('https');
//Illuminate\Routing\UrlGenerator::forceSchema('https');
//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');

Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['auth'])->name('home');

//Route::get('/category', function () {
//    return view('category');
//})->name('category');

require __DIR__ . '/auth.php';

Route::prefix('orders')->namespace('App\Http\Controllers')->name('orders/')->group(static function () {
    Route::get('/{orderIndex}', 'OrderController@view')->name('view');
    Route::get('/', 'OrderController@index')->name('index');
});

Route::prefix('category')->namespace('App\Http\Controllers')->name('category/')->group(static function () {
    Route::get('/{categoryIndex}/page/{indexPage}', 'CategoryController@view')->name('view');
    Route::get('/{categoryIndex}', 'CategoryController@view')->name('view');
    Route::get('/', 'CategoryController@index')->name('index');
});

Route::prefix('product')->namespace('App\Http\Controllers')->name('product/')->group(static function () {
    Route::get('/', 'HomeController@index')->name('index');
    Route::get('/{productIndex}', 'ProductController@view')->name('view');
});

Route::prefix('cart')->namespace('App\Http\Controllers')->name('cart/')->group(static function () {
    Route::get('/', 'CartController@index')->name('index');
    Route::get('/add/{productIndex}', 'CartController@add')->name('add');
    Route::get('/clear', 'CartController@clear')->name('clear');
    Route::get('/getcount', 'CartController@getCount')->name('getcount');
    Route::post('/add_order', 'CartController@addOrder')->name('addorder');
    Route::get('/delete/{productIndex}', 'CartController@delete')->name('delete');
});

Route::get('/news', function () {
    return view('news');
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function () {
        Route::prefix('admin-users')->name('admin-users/')->group(static function () {
            Route::get('/', 'AdminUsersController@index')->name('index');
            Route::get('/create', 'AdminUsersController@create')->name('create');
            Route::post('/', 'AdminUsersController@store')->name('store');
            Route::get('/{adminUser}/impersonal-login', 'AdminUsersController@impersonalLogin')->name('impersonal-login');
            Route::get('/{adminUser}/edit', 'AdminUsersController@edit')->name('edit');
            Route::post('/{adminUser}', 'AdminUsersController@update')->name('update');
            Route::delete('/{adminUser}', 'AdminUsersController@destroy')->name('destroy');
            Route::get('/{adminUser}/resend-activation', 'AdminUsersController@resendActivationEmail')->name('resendActivationEmail');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function () {
        Route::get('/profile', 'ProfileController@editProfile')->name('edit-profile');
        Route::post('/profile', 'ProfileController@updateProfile')->name('update-profile');
        Route::get('/password', 'ProfileController@editPassword')->name('edit-password');
        Route::post('/password', 'ProfileController@updatePassword')->name('update-password');
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function () {
        Route::prefix('category')->name('category/')->group(static function () {
            Route::get('/', 'CategoryController@index')->name('index');
            Route::get('/create', 'CategoryController@create')->name('create');
            Route::post('/', 'CategoryController@store')->name('store');
            Route::get('/{category}/edit', 'CategoryController@edit')->name('edit');
            Route::post('/bulk-destroy', 'CategoryController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{category}', 'CategoryController@update')->name('update');
            Route::delete('/{category}', 'CategoryController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function () {
        Route::prefix('products')->name('products/')->group(static function () {
            Route::get('/', 'ProductsController@index')->name('index');
            Route::get('/create', 'ProductsController@create')->name('create');
            Route::post('/', 'ProductsController@store')->name('store');
            Route::get('/{product}/edit', 'ProductsController@edit')->name('edit');
            Route::post('/bulk-destroy', 'ProductsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{product}', 'ProductsController@update')->name('update');
            Route::delete('/{product}', 'ProductsController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function () {
        Route::prefix('orders')->name('orders/')->group(static function () {
            Route::get('/', 'OrdersController@index')->name('index');
            Route::get('/create', 'OrdersController@create')->name('create');
            Route::post('/', 'OrdersController@store')->name('store');
            Route::get('/{order}/edit', 'OrdersController@edit')->name('edit');
            Route::post('/bulk-destroy', 'OrdersController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{order}', 'OrdersController@update')->name('update');
            Route::delete('/{order}', 'OrdersController@destroy')->name('destroy');
        });
    });
});

Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->group(static function () {
        Route::prefix('settings')->name('settings.')->group(static function () {
            Route::get('/', 'SettingsController@index')->name('setting.index');
            Route::post('/store', 'SettingsController@store')->name('setting.store');
        });
    });
});

Route::namespace('App\Http\Controllers')->name('home/')->group(static function () {
    Route::get('/', 'HomeController@index')->name('home.index');
    Route::get('/logout', 'HomeController@logout')->name('home.logout');
    Route::get('/page/{indexPage}', 'HomeController@index')->name('home.index');
});
