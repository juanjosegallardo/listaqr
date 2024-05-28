<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntradaController;

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

Route::get('/', function () {
    return view('qr');
}); 


Route::get("asistentes", [EntradaController::class, "mostrarAsistentes"]);
Route::get("faltantes", [EntradaController::class, "mostrarFaltantes"]);
Route::get("alumnos", [EntradaController::class, "mostrarAlumnos"]);
Route::get("grupos", [EntradaController::class, "mostrarGrupos" ]);
Route::get("grupos/{id}/asistentes", [EntradaController::class, "mostrarAsistentesGrupo" ]);
Route::get("grupos/{id}/faltantes", [EntradaController::class, "mostrarFaltantesGrupo" ]);


