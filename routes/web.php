<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\FavoritesController;
use Illuminate\Support\Facades\URL;

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

if (env('APP_ENV') !== 'local') {
    URL::forceScheme('https');
}

Route::get('/', [FoodController::class, 'index'])->name('search');
Route::get('/result/{food_id}/index', [FoodController::class, 'result'])->name('result');

Route::get('/login', [AuthController::class, 'loginForm'])->name('auth.loginForm');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::get('/register', [RegistrationController::class, 'index'])->name('registration.index');
Route::post('/register', [RegistrationController::class, 'register'])->name('registration.create');

Route::get('/about', function() {return view('about');})->name('about');

Route::middleware(['custom-auth'])->group(function () {
    Route::view('/add_food', 'add_food')->name('food.add');
    Route::post('/search', [FoodController::class, 'store_food'])->name('food.store');
    Route::get('/result/{food_id}/edit', [FoodController::class, 'edit_food'])->name('food.edit');
    Route::get('/search/{food_id}/delete', [FoodController::class, 'delete_food'])->name('food.delete');
    Route::post('/result/{food_id}/update', [FoodController::class, 'update_food'])->name('food.update');

    Route::get('/result/{food_id}/add', [IngredientController::class, 'add_ingredient'])->name('ingredient.add');
    Route::post('/result/{food_id}', [IngredientController::class, 'store_ingredient'])->name('ingredient.store');
    Route::get('/result/{food_id}/{ing_id}/edit', [IngredientController::class, 'edit_ingredient'])->name('ingredient.edit');
    Route::get('/result/{food_id}/{ing_id}/delete', [IngredientController::class, 'delete_ingredient'])->name('ingredient.delete');
    Route::post('/result/{food_id}/{ing_id}', [IngredientController::class, 'update_ingredient'])->name('ingredient.update');

    Route::get('/favorites', [FavoritesController::class, 'index_favorites'])->name('favorites');
    Route::get('/favorites/{food_id}/remove', [FavoritesController::class, 'remove_favorites'])->name('favorites.remove');
    Route::get('/result/{food_id}/add-to-favorite', [FavoritesController::class, 'add_favorites'])->name('favorites.add');
});