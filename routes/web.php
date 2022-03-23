<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LooksController;
use App\Http\Controllers\Admin\TopicsController;
use App\Http\Controllers\Admin\UsersController;
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

Route::get('/', function () {
    return redirect()->route("admin.index");
});

Auth::routes();

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => ['auth']
], function() {

    Route::get("/", [HomeController::class, 'index'])->name('index');

    Route::resource("looks", LooksController::class);
    Route::group([
        'prefix' => 'looks',
        'as' => 'looks.'
    ], function() {

        Route::group([
            'prefix' => 'categories',
            'as' => 'categories.'
        ], function() {

            Route::get("/", [])->name('index');
        });

//        Route::get("/", [LooksController::class, 'index'])->name('index');
//        Route::resource("", LooksController::class);

    });


    Route::resource("topics", TopicsController::class);
    Route::group([
        'prefix' => 'topics',
        'as' => 'topics.'
    ], function() {

        Route::POST("/{topic}/remove-look/{look}", [TopicsController::class, 'removeLook'])->name('remove-look');
        Route::get("/{topic}/add-look", [TopicsController::class, 'addLook'])->name('add-look');
        Route::POST("/{topic}/add-look/{look}", [TopicsController::class, 'putLook'])->name('put-look');

//        Route::get("/", [LooksController::class, 'index'])->name('index');
//        Route::resource("", LooksController::class);

    });

    Route::resource("/users", UsersController::class);

});
