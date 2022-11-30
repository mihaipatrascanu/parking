<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ParkingController;
use App\Http\Controllers\Api\SpotController;
use App\Http\Controllers\Api\ReservationController;




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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Public Routes
Route::post('/user/register',[RegisterController::class,'register']);
Route::post('/user/login',[LoginController::class,'login']);

//Protected Routes
Route::group(['middleware'=>['auth:sanctum']], function () {
   
    Route::get('/parking', [ParkingController::class, 'index']);
    Route::get('/{parking}/spots', [SpotController::class, 'index']);
    Route::get('/{parking}/days', [SpotController::class, 'days']);
    Route::post('/reservation', [ReservationController::class, 'store']);
    //Route::patch('/reservation/{reservation}', [ReservationController::class, 'update']);
    Route::post('/reservation/{reservation}', [ReservationController::class, 'update']);
    Route::delete('/reservation/{reservation}', [ReservationController::class, 'delete']);

    Route::post('/user/logout', [UserController::class, 'logout']);
});