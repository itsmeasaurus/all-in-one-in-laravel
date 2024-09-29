<?php

use App\Helpers\Routes\RouteHelper;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::prefix('v1')
        ->group(function() {
            RouteHelper::loadRoutes(__DIR__ . '/api/v1');
        });

Route::get('/test', function() {
    return response()->json([
        'message' => 'Hello World'
    ]);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
?>
