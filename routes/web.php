<?php

use App\Http\Controllers\DepartController;
use App\Http\Controllers\EmpleController;
use Illuminate\Support\Facades\Route;

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

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', function() {
    return view('home');
});

/*
|--------------------------------------------------------------------------
| Departamentos
|--------------------------------------------------------------------------
*/

Route::get('/depart', [DepartController::class, 'index']);
Route::delete('/depart/{id}', [DepartController::class, 'destroy']);

/*
|--------------------------------------------------------------------------
| Empleados
|--------------------------------------------------------------------------
*/

Route::get('/emple', [EmpleController::class, 'index']);
Route::get('/emple/{id}', [EmpleController::class, 'show'])->where('id', '[0-9]+');
Route::delete('/emple/{id}', [EmpleController::class, 'destroy']);
