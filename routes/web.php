<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::get('register', [AuthController::class, 'registerload'])->name('register');
Route::post('studentregister',[AuthController::class, 'studentregister'])->name('studentregister');
route::get('delete/{id}', [AuthController::class, 'delete'])->name('delete');
route::get('edit/{id}', [AuthController::class, 'edit'])->name('edit');
route::put('update/{id}', [AuthController::class, 'update'])->name('update');