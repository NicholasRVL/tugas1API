<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\JadwalController;
use App\Http\Controllers\API\TransportasiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/transportasi', [TransportasiController::class, 'index']);
Route::get('/transportasi/{id}', [TransportasiController::class, 'show']);
Route::post('/transportasi', [TransportasiController::class, 'store']);
Route::patch('/transportasi/{id}', [TransportasiController::class, 'update']);
Route::delete('/transportasi/{id}', [TransportasiController::class, 'destroy']);



Route::get('/jadwal', [JadwalController::class, 'index']);
Route::get('/jadwal/{id}', [JadwalController::class, 'show']);
Route::post('/jadwal', [JadwalController::class, 'store']);
Route::patch('/jadwal/{id}', [JadwalController::class, 'update']);
Route::delete('/jadwal/{id}', [JadwalController::class, 'destroy']);


Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'login']);

