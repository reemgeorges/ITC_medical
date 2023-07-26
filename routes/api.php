<?php

use App\Http\Controllers\Api\AuthControllerDoctor;
use App\Http\Controllers\Api\AuthControllerUser;
use App\Http\Controllers\Booking\Booking_ClincController;
use App\Http\Controllers\Booking\Booking_LabController;
use App\Http\Controllers\Clinc\ClincController;
use App\Http\Controllers\item\itemController;
use App\Http\Controllers\lab\labController;
use App\Http\Controllers\User\UserController;
use App\Http\Resources\Booking_ClincCollection;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


    Route::post('/register',[AuthControllerUser::class, 'register'])->name('register.user');
    Route::post('/logout', [AuthControllerUser::class, 'logout'])->name('logout.user');
    Route::post('/login', [AuthControllerUser::class, 'login'])->name('login.user');
    Route::post('/loginDoctor', [AuthControllerDoctor::class, 'login'])->name('login.doctor');
    Route::post('/logoutDoctor', [AuthControllerDoctor::class, 'logout'])->name('logout.doctor');
    Route::post('/registerDoctor', [AuthControllerDoctor::class, 'register'])->name('register.doctor');



    Route::middleware('auth:sanctum')->group(function () {
    //   رابط الـ profile
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::match(['put', 'patch'  ,'post'],'/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::match(['delete', 'get'],'/deleted_user/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/items/Analysis', [itemController::class, 'getAnalysis'])->name('Analysis');

    Route::get('/items/Radiation', [itemController::class, 'getRadiation'])->name('Radiation');

    Route::get('/lab', [labController::class, 'getLab'])->name('getLab');

    Route::get('/clinc', [ClincController::class, 'getClinc'])->name('getClinc');

    Route::get('/clinics/{clinc}/doctors', [ClincController::class, 'getDoctorClinc']);

    Route::post('/booking-clinic', [Booking_ClincController::class, 'store']);


    Route::post('/booking-lab', [Booking_LabController::class, 'store']);

    Route::get('/bookings_clincs',[Booking_ClincController::class, 'index'])->name('bookings_clincs.index');

    Route::get('/bookings_labs', [Booking_LabController::class, 'index'])->name('bookings_labs.index');

    Route::match(['delete', 'get'],'/deleted_booking_lab/{booking_Lab}', [Booking_LabController::class, 'destroy'])->name('booking_lab.destroy');
    Route::match(['delete', 'get'],'/deleted_booking_clinc/{booking_Clinc}', [Booking_ClincController::class, 'destroy'])->name('booking_clinc.destroy');

})->middleware('throttle:api');
