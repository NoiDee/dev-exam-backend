<?php

use App\Models\ApiResponse;
use App\Http\Controllers\ApiResponseController;
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

// Route::resource('response', ApiResponseController::class);
Route::get('response', [ApiResponseController::class, 'index'])->name('response.index');
Route::post('response', [ApiResponseController::class, 'fromThirdparty'])->name('response.new');