<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//RUTAS PARA USUARIO (Autenticación)
Route::post('/authUser', 'App\Http\Controllers\UserController@authUser');
Route::post('/addUser', 'App\Http\Controllers\UserController@addUser');


//RUTAS PARA LOS ARCHIVOS
Route::post('/upFile', 'App\Http\Controllers\FileController@upFile');
Route::post('/deleteFile', 'App\Http\Controllers\FileController@deleteFile');