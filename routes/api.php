<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntradaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("entradas/{id}", [EntradaController::class, "store"]);
Route::get("alumnos/uuid", [EntradaController::class, "asignarUUID"]);
Route::get("alumnos", [EntradaController::class, "obtenerAlumnos"]);
Route::get("grupos", [EntradaController::class, "obtenerGrupos"]);
