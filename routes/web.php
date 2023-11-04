<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource('task', TaskController::class)->except(['update']);
Route::post('/task/{id}', [TaskController::class, 'update'])->name('task.update');
Route::post('/task/change_status/{id}', [TaskController::class, 'changeStatus']);
Route::redirect('/', 'task');
