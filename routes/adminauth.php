<?php

use App\Http\Controllers\AdminAuth\AuthenticatedSessionController;
use App\Http\Controllers\AdminAuth\AdminDashboardController;
use App\Http\Controllers\AdminAuth\ConfirmablePasswordController;
use App\Http\Controllers\AdminAuth\PasswordController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>['guest:admin'],'prefix'=>'admin','as'=>'admin.'],function(){

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

});

Route::group(['middleware'=>['auth:admin'],'prefix'=>'admin','as'=>'admin.'],function() {

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');

    Route::get('newusers', [AdminDashboardController::class, 'newusers'])
                ->name('newusers');

    Route::post('deleteusers',[AdminDashboardController::class,'deleteusers'])
                ->name('deleteusers');
    Route::get('foodlist',[AdminDashboardController::class,'foodlist'])
                ->name('foodlist');
});
