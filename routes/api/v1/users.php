<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::name('users.')
        ->group(function() {
            Route::get('users', [UserController::class, 'index'])->name('index');
            Route::get('users/{user}', [UserController::class, 'show'])->name('show');
            Route::post('users', [UserController::class, 'store'])->name('store');
            Route::put('users/{user}', [UserController::class, 'update'])->name('update');
            Route::delete('users/{user}', [UserController::class, 'delete'])->name('destroy');
});