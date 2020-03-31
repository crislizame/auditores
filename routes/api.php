<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

//Comisionista
Route::resource('v1/comuser', 'API\Comisionista\UserController');
Route::resource('v1/menus', 'API\Comisionista\MenuController');
Route::resource('v1/ordenreq', 'API\Comisionista\OrdenRequerimientoController');
Route::resource('v1/pushcom', 'API\Comisionista\PushComController');
Route::resource('v1/reporte', 'API\Comisionista\ReportesController');
Route::resource('v1/calificaciones', 'API\Comisionista\CalificacionesController');

//Auditores
Route::resource('v1/arqueocaja', 'API\ArqueoCajaController');
Route::resource('v1/comisionistas', 'API\ComisionistasApiController');
Route::resource('v1/com_api', 'API\ComisionistasApiController2');
Route::resource('v1/perfilauditor', 'API\PerfilAuditorController');
Route::resource('v1/user', 'API\UserLoginController');
Route::resource('v1/informe', 'API\InformesApiController');
Route::resource('v1/pdsperfil', 'API\PdsApiController');
Route::resource('v1/contador', 'API\ContadorApiController');
Route::resource('v1/imagen', 'API\ImagenController');
Route::resource('v1/reportes', 'API\ReportesController');
Route::resource('v1/getAgendas', 'API\MonthController');
Route::resource('v1/getencaudit', 'API\EncuestasAuditoriasController');//enviar id_auditor
Route::resource('v1/getencauditv', 'API\EncuestasAuditoriasVController');//no values
Route::resource('v1/getActivos', 'API\ActivosApiController');//no values
Route::resource('v1/getPerfil', 'API\PerfilApiController');//no values
Route::resource('v1/getperfil', 'API\PerfilApiController');//no values
