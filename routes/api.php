<?php

use App\Http\Controllers\api\GameController;
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


Route::get('expectedGames',[GameController::class,'expectedGames']);
Route::get('monthly',[GameController::class,'monthly']);
Route::get('all',[GameController::class,'gamersAllStatistics']);
Route::get('allDays',[GameController::class,'allDays']);
Route::get('teamrating',[GameController::class,'dayTeams']);

