<?php

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

//Rutas de prueba
Route::get('/', function () {
    return view('welcome');
});

Route::get('/pruebas', function(){
    return '<h2>hola que hace</h2>';

});

Route::get('/pruebas/{nombre?}', function($nombre = null){
    $texto = '<h2>hola que hace</h2>';
    $texto .= 'Nombre:'.$nombre;

    return view('pruebas', array(
        'texto' => $texto
    ));
});


Route::get('/test-orm','PruebasController@testOrm');


//rutas de la api
Route::post('/api/register', 'UserController@register');
Route::post('/api/login', 'UserController@login');
Route::put('/api/user/update', 'UserController@update');
Route::post('/api/user/detail', 'UserController@detail');
Route::post('/api/ticket', 'TicketController@detailTicket');






