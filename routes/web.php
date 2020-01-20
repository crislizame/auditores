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
Route::get('/', 'Auth\LoginController@home');
Route::group(['prefix' => 'constructor'], function () {
    Voyager::routes();
});
Auth::routes();
Route::any('logout', 'Auth\LoginController@logout')->name('logout');

Route::middleware(['auth'])->group(function () {
    //--Rutas Menu
    //----Agenda
    Route::get('agenda/crear-agenda', 'Agenda\AgendaController@crearagenda')->name('agenda/crear-agenda');
    Route::get('agenda/ver-agenda', 'Agenda\AgendaController@veragenda')->name('agenda/ver-agenda');
    Route::get('agenda/reportes', 'Agenda\AgendaController@reportes')->name('agenda/reportes');
    Route::get('agenda/reportes-item', 'Agenda\AgendaController@reportesitem')->name('agenda/reportes-item');
    Route::get('imprimir/reportes-item', 'Agenda\AgendaController@imprimirreportesitem')->name('imprimir/reportes-item');
    Route::any('agenda/getimages', 'Agenda\AgendaController@getimages')->name('agenda/getimages');
    Route::get('imagen/{id}', 'Agenda\AgendaController@imagen');
    //----Comisionista
    Route::get('comisionista/listas', 'Admin\ComisionistasController@listas')->name('comisionista/listas');
    Route::get('comisionista', 'Admin\ComisionistasController@obtenertodos')->name('comisionista');
    //----EncuestasAuditorias
    Route::get('encaudit', 'Admin\EcnAuditoriasController@index')->name('encaudit');

    //----PDS
    Route::get('pds', 'PDS\PDSController@index')->name('pds');
    Route::post('pds/listas/ajax/cargarpds', 'PDS\PDSController@cargarpds')->name('cargarpds');
    //edit cris
    //----Auditores
    Route::get('auditores', 'Auditores\AuditoresController@index')->name('auditores');
    Route::post('auditores/listas/ajax/cargarauditores', 'Auditores\AuditoresController@cargarauditores')->name('cargarauditores');
    Route::post('auditor/listas/ajax/guardarAuditor', 'Auditores\AuditoresController@guardarAuditores')->name('auditor/listas/ajax/guardarAuditor');
    Route::post('auditor/listas/ajax/eliminarAuditor', 'Auditores\AuditoresController@eliminarAuditores')->name('auditor/listas/ajax/eliminarAuditor');
    Route::post('auditor/listas/ajax/mostrarAuditor', 'Auditores\AuditoresController@mostrarAuditores')->name('auditor/listas/ajax/mostrarAuditor');
    Route::post('auditor/listas/ajax/editarAuditor', 'Auditores\AuditoresController@editarAuditores')->name('auditor/listas/ajax/editarAuditor');
//editcrisfin
    //----Indicadores
    Route::any('indicadores', 'Admin\IndicadoresController@index')->name('indicadores');
    //--Rutas Ajax
    //---------Ajax Crear Agenda---------------//
    Route::post('agenda/crear/ajax/cargarpds', 'Agenda\AgendaController@cargarpds')->name('agenda/crear/ajax/cargarpds');
    Route::any('agenda/crear/ajax/cargarpdsnombres', 'Agenda\AgendaController@cargarpdsnombres')->name('agenda/crear/ajax/cargarpdsnombres');
    Route::post('agenda/crear/ajax/cargarauditores', 'Agenda\AgendaController@cargarauditores')->name('agenda/crear/ajax/cargarauditores');
    Route::post('agenda/crear/ajax/saveagenda', 'Agenda\AgendaController@saveagenda')->name('agenda/crear/ajax/saveagenda');
    Route::post('agenda/crear/ajax/cargarpdslista', 'Agenda\AgendaController@cargarpdslista')->name('agenda/crear/ajax/cargarpdslista');
    Route::post('agenda/crear/ajax/cargarauditlista', 'Agenda\AgendaController@cargarauditlista')->name('agenda/crear/ajax/cargarauditlista');
    Route::post('agenda/crear/ajax/npds', 'Agenda\AgendaController@npds')->name('agenda/crear/ajax/npds');
    //---------Ajax Ver Agenda---------------//
    Route::post('agenda/ver/ajax/cargarpdsxfecha', 'Agenda\AgendaController@cargarpdsxfecha')->name('agenda/ver/ajax/cargarpdsxfecha');
    Route::post('agenda/ver/ajax/cargarauditxfecha', 'Agenda\AgendaController@cargarauditxfecha')->name('agenda/ver/ajax/cargarauditxfecha');
    Route::post('agenda/ver/ajax/cargarfechas', 'Agenda\AgendaController@cargarfechas')->name('agenda/ver/ajax/cargarfechas');
    Route::post('agenda/ver/ajax/eliminaragenda', 'Agenda\AgendaController@eliminaragenda')->name('agenda/ver/ajax/eliminaragenda');
    Route::post('agenda/ver/ajax/editarpdsdeagenda', 'Agenda\AgendaController@editarpdsdeagenda')->name('agenda/ver/ajax/editarpdsdeagenda');
    Route::post('agenda/ver/ajax/editarauditdeagenda', 'Agenda\AgendaController@editarauditdeagenda')->name('agenda/ver/ajax/editarauditdeagenda');
    Route::post('agenda/ver/ajax/eliminarpdsdeagenda', 'Agenda\AgendaController@eliminarpdsdeagenda')->name('agenda/ver/ajax/eliminarpdsdeagenda');
    Route::post('agenda/ver/ajax/eliminarauditordeagenda', 'Agenda\AgendaController@eliminarauditordeagenda')->name('agenda/ver/ajax/eliminarauditordeagenda');
    //----------Ajax Cargar Ciudad-----------//
    Route::post('comisionista/listas/ajax/ciudadpds', 'Admin\ComisionistasController@ciudadpds')->name('comisionista/listas/ajax/ciudadpds');
    Route::post('comisionista/listas/ajax/cargarcomisionistas', 'Admin\ComisionistasController@cargarcomisionistas')->name('comisionista/listas/ajax/cargarcomisionistas');
    Route::post('comisionista/listas/ajax/mostrarComisionistas', 'Admin\ComisionistasController@mostrarComisionistas')->name('comisionista/listas/ajax/mostrarComisionistas');
    Route::post('comisionista/listas/ajax/editarComisionistas', 'Admin\ComisionistasController@editarComisionistas')->name('comisionista/listas/ajax/editarComisionistas');
    Route::post('comisionista/listas/ajax/guardarComisionistas', 'Admin\ComisionistasController@guardarComisionistas')->name('comisionista/listas/ajax/guardarComisionistas');
    Route::post('comisionista/listas/ajax/eliminarComisionistas', 'Admin\ComisionistasController@eliminarComisionistas')->name('comisionista/listas/ajax/eliminarComisionistas');
});
