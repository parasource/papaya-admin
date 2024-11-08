<?php

use App\Http\Controllers\Admin\AlertsController;
use App\Http\Controllers\Admin\ArticlesController;
use App\Http\Controllers\Admin\BrandsController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LooksController;
use App\Http\Controllers\Admin\ModerationController;
use App\Http\Controllers\Admin\PushController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\TopicsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\WardrobeCategoriesController;
use App\Http\Controllers\Admin\WardrobeController;
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
    'middleware' => ['auth'],
], function() {
    Route::get("/", [HomeController::class, 'index'])->name('index');

    Route::group([
        'prefix' => 'looks',
        'as' => 'looks.'
    ], function() {
        Route::resource('categories', CategoriesController::class)->middleware(['can:admin']);

        Route::get('/{look}/items-add', [LooksController::class, 'addItems'])->name('items-add');
        Route::post('/{look}/items-add/{item}', [LooksController::class, 'addItem'])->name('items.add');
        Route::post('/{look}/items-remove/{item}', [LooksController::class, 'removeItem'])->name('items.remove');
    });
    Route::resource("looks", LooksController::class);

    Route::group([
        'prefix' => 'brands',
        'as' => 'brands.',
        'middleware' => ['can:admin']
    ], function () {

    });
    Route::resource("brands", BrandsController::class)->middleware('can:admin');

    Route::group([
        'prefix' => 'topics',
        'as' => 'topics.'
    ], function () {
        Route::POST("/{topic}/remove-look/{look}", [TopicsController::class, 'removeLook'])->name('remove-look');
        Route::get("/{topic}/add-look", [TopicsController::class, 'addLook'])->name('add-look');
        Route::POST("/{topic}/add-look/{look}", [TopicsController::class, 'putLook'])->name('put-look');
    });
    Route::resource("topics", TopicsController::class);

    // Wardrobe
    Route::group([
        'prefix' => 'wardrobe-items',
        'as' => 'wardrobe-items.'
    ], function () {
        Route::post('/{item}/urls/{url}/remove', [WardrobeController::class, 'removeUrl'])->name('urls.remove');
        Route::get('/{item}/urls/add', [WardrobeController::class, 'addUrlView'])->name('urls.add');
        Route::post('/{item}/urls/add', [WardrobeController::class, 'addUrl'])->name('urls.add');
    });
    Route::resource("/wardrobe-items", WardrobeController::class)->parameters(['wardrobe-items' => 'item']);
    Route::resource('/wardrobe-categories', WardrobeCategoriesController::class)->middleware('can:admin');

    Route::resource('/settings', SettingsController::class)->middleware('can:admin');

    Route::resource("users", UsersController::class)->middleware('can:admin')->except(['create', 'store']);
    Route::resource("staff", StaffController::class)->middleware('can:admin')->parameters(['staff' => 'user']);

    Route::group([
        'prefix' => 'push',
        'as' => 'push.',
        'middleware' => ['can:admin']
    ], function () {
        Route::get('/', [PushController::class, 'index'])->name('index');
        Route::post('/broadcast', [PushController::class, 'broadcast'])->name('broadcast');
    });

    Route::resource('articles', ArticlesController::class)->middleware(['can:moderator']);

    Route::group([
        'prefix' => 'moderation-step-1',
        'as' => 'moderation-step-1.',
        'middleware' => ['can:moderator']
    ], function () {
        Route::get('/', [ModerationController::class, 'step1'])->name('index');
        Route::post('/{item}/approve', [ModerationController::class, 'step1Approve'])->name('approve');
        Route::post('/{item}/decline', [ModerationController::class, 'step1Decline'])->name('decline');

        Route::get('/approved', [ModerationController::class, 'step1Approved'])->name('approved');
    });

    Route::resource('alerts', AlertsController::class)
        ->middleware(['can:admin'])
        ->except(['edit', 'update', 'show']);
});
