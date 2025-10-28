<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobsController;
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

Route::get('/', HomeController::class)
    ->name('home');

Route::get('jobs/create', [JobsController::class, 'create'])
    ->name('jobs.create');

Route::post('jobs', [JobsController::class, 'store'])
    ->name('jobs.store');

Route::get('jobs', [JobsController::class, 'index'])
    ->name('jobs.index');

Route::get('jobs/{job}', [JobsController::class, 'edit'])
    ->name('jobs.edit');

Route::put('jobs/{job}', [JobsController::class, 'update'])
    ->name('jobs.update');
