<?php

use App\Http\Controllers\PostController;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Support\Facades\Mail;
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

Route::get('/home', function () {
    return view('home');
});

if (app()->environment('local')) {
    Route::get('/playground', function () {
        $user = User::factory()->make();
        Mail::to($user->email)->send(new \App\Mail\WelcomeEmail($user));
        return 'Email sent';
    });
}