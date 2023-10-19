<?php

use App\Http\Controllers\Web\SolicitationController;
use App\Http\Controllers\Web\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route::resource('users', UserController::class);
Route::get('users/create', [UserController::class, 'create'])->name('users.create');
Route::get('users', [UserController::class, 'index'])->name('users.index');
Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');

Route::get('solicitations/create', [SolicitationController::class, 'create'])->name('solicitations.create');
Route::get('solicitations', [SolicitationController::class, 'index'])->name('solicitations.index');
Route::get('solicitations/{solicitation}/edit', [SolicitationController::class, 'edit'])->name('solicitations.edit');
