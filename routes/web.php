<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Models\Todo;
use App\Models\Category;

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

Route::get('/', [TodoController::class, 'index'])->name('home');
Route::post('todo', [TodoController::class, 'store'])->name('todo.store');
Route::delete('todo/{id}', [TodoController::class, 'destroy'])->name('todo.delete');