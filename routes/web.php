<?php

use App\Http\Controllers\FeltoltoController;
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

Route::get('/', [FeltoltoController::class, 'list']);
Route::get('/kezdolap', [FeltoltoController::class, 'kezdolap']);
Route::get('/leker/{meid}', [FeltoltoController::class, 'leker']);
Route::post('/szerkeszt', [FeltoltoController::class, 'edit']);
Route::post('/torol', [FeltoltoController::class, 'delete']);
Route::post('/ment', [FeltoltoController::class, 'save']);
