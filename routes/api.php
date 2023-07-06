<?php

use App\Http\Controllers\Api\AuthControllerUser;
use App\Http\Controllers\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


    Route::post('/register',[AuthControllerUser::class, 'register'])->name('register.user');
    Route::post('/logout', [AuthControllerUser::class, 'logout'])->name('logout.user');
    Route::post('/login', [AuthControllerUser::class, 'login'])->name('login.user');

    Route::middleware('auth:sanctum')->group(function () {
    //   رابط الـ profile
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::match(['put', 'patch'],'/users/{user}', [UserController::class, 'update'])->name('users.update');

})->middleware('throttle:api');
