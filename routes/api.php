<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AdminAuthController;

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
// Route::middleware(['auth:admin'])->group(function(){
    Route::apiResource('/category', CategoryController::class);
    Route::apiResource('/jenis', JenisController::class);
    Route::apiResource('/menu', MenuController::class);
    Route::apiResource('/customer', CustomerController::class);
    Route::apiResource('/meja', MejaController::class);
    Route::apiResource('/stock', StockController::class);
// });
Route::apiResource('/user', UserController::class);
Route::post('/login', [AdminAuthController::class, 'login']);
