<?php

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
/*rutas de usuario ---------------------------------------------------*/
Route::get('/','App\Http\Controllers\UserController@index');
Route::get('/login','App\Http\Controllers\UserController@show');
Route::get('/newUser','App\Http\Controllers\UserController@create');
session_start();
if(isset($_SESSION['data'])){
    Route::get('/usuario','App\Http\Controllers\UserController@load');
}else{
    Route::post('/usuario','App\Http\Controllers\UserController@beginning');
}
Route::get('/home','App\Http\Controllers\UserController@close');
Route::post('/newUser/create','App\Http\Controllers\UserController@store');
/*------------------------------------------------------------------------*/
Route::post('/registro','App\Http\Controllers\RegistroController@store');
