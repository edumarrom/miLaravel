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
| Aquí están todas las rutas necesarias para controlar la tabla "depart".
| El orden de las rutas es importante (Programación defensiva). Por el
| momento ordenaré las rutas por aparición en su acrónimo CRUD:
| (CREATE, READ, UPDATE, DELETE)
|
*/

/* Create */
Route::get('/depart/create', [DepartController::class, 'create']);
Route::post('/depart', [DepartController::class, 'store'])
    ->name('depart.store');

/* Read */
Route::get('/depart', [DepartController::class, 'index']);

/* Update */
Route::get('/depart/{id}/edit', [DepartController::class, 'edit']);
Route::put('/depart/{id}', [DepartController::class, 'update'])
    ->name('depart.update');

/* Delete */
Route::delete('/depart/{id}', [DepartController::class, 'destroy']);

/*
|--------------------------------------------------------------------------
| Empleados
|--------------------------------------------------------------------------
|
| Aquí están todas las rutas necesarias para controlar la tabla "emple". El
| orden de las rutas es importante (Programación defensiva). Por el
| momento ordenaré las rutas por aparición en su acrónimo CRUD:
| (CREATE, READ, UPDATE, DELETE)
|
*/

/* Create */
Route::get('/emple/create', [EmpleController::class, 'create']);
Route::post('/emple', [EmpleController::class, 'store'])
    ->name('emple.store');

/* Read */
Route::get('/emple', [EmpleController::class, 'index']);

Route::get('/emple/{id}', [EmpleController::class, 'show'])->where('id', '[0-9]+');

/* Update */
Route::get('/emple/{id}/edit', [EmpleController::class, 'edit']);
Route::put('/emple/{id}', [EmpleController::class, 'update'])
    ->name('emple.update');

/* Delete */
Route::delete('/emple/{id}', [EmpleController::class, 'destroy']);


/*
- DONE! - GET /depart   => index (select global)
GET /depart/create => create (formulario en blanco para INSERT)
POST /depart  => store (graba la información)
 - EN PROCESO - GET /depart/{id} => show (select de una fila)
GET /depart/{id}/edit => edit (formalario para modificar una fila)
PUT/PATCH /depart/{id} => update (update de una fila)
- DONE! - DELETE /depart/{id} => destroy (delete de la fila)
*/
