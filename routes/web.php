<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('home', [ProfileController::class, 'home'])->name('home');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('dashboard', [ProfileController::class, 'dashboard'])->name('dashboard');
    Route::post('store_items', [ProfileController::class, 'store_items'])->name('store_items');
    Route::get('lunch', [ProfileController::class, 'lunch'])->name('lunch');
    Route::post('store_items2', [ProfileController::class, 'store_items2'])->name('store_items2');
    Route::get('dinner', [ProfileController::class, 'dinner'])->name('dinner');
    Route::post('store_items3', [ProfileController::class, 'store_items3'])->name('store_items3');
    Route::get('updatefood', [ProfileController::class, 'updatefood'])->name('updatefood');
    Route::post('update_breakfastitems', [ProfileController::class, 'update_breakfastitems'])->name('update_breakfastitems');
    Route::post('update_lunchitems', [ProfileController::class, 'update_lunchitems'])->name('update_lunchitems');
    Route::post('update_dinneritems', [ProfileController::class, 'update_dinneritems'])->name('update_dinneritems');
    
    
});
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');


require __DIR__.'/auth.php';

//admin//


Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth:admin', 'verified'])->name('admin.dashboard');


require __DIR__.'/adminauth.php';