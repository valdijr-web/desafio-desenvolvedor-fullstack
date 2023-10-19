<?php

use App\Http\Controllers\Api\SolicitaionController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
Route::get('users', [UserController::class, 'index'])->name('api.users.index');
Route::post('users', [UserController::class, 'store'])->name('users.store');
Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');


Route::delete('solicitations/{user}', [SolicitaionController::class, 'destroy'])->name('solicitations.destroy');
Route::get('solicitations/{user}', [SolicitaionController::class, 'show'])->name('solicitations.show');
Route::get('solicitations', [SolicitaionController::class, 'index'])->name('api.solicitations.index');
Route::get('solicitations', [SolicitaionController::class, 'getUserSolicitations'])->name('api.solicitations.getUserSolicitations');
Route::post('solicitations', [SolicitaionController::class, 'store'])->name('solicitations.store');
Route::put('solicitations/{user}', [SolicitaionController::class, 'update'])->name('solicitations.update');

