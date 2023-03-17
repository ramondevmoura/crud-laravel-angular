<?php

use App\Http\Controllers\SpaceShipController;
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

Route::get('/spaceships', [SpaceShipController::class, 'index']);
Route::post('/spaceships/create', [SpaceShipController::class, 'create'])->name('spaceships.create');
Route::get('/spaceships/{id}', [SpaceShipController::class, 'show'])->name('spaceships.show');
Route::put('/spaceships/updatespace/{id}', [SpaceShipController::class, 'update'])->name('spaceships.update');
Route::delete('/spaceships/delete/{id}', [SpaceShipController::class, 'destroy'])->name('spaceships.delete');

