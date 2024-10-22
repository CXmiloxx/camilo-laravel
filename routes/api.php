<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerCliente;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/usuarios', [App\Http\Controllers\UsuarioController::class, 'index']);
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);
Route::get('/clientes', [ControllerCliente::class, 'lista']);
Route::post('/registrarCliente', [ControllerCliente::class, 'registrarClientes']);
Route::put('/actualizarCliente/{id}', [ControllerCliente::class, 'editar']);
Route::patch('/actualizarCliente/{id}', [ControllerCliente::class, 'editarEspecifico']);
Route::delete('/eliminarCliente/{id}', [ControllerCliente::class, 'eliminar']);





