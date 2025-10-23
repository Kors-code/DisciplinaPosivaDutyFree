<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\FormatoController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\EmpleadoController;

Route::get('/', function () {
    return redirect()->route('form.show');
});

Route::get('/form', [FormController::class, 'showForm'])->name('form.show');
Route::post('/form', [FormController::class, 'handleForm'])->name('form.submit');

// Ruta que genera el PDF (recibe POST desde el formulario)
Route::post('/generar-pdf', [FormatoController::class, 'generarPDF'])->name('formulario.pdf');


Route::get('/import-excel', [ExcelController::class, 'showForm'])->name('excel.form');

Route::post('/upload-excel', [EmpleadoController::class, 'importExcel'])->name('excel.import');

Route::get('/buscar-empleado/{cedula}', [EmpleadoController::class, 'buscarPorCedula'])
    ->name('empleado.buscar');
