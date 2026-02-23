<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SauceController;
use App\Http\Controllers\SideController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

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

Route::get('/', [MenuController::class, 'home']);
Route::get('/app/{menu}/{id}', [MenuController::class, 'menu']);

Route::get('/change-dish-modal/{id}', [DishController::class, 'change_dish_view'])->name('change_dish_view');
Route::get('/change-select-view/{selected}', [DishController::class, 'change_select_view'])->name('change_select_view');

Route::middleware('auth')->group(function() {
    Route::middleware('role:toggler,editor')->group(function() {
        Route::get('/toggle/{id}/{type}', [AdminController::class, 'toggle'])->name('toggle'); // toggle dish

        Route::get('/dish-view', [DishController::class, 'dish_view'])->name('dish_view'); //
        Route::get('/category-view', [CategoryController::class, 'category_view'])->name('category_view');
        Route::get('/sauce-view', [SauceController::class, 'sauce_view'])->name('sauce_view');
        Route::get('/side-view', [SideController::class, 'side_view'])->name('side_view');
    });


    Route::middleware('role:editor')->group(function() {
        Route::post('/add-dish', [DishController::class, 'add_dish'])->name('add_dish');
        Route::post('/change-dish/{id}', [DishController::class, 'change_dish'])->name('change_dish');

        Route::post('/add-category', [CategoryController::class, 'add_category'])->name('add_category');
        Route::post('/change-category/{id}/{type}', [CategoryController::class, 'change_category'])->name('change_category');

        Route::post('/add-sauce', [SauceController::class, 'add_sauce'])->name('add_sauce');
        Route::post('/change-sauce/{id}', [SauceController::class, 'change_sauce'])->name('change_sauce');

        Route::post('/add-side', [SideController::class, 'add_side'])->name('add_side');
        Route::post('/change-side/{id}', [SideController::class, 'change_side'])->name('change_side');

        Route::get('/order-view/{type?}/{id?}', [OrderController::class, 'order_view'])->defaults('type', 'menu')->defaults('id', '0')->name('order_view');
        Route::post('/change-order', [OrderController::class, 'change_order'])->name('change_order');
    });


    Route::middleware('role:admin')->group(function() {
        Route::get('/destroy-dish/{id}', [DishController::class, 'destroy_dish'])->name('destroy_dish');
        Route::get('/duplicate-dish/{id}', [DishController::class, 'duplicate_dish'])->name('duplicate_dish');

        Route::get('/destroy-category/{id}/{type}', [CategoryController::class, 'destroy_category'])->name('destroy_category');
        Route::get('/duplicate-category/{id}/{type}', [CategoryController::class, 'duplicate_category'])->name('duplicate_category');

        Route::get('/destroy-sauce/{id}', [SauceController::class, 'destroy_sauce'])->name('destroy_sauce');

        Route::post('/side-info/{id}', [SideController::class, 'side_info'])->name('side_info');
        Route::get('/destroy-side/{id}', [SideController::class, 'destroy_side'])->name('destroy_side');

        Route::get('/settings', [SettingsController::class, 'settings'])->name('settings');
        Route::post('/save-settings', [SettingsController::class, 'save_settings'])->name('save_settings');

        Route::get('/users', [UserController::class, 'user_view'])->name('user_view');
        Route::post('/save_user/{id}', [UserController::class, 'save_user'])->name('save_user');
        Route::get('/destroy_user/{id}', [UserController::class, 'destroy_user'])->name('destroy_user');

        // Registration Routes...
        Route::get('register', [RegisterController::class , 'showRegistrationForm'])->name('register');
        Route::post('register', [RegisterController::class, 'register']);
    });
});

// Authentication Routes...
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/admin', function() {
    return redirect('/login');
});

Route::any('{req}', function($req) {
    $uri = $_SERVER['REQUEST_URI'];

    $path = strtok($uri, '?');

    $query = '';
    if(strpos($uri, '?') !== false){
        $after = substr($uri, strpos($uri, '?') + 1);
        if($after !== false){
            $query = $after;
        }
    }

    if(strtolower($path) !== $path){
        $redirectUri = strtolower($path);
        if(strlen($query) > 0)
            $redirectUri .= '?' . $query;

        return redirect(trim($redirectUri, '/'));
    }

    return response()->view('shared.error_404', [], 404);

})->where('req', '^.*');
