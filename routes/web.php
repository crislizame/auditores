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

Route::get('imprimir/reportes-item', 'Agenda\AgendaController@imprimirreportesitem')->name('imprimir/reportes-item');
Route::any('agenda/getimages', 'Agenda\AgendaController@getimages')->name('agenda/getimages');
Route::get('imagen/{id}', 'Agenda\AgendaController@imagen');

Route::middleware(['auth'])->group(function () {

    // Agenda
    Route::get('agenda/crear-agenda', 'Agenda\AgendaController@crearagenda')->name('agenda/crear-agenda');
    Route::get('agenda/ver-agenda', 'Agenda\AgendaController@veragenda')->name('agenda/ver-agenda');
    Route::get('agenda/reportes', 'Agenda\AgendaController@reportes')->name('agenda/reportes');
    Route::get('agenda/reportes-item', 'Agenda\AgendaController@reportesitem')->name('agenda/reportes-item');
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
    // Agenda

    // Encuestas de Auditorias
    Route::get('encaudit', 'Admin\EcnAuditoriasController@index')->name('encaudit');
    // Encuestas de Auditorias

    // Areas de Comisionista
    Route::get('comisionista/areas', 'Admin\AreasComisionistaController@index');
    Route::post('comisionista/areas/agregar', 'Admin\AreasComisionistaController@agregarArea');
    Route::post('comisionista/subareas', 'Admin\AreasComisionistaController@subareas');
    Route::post('comisionista/subareas/agregar', 'Admin\AreasComisionistaController@agregarSubarea');
    Route::post('comisionista/subareas/buscar', 'Admin\AreasComisionistaController@buscarSubareas');
    Route::post('comisionista/problemas', 'Admin\AreasComisionistaController@problemas');
    Route::post('comisionista/problema', 'Admin\AreasComisionistaController@problema');
    Route::post('comisionista/problema/modificar', 'Admin\AreasComisionistaController@modificarProblema');
    Route::post('comisionista/problemas/agregar', 'Admin\AreasComisionistaController@agregarProblema');
    // Areas de Comisionista

    // Comisionistas
    Route::get('comisionista/listas', 'Admin\ComisionistasController@listas')->name('comisionista/listas');
    Route::get('comisionista', 'Admin\ComisionistasController@obtenertodos')->name('comisionista');
    //----------Ajax Cargar Ciudad-----------//
    Route::post('comisionista/listas/ajax/ciudadpds', 'Admin\ComisionistasController@ciudadpds')->name('comisionista/listas/ajax/ciudadpds');
    Route::post('comisionista/listas/ajax/cargarcomisionistas', 'Admin\ComisionistasController@cargarcomisionistas')->name('comisionista/listas/ajax/cargarcomisionistas');
    Route::post('comisionista/listas/ajax/mostrarComisionistas', 'Admin\ComisionistasController@mostrarComisionistas')->name('comisionista/listas/ajax/mostrarComisionistas');
    Route::post('comisionista/listas/ajax/editarComisionistas', 'Admin\ComisionistasController@editarComisionistas')->name('comisionista/listas/ajax/editarComisionistas');
    Route::post('comisionista/listas/ajax/guardarComisionistas', 'Admin\ComisionistasController@guardarComisionistas')->name('comisionista/listas/ajax/guardarComisionistas');
    Route::post('comisionista/listas/ajax/eliminarComisionistas', 'Admin\ComisionistasController@eliminarComisionistas')->name('comisionista/listas/ajax/eliminarComisionistas');
    // Comisionistas

    // Pds
    Route::get('pds', 'PDS\PDSController@index')->name('pds');
    Route::post('pds/listas/ajax/mostrarpds', 'PDS\PDSController@mostrarpds')->name('pds/listas/ajax/mostrarpds');
    Route::post('pds/listas/ajax/cargarpds', 'PDS\PDSController@cargarpds')->name('cargarpds');
    Route::post('pds/listas/ajax/guardarPDS', 'PDS\PDSController@guardarPDS')->name('pds/listas/ajax/guardarPDS');
    Route::post('pds/listas/ajax/editarPDS', 'PDS\PDSController@editarPDS')->name('pds/listas/ajax/editarPDS');
    Route::post('pds/listas/ajax/eliminarPDS', 'PDS\PDSController@eliminarPDS')->name('pds/listas/ajax/eliminarPDS');
    // Pds

    // Auditores
    Route::get('auditores', 'Auditores\AuditoresController@index')->name('auditores');
    Route::post('auditores/listas/ajax/cargarauditores', 'Auditores\AuditoresController@cargarauditores')->name('cargarauditores');
    Route::post('auditor/listas/ajax/guardarAuditor', 'Auditores\AuditoresController@guardarAuditores')->name('auditor/listas/ajax/guardarAuditor');
    Route::post('auditor/listas/ajax/eliminarAuditor', 'Auditores\AuditoresController@eliminarAuditores')->name('auditor/listas/ajax/eliminarAuditor');
    Route::post('auditor/listas/ajax/mostrarAuditor', 'Auditores\AuditoresController@mostrarAuditores')->name('auditor/listas/ajax/mostrarAuditor');
    Route::post('auditor/listas/ajax/editarAuditor', 'Auditores\AuditoresController@editarAuditores')->name('auditor/listas/ajax/editarAuditor');
    // Auditores

    // Proveedores
    Route::get('proveedores', 'Proveedores\ProveedoresController@index');
    Route::post('proveedores/listas/ajax/mostrarProveedores', 'Proveedores\ProveedoresController@mostrar');
    Route::post('proveedores/listas/ajax/verProveedores', 'Proveedores\ProveedoresController@ver');
    Route::post('proveedores/listas/ajax/guardarProveedores', 'Proveedores\ProveedoresController@guardar');
    Route::post('proveedores/listas/ajax/editarProveedores', 'Proveedores\ProveedoresController@modificar');
    Route::post('proveedores/listas/ajax/eliminarProveedores', 'Proveedores\ProveedoresController@eliminar');
    // Proveedores

    // Perfil admin
    Route::get('perfil', 'Admin\PerfilController@index');
    Route::get('perfil/{type}/{image}', 'Admin\PerfilController@getImage');
    Route::post('perfil/modificar', 'Admin\PerfilController@modificar');
    // Perfil admin

    // Mantenimiento
    Route::prefix('mantenimiento')->group(function () {
        Route::get('problemas', 'Mantenimiento\MantenimientoController@problemas')->name('problemas');
        Route::post('problemas/cargar', 'Mantenimiento\MantenimientoController@cargarProblemas');
        Route::post('problemas/orden', 'Mantenimiento\MantenimientoController@verOrden');
        Route::post('problemas/orden/asignar', 'Mantenimiento\MantenimientoController@asignarOrden');
        Route::post('problemas/trabajo/ver', 'Mantenimiento\MantenimientoController@imagenesTrabajo');
        Route::post('problemas/imagenes', 'Mantenimiento\MantenimientoController@imagenesRequerimiento');
        Route::post('problemas/finalizar', 'Mantenimiento\MantenimientoController@finalizarOrdenDeRequerimiento');
        Route::get('ordenes', 'Mantenimiento\MantenimientoController@ordenes');
        Route::post('ordenes/cargar', 'Mantenimiento\MantenimientoController@cargarOrdenes');
        Route::post('ordenes/calificar', 'Mantenimiento\MantenimientoController@calificar');
        Route::get('proveedores', 'Mantenimiento\MantenimientoController@proveedores');
        Route::post('proveedores/cargar', 'Mantenimiento\MantenimientoController@cargarProveedores');
        Route::get('perfil', 'Mantenimiento\MantenimientoController@perfil');
        Route::post('perfil', 'Mantenimiento\MantenimientoController@cambiarFotoPerfil');
    });
    // Mantenimiento

    // Soporte
    Route::prefix('soporte')->group(function () {
        Route::get('problemas', 'Soporte\SoporteController@problemas')->name('problemas');
        Route::post('problemas/cargar', 'Soporte\SoporteController@cargarProblemas');
        Route::post('problemas/orden', 'Soporte\SoporteController@verOrden');
        Route::post('problemas/orden/asignar', 'Soporte\SoporteController@asignarOrden');
        Route::post('problemas/trabajo/ver', 'Soporte\SoporteController@imagenesTrabajo');
        Route::post('problemas/imagenes', 'Soporte\SoporteController@imagenesRequerimiento');
        Route::post('problemas/finalizar', 'Soporte\SoporteController@finalizarOrdenDeRequerimiento');
        Route::get('ordenes', 'Soporte\SoporteController@ordenes');
        Route::post('ordenes/cargar', 'Soporte\SoporteController@cargarOrdenes');
        Route::post('ordenes/calificar', 'Soporte\SoporteController@calificar');
        Route::get('perfil', 'Soporte\SoporteController@perfil');
        Route::post('perfil', 'Soporte\SoporteController@cambiarFotoPerfil');
    });
    // Soporte

    // RP3
    Route::prefix('rp3')->group(function () {
        Route::get('problemas', 'RP3\RP3Controller@problemas')->name('problemas');
        Route::post('problemas/cargar', 'RP3\RP3Controller@cargarProblemas');
        Route::post('problemas/orden', 'RP3\RP3Controller@verOrden');
        Route::post('problemas/orden/asignar', 'RP3\RP3Controller@asignarOrden');
        Route::post('problemas/trabajo/ver', 'RP3\RP3Controller@imagenesTrabajo');
        Route::post('problemas/imagenes', 'RP3\RP3Controller@imagenesRequerimiento');
        Route::post('problemas/finalizar', 'RP3\RP3Controller@finalizarOrdenDeRequerimiento');
        Route::get('ordenes', 'RP3\RP3Controller@ordenes');
        Route::post('ordenes/cargar', 'RP3\RP3Controller@cargarOrdenes');
        Route::get('perfil', 'RP3\RP3Controller@perfil');
        Route::post('perfil', 'RP3\RP3Controller@cambiarFotoPerfil');
    });
    // RP3

    // LottoGame
    Route::prefix('lottogame')->group(function () {
        Route::get('problemas', 'LottoGame\LottoGameController@problemas')->name('problemas');
        Route::post('problemas/cargar', 'LottoGame\LottoGameController@cargarProblemas');
        Route::post('problemas/orden', 'LottoGame\LottoGameController@verOrden');
        Route::post('problemas/orden/asignar', 'LottoGame\LottoGameController@asignarOrden');
        Route::post('problemas/trabajo/ver', 'LottoGame\LottoGameController@imagenesTrabajo');
        Route::post('problemas/imagenes', 'LottoGame\LottoGameController@imagenesRequerimiento');
        Route::post('problemas/finalizar', 'LottoGame\LottoGameController@finalizarOrdenDeRequerimiento');
        Route::get('ordenes', 'LottoGame\LottoGameController@ordenes');
        Route::post('ordenes/cargar', 'LottoGame\LottoGameController@cargarOrdenes');
        Route::get('perfil', 'LottoGame\LottoGameController@perfil');
        Route::post('perfil', 'LottoGame\LottoGameController@cambiarFotoPerfil');
    });
    // LottoGame

    // Permisos
    Route::prefix('permisos')->group(function () {
        Route::get('permisos', 'Permisos\PermisosController@permisos');
        Route::post('buscar', 'Permisos\PermisosController@buscarPermisos');
        Route::post('guardar', 'Permisos\PermisosController@guardarPermisos');
        Route::get('perfil', 'Permisos\PermisosController@perfil');
        Route::post('perfil', 'Permisos\PermisosController@cambiarFotoPerfil');
    });
    // Permisos

    //----Indicadores
    Route::any('indicadores', 'Admin\IndicadoresController@index')->name('indicadores');
    //--Rutas Ajax

    // SuperAdministrador
    Route::prefix('superadmin')->group(function () {
        Route::get('usuarios', 'Superadmin\SuperAdminController@index');
        Route::post('usuarios/ajax/store', 'Superadmin\SuperAdminController@store');
        Route::post('usuarios/ajax/list', 'Superadmin\SuperAdminController@list');
        Route::post('usuarios/ajax/show/{id}', 'Superadmin\SuperAdminController@show');
        Route::post('usuarios/ajax/update', 'Superadmin\SuperAdminController@update');
        Route::post('usuarios/ajax/destroy/{id}', 'Superadmin\SuperAdminController@destroy');
    });
    // SuperAdministrador
});
