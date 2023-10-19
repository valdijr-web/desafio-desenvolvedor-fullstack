<?php

use App\Http\Controllers\Api\SolicitationController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
Route::get('users', [UserController::class, 'index'])->name('api.users.index');
Route::post('users', [UserController::class, 'store'])->name('users.store');
Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');


Route::delete('solicitations/{solicitation}', [SolicitationController::class, 'destroy'])->name('solicitations.destroy');
Route::get('solicitations/{solicitation}', [SolicitationController::class, 'show'])->name('solicitations.show');
Route::get('solicitations', [SolicitationController::class, 'index'])->name('api.solicitations.index');
Route::get('solicitations/getUserSolicitations', [SolicitationController::class, 'getUserSolicitations'])->name('api.solicitations.getUserSolicitations');
Route::post('solicitations', [SolicitationController::class, 'store'])->name('solicitations.store');
Route::put('solicitations/{solicitation}', [SolicitationController::class, 'update'])->name('solicitations.update');

