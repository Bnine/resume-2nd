<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ContactController;


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
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::group([
    'prefix' => 'v1/auth'
], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::get('logout', [AuthController::class, 'logout'])->middleware('verifyjwt.mid');
    Route::get('me', [AuthController::class, 'me'])->middleware('verifyjwt.mid');
});

Route::group([
    'middleware' => ['verifyjwt.mid', 'setLocale'],
    'prefix' => 'v1/profile'
], function () {
    Route::get('/', [ProfileController::class, 'index']);
    Route::get('/projects', [ProjectController::class, 'index']);
});

Route::group([
    'middleware' => ['verifyjwt.mid', 'setLocale'],
    'prefix' => 'v1/contact'
], function () {
    Route::post('/sending-email', [ContactController::class, 'sendEmail']);
});
