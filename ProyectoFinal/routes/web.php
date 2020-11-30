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

Route::group(['middleware' => 'auth:usuario_interno'], function(){
    //USUARIO INTERNO
    Route::get('/inicio', 'PacientesController@index')
        ->name('inicio_usuario_interno');

    Route::post('/buscarNombrePaciente', 'PacientesController@buscarNombre')
        ->name('buscarNombrePaciente');

    Route::get('/pacientes', 'PacientesController@create')
        ->name('pacientes');

    Route::post('/pacientes', 'PacientesController@store')
        ->name('registrar_paciente');

    Route::get('/asignacion', 'RelacionesUsuariosExternosConPacientesController@create')
        ->name('crear_una_asignacion');

    Route::post('/asignacion', 'RelacionesUsuariosExternosConPacientesController@buscarPacientePorNombreFecha')
        ->name('buscar_paciente_asignacion');

    Route::post('/asignacionUE', 'RelacionesUsuariosExternosConPacientesController@buscarUsuarioExterno')
        ->name('buscar_usuario_externo');

    Route::get('/asignaciones', 'RelacionesUsuariosExternosConPacientesController@index')
        ->name('ver_asignaciones');

    Route::post('/asignacionesBuscarPaciente', 'RelacionesUsuariosExternosConPacientesController@buscarAsignacionesPorPaciente')
        ->name('buscar_paciente_asignaciones');

    Route::post('/asignaciones', 'RelacionesUsuariosExternosConPacientesController@store')
        ->name('asignacion_creada');

    Route::delete('/asignaciones/{id}', 'RelacionesUsuariosExternosConPacientesController@destroy')
        ->name('borrar_asignacion');

    Route::get('/notificacionesPaciente/{id}', 'PacientesController@notificacionesPorPaciente')
        ->name('ver_notificaciones_paciente');

    Route::delete('/borrarNotifiacion/{id}', 'NotificacionesController@destroy')
        ->name('borrar_notificacion');

    Route::get('/actualizarNotificacion/{id}', 'NotificacionesController@edit')
        ->name('actualizar_notificacion');

    Route::put('/actualizarNotificacion/{id}', 'NotificacionesController@update')
        ->name('notificacion_actualizada');

    Route::get('/crearNotificacion/{id}', 'PacientesController@crearNotificacion')
        ->name('crear_notificacion');

    Route::post('/crearNotificacion', 'NotificacionesController@store')
        ->name('notificacion_creada');

    Route::get('/alta_o_defuncion/{id}','PacientesController@alta_o_baja')
        ->name('alta_o_defuncion_del_paciente');

    Route::post('/alta_o_defuncion/{id}','PacientesController@alta_o_baja_guardar')
        ->name('alta_o_defuncion_del_paciente_guardar');

    Route::get('/registrarUsuarioInterno', 'UsuarioInternoController@create')
        ->name('registrar_usuario_interno');

    Route::post('/registrarUsuarioInterno','UsuarioInternoController@store')
        ->name('usuario_interno_registrado');
});

Route::group(['middleware' => 'auth:usuario_externo'], function(){
    //USUARIO EXTERNO
    Route::get('/notificaciones','NotificacionesController@index')
        ->name('inicio_usuario_externo');

    Route::post('/notificaciones','NotificacionesController@marcarComoLeidos')
        ->name('marcar_notificaciones_vistas');

    Route::get('/verNotificacion/{id}', 'NotificacionesController@show')
        ->name('ver_notificacion_usuario_externo');
});

Route::get('/', 'UsuariosExternosController@paginaInicio')
    ->name('inicio_usuarios');

//USUARIO INTERNO
Route::get('/loginInterno', 'UsuarioInternoController@loginForm')
    ->name('login_usuario_interno');

Route::post('/loginInterno', 'UsuarioInternoController@login')
    ->name('logear_usuario_interno');

Route::get('/logoutUI', 'UsuarioInternoController@logout')
    ->name('logout_usuario_interno');

//USUARIO EXTERNO
Route::get('/loginExterno', 'UsuariosExternosController@loginForm')
    ->name('login_usuario_externo');

Route::post('/loginExterno', 'UsuariosExternosController@login')
    ->name('logear_usuario_externo');

Route::get('/registro', 'UsuariosExternosController@create')
    ->name('registro');

Route::post('/registro', 'UsuariosExternosController@store')
    ->name('registrar_usuario_externo');

Route::get('/logout', 'UsuariosExternosController@logout')
    ->name('logout_usuario_externo');
