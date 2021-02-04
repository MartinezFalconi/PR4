<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserAdminController;
use App\Http\Controllers\UserStandardController;
use App\Http\Controllers\RestaurantController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

//Ruta para redirigir al Login
Route::get('/', [SessionController::class, 'login']);
//Ruta para recojer los datos de inicio del Login
Route::post('requestLogin', [SessionController::class, 'requestLogin']);
Route::get('homeAdmin', function(){return view('homeAdmin');});
Route::get('homeStandard', function(){return view('homeStandard');});



//Ruta para volver al Inicio cuando ya estas logeado
Route::post('requestStart', [SessionController::class, 'requestStart']);
// Ruta para cerrar la sesion
Route::get('logout', [SessionController::class, 'logout']);
//Ruta para mostrar los restaurantes, con AJAX
Route::post('read', [RestaurantController::class, 'read']);
//Ruta para mostrar los filtros, con AJAX
Route::post('filters', [RestaurantController::class, 'filters']);
//Ruta para requistrar nuevos restaurantes
Route::get('register', [SessionController::class, 'register']);
//Ruta al formulario de registro de usuarios
Route::get('registroUser',[UserAdminController::class, 'registroUser']);
//Ruta para crear el nuevo usuario
Route::post('generarUser',[UserAdminController::class, 'generarUser']);
//crea el json con los datos de los restaurantes para poder mostrar en admin
Route::post('readadmin',[UserAdminController::class, 'readadmin']);
// Ruta a la funcion borrar para borrar el restuarante
Route::post('deleteRestaurant', [RestaurantController::class, 'deleteRestaurant']);
// Ruta a la funcion actualizar el restaurante
Route::get('actualizar/{id}',[RestaurantController::class, 'actualizar']);
Route::get('modificar/{id}',[RestaurantController::class, 'modificar']);

Route::get('registroRestaurante',[RestaurantController::class, 'registroRestaurante']);

Route::post('generarRestaurante',[RestaurantController::class, 'generarRestaurante']);

//Ruta a la funcion valiadar, para registrar la opininon del usuario
Route::get('validar',[RestaurantController::class , 'validar']);

Route::get('opinar/{id}',[RestaurantController::class, 'opinar']);
