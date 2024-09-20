<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

Route::name('comments.')
        ->group(function() {
            Route::get('comments', [CommentController::class, 'index'])->name('index');
            Route::get('comments/{post}', [CommentController::class, 'show'])->name('show');
            Route::post('comments', [CommentController::class, 'store'])->name('store');
            Route::put('comments/{post}', [CommentController::class, 'update'])->name('update');
            Route::delete('comments/{post}', [CommentController::class, 'delete'])->name('destroy');
});
