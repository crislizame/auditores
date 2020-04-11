<?php

namespace App\Http\Controllers\Permisos;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Permisospds;
use App\Attachment;
use Carbon\Carbon;
use App\Permiso;
use App\User;

class PermisosController extends Controller
{
    public function permisos(Request $request)
    {
        $pds = DB::table('pdsperfiles')->join('pdsperfiles_permisos', 'pdsperfiles_permisos.pds_id', 'pdsperfiles.id')->orderBy('id', 'asc')->get();
        return view('vistas.pages.permisos.permisos')->with('pds', $pds);
    }

    public function buscarPermisos(Request $request)
    {
        $pds_permisos = DB::table('pdsperfiles_permisos')
            ->where('pds_id', $request->id)
            ->first();

        $html = '';

        if ($pds_permisos->bsenal == 'true') {

            $permiso = Permiso::where('nombre', 'Señalética')->first();
            $permisopds = Permisospds::where('id_pds', $request->id)->where('id_permiso', $permiso->id)->first();

            $p_permisopds = 0;
            $p_tiempo = 0;
            $p_expedicion = '';
            $p_caducidad = '';
            $p_attachment = '';

            if ($permisopds != null) {
                if (date('Y-m-d') < $permisopds->caducidad) {
                    $p_tiempo = Carbon::parse($permisopds->caducidad)->diffInDays(\Carbon\Carbon::now());
                }
                $p_permisopds = $permisopds->id;
                $p_expedicion = $permisopds->expedicion;
                $p_caducidad = $permisopds->caducidad;
                $p_attachment = $permisopds->id_attachment;
            }

            if ($p_attachment != '') {
                $p_imagen = url('/imagen/' . $p_attachment);
            } else {
                $p_imagen = url('person.jpg');
            }

            $html .= '<form method="post" action="' . url('permisos/guardar') . '" enctype="multipart/form-data">' . csrf_field() . '
            <input type="hidden" name="pds" value="' . $request->id . '">
            <input type="hidden" name="permiso" value="' . $permiso->id . '">
            <input type="hidden" name="permisopds" value="' . $p_permisopds . '">
            <div class="row mt-3">
            <div class="col-9">
                <div class="row">
                    <div class="col-8">
                        <h4 class="text-uppercase">' . $permiso->nombre . '</h4>
                    </div>
                    <div class="col-2">
                        <h4>Si</h2>
                    </div>
                    <div class="col-2">
                        <h4>No</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <h5>Estatus</h5>
                    </div>
                    <div class="col-2">
                        <input class="form-check-input" type="radio" name="aplica" id="aplica_si" value="1" style="left: 30%; opacity: 1;" checked>
                    </div>
                    <div class="col-2">
                        <input class="form-check-input" type="radio" name="aplica" id="aplica_no" value="0" style="left: 30%; opacity: 1;">
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col-7">
                        <h5 class="titulos mt-2">Fecha de expedición</h5>
                    </div>
                    <div class="col-5">
                        <input name="fexp" type="date" class="form-control" placeholder="00-00-0000" value="' . $p_expedicion . '">
                    </div>
                </div>
                <hr>
                <div class="row my-2">
                    <div class="col-7">
                        <h5 class="titulos mt-2">Fecha de caducidad</h5>
                    </div>
                    <div class="col-5">
                        <input name="fcad" type="date" class="form-control" placeholder="00-00-0000" value="' . $p_caducidad . '">
                    </div>
                </div>
                <hr>
                <div class="row my-2">
                    <div class="col-7">
                        <h5 class="titulos mt-2">Conteo regresivo</h5>
                    </div>
                    <div class="col-5">
                        <h4 class="mt-1">' . $p_tiempo . '</h4>
                    </div>
                </div>
                <hr>
            </div>
            <div class="col-3"> 
                <div class="col-8 mx-auto">
                    <img class="img-thumbnail" src="' . $p_imagen . '" onclick="modalImagen(this.src, \'' . $permiso->nombre . '\')">
                </div>
                <div class="custom-file mt-3">
                    <input type="file" name="archivo" class="custom-file-input" lang="es" id="file-' . $permiso->id . '">
                    <label class="custom-file-label">Buscar archivo</label>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-9">
            </div>
            <div class="col-3">
                <button type="submit" class="btn btn-primary float-right">Guardar</button>
            </div>
        </div>
        </form>
        <script>
          $("#file-' . $permiso->id . '").on("change", function() {
            var fileName = $(this).val().split("\\\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
          });
        </script>';
        }

        if ($pds_permisos->bextintores == 'true') {

            $permiso = Permiso::where('nombre', 'Extintores')->first();
            $permisopds = Permisospds::where('id_pds', $request->id)->where('id_permiso', $permiso->id)->first();

            $p_permisopds = 0;
            $p_tiempo = 0;
            $p_expedicion = '';
            $p_caducidad = '';
            $p_attachment = '';

            if ($permisopds != null) {
                if (date('Y-m-d') < $permisopds->caducidad) {
                    $p_tiempo = Carbon::parse($permisopds->caducidad)->diffInDays(\Carbon\Carbon::now());
                }
                $p_permisopds = $permisopds->id;
                $p_expedicion = $permisopds->expedicion;
                $p_caducidad = $permisopds->caducidad;
                $p_attachment = $permisopds->id_attachment;
            }

            if ($p_attachment != '') {
                $p_imagen = url('/imagen/' . $p_attachment);
            } else {
                $p_imagen = url('person.jpg');
            }

            $html .= '<form method="post" action="' . url('permisos/guardar') . '" enctype="multipart/form-data">' . csrf_field() . '
            <input type="hidden" name="pds" value="' . $request->id . '">
            <input type="hidden" name="permiso" value="' . $permiso->id . '">
            <input type="hidden" name="permisopds" value="' . $p_permisopds . '">
            <div class="row mt-3">
            <div class="col-9">
                <div class="row">
                    <div class="col-8">
                        <h4 class="text-uppercase">' . $permiso->nombre . '</h4>
                    </div>
                    <div class="col-2">
                        <h4>Si</h2>
                    </div>
                    <div class="col-2">
                        <h4>No</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <h5>Estatus</h5>
                    </div>
                    <div class="col-2">
                        <input class="form-check-input" type="radio" name="aplica" id="aplica_si" value="1" style="left: 30%; opacity: 1;" checked>
                    </div>
                    <div class="col-2">
                        <input class="form-check-input" type="radio" name="aplica" id="aplica_no" value="0" style="left: 30%; opacity: 1;">
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col-7">
                        <h5 class="titulos mt-2">Fecha de expedición</h5>
                    </div>
                    <div class="col-5">
                        <input name="fexp" type="date" class="form-control" placeholder="00-00-0000" value="' . $p_expedicion . '">
                    </div>
                </div>
                <hr>
                <div class="row my-2">
                    <div class="col-7">
                        <h5 class="titulos mt-2">Fecha de caducidad</h5>
                    </div>
                    <div class="col-5">
                        <input name="fcad" type="date" class="form-control" placeholder="00-00-0000" value="' . $p_caducidad . '">
                    </div>
                </div>
                <hr>
                <div class="row my-2">
                    <div class="col-7">
                        <h5 class="titulos mt-2">Conteo regresivo</h5>
                    </div>
                    <div class="col-5">
                        <h4 class="mt-1">' . $p_tiempo . '</h4>
                    </div>
                </div>
                <hr>
            </div>
            <div class="col-3"> 
                <div class="col-8 mx-auto">
                    <img class="img-thumbnail" src="' . $p_imagen . '" onclick="modalImagen(this.src, \'' . $permiso->nombre . '\')">
                </div>
                <div class="custom-file mt-3">
                    <input type="file" name="archivo" class="custom-file-input" lang="es" id="file-' . $permiso->id . '">
                    <label class="custom-file-label">Buscar archivo</label>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-9">
            </div>
            <div class="col-3">
                <button type="submit" class="btn btn-primary float-right">Guardar</button>
            </div>
        </div>
        </form>
        <script>
          $("#file-' . $permiso->id . '").on("change", function() {
            var fileName = $(this).val().split("\\\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
          });
        </script>';
        }

        if ($pds_permisos->msuelo == 'true') {

            $permiso = Permiso::where('nombre', 'Uso de suelo')->first();
            $permisopds = Permisospds::where('id_pds', $request->id)->where('id_permiso', $permiso->id)->first();

            $p_permisopds = 0;
            $p_tiempo = 0;
            $p_expedicion = '';
            $p_caducidad = '';
            $p_attachment = '';

            if ($permisopds != null) {
                if (date('Y-m-d') < $permisopds->caducidad) {
                    $p_tiempo = Carbon::parse($permisopds->caducidad)->diffInDays(\Carbon\Carbon::now());
                }
                $p_permisopds = $permisopds->id;
                $p_expedicion = $permisopds->expedicion;
                $p_caducidad = $permisopds->caducidad;
                $p_attachment = $permisopds->id_attachment;
            }

            if ($p_attachment != '') {
                $p_imagen = url('/imagen/' . $p_attachment);
            } else {
                $p_imagen = url('person.jpg');
            }

            $html .= '<form method="post" action="' . url('permisos/guardar') . '" enctype="multipart/form-data">' . csrf_field() . '
            <input type="hidden" name="pds" value="' . $request->id . '">
            <input type="hidden" name="permiso" value="' . $permiso->id . '">
            <input type="hidden" name="permisopds" value="' . $p_permisopds . '">
            <div class="row mt-3">
            <div class="col-9">
                <div class="row">
                    <div class="col-8">
                        <h4 class="text-uppercase">' . $permiso->nombre . '</h4>
                    </div>
                    <div class="col-2">
                        <h4>Si</h2>
                    </div>
                    <div class="col-2">
                        <h4>No</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <h5>Estatus</h5>
                    </div>
                    <div class="col-2">
                        <input class="form-check-input" type="radio" name="aplica" id="aplica_si" value="1" style="left: 30%; opacity: 1;" checked>
                    </div>
                    <div class="col-2">
                        <input class="form-check-input" type="radio" name="aplica" id="aplica_no" value="0" style="left: 30%; opacity: 1;">
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col-7">
                        <h5 class="titulos mt-2">Fecha de expedición</h5>
                    </div>
                    <div class="col-5">
                        <input name="fexp" type="date" class="form-control" placeholder="00-00-0000" value="' . $p_expedicion . '">
                    </div>
                </div>
                <hr>
                <div class="row my-2">
                    <div class="col-7">
                        <h5 class="titulos mt-2">Fecha de caducidad</h5>
                    </div>
                    <div class="col-5">
                        <input name="fcad" type="date" class="form-control" placeholder="00-00-0000" value="' . $p_caducidad . '">
                    </div>
                </div>
                <hr>
                <div class="row my-2">
                    <div class="col-7">
                        <h5 class="titulos mt-2">Conteo regresivo</h5>
                    </div>
                    <div class="col-5">
                        <h4 class="mt-1">' . $p_tiempo . '</h4>
                    </div>
                </div>
                <hr>
            </div>
            <div class="col-3"> 
                <div class="col-8 mx-auto">
                    <img class="img-thumbnail" src="' . $p_imagen . '" onclick="modalImagen(this.src, \'' . $permiso->nombre . '\')">
                </div>
                <div class="custom-file mt-3">
                    <input type="file" name="archivo" class="custom-file-input" lang="es" id="file-' . $permiso->id . '">
                    <label class="custom-file-label">Buscar archivo</label>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-9">
            </div>
            <div class="col-3">
                <button type="submit" class="btn btn-primary float-right">Guardar</button>
            </div>
        </div>
        </form>
        <script>
          $("#file-' . $permiso->id . '").on("change", function() {
            var fileName = $(this).val().split("\\\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
          });
        </script>';
        }

        if ($pds_permisos->msalud == 'true') {

            $permiso = Permiso::where('nombre', 'Ministerio de salud')->first();
            $permisopds = Permisospds::where('id_pds', $request->id)->where('id_permiso', $permiso->id)->first();

            $p_permisopds = 0;
            $p_tiempo = 0;
            $p_expedicion = '';
            $p_caducidad = '';
            $p_attachment = '';

            if ($permisopds != null) {
                if (date('Y-m-d') < $permisopds->caducidad) {
                    $p_tiempo = Carbon::parse($permisopds->caducidad)->diffInDays(\Carbon\Carbon::now());
                }
                $p_permisopds = $permisopds->id;
                $p_expedicion = $permisopds->expedicion;
                $p_caducidad = $permisopds->caducidad;
                $p_attachment = $permisopds->id_attachment;
            }

            if ($p_attachment != '') {
                $p_imagen = url('/imagen/' . $p_attachment);
            } else {
                $p_imagen = url('person.jpg');
            }

            $html .= '<form method="post" action="' . url('permisos/guardar') . '" enctype="multipart/form-data">' . csrf_field() . '
            <input type="hidden" name="pds" value="' . $request->id . '">
            <input type="hidden" name="permiso" value="' . $permiso->id . '">
            <input type="hidden" name="permisopds" value="' . $p_permisopds . '">
            <div class="row mt-3">
            <div class="col-9">
                <div class="row">
                    <div class="col-8">
                        <h4 class="text-uppercase">' . $permiso->nombre . '</h4>
                    </div>
                    <div class="col-2">
                        <h4>Si</h2>
                    </div>
                    <div class="col-2">
                        <h4>No</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <h5>Estatus</h5>
                    </div>
                    <div class="col-2">
                        <input class="form-check-input" type="radio" name="aplica" id="aplica_si" value="1" style="left: 30%; opacity: 1;" checked>
                    </div>
                    <div class="col-2">
                        <input class="form-check-input" type="radio" name="aplica" id="aplica_no" value="0" style="left: 30%; opacity: 1;">
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col-7">
                        <h5 class="titulos mt-2">Fecha de expedición</h5>
                    </div>
                    <div class="col-5">
                        <input name="fexp" type="date" class="form-control" placeholder="00-00-0000" value="' . $p_expedicion . '">
                    </div>
                </div>
                <hr>
                <div class="row my-2">
                    <div class="col-7">
                        <h5 class="titulos mt-2">Fecha de caducidad</h5>
                    </div>
                    <div class="col-5">
                        <input name="fcad" type="date" class="form-control" placeholder="00-00-0000" value="' . $p_caducidad . '">
                    </div>
                </div>
                <hr>
                <div class="row my-2">
                    <div class="col-7">
                        <h5 class="titulos mt-2">Conteo regresivo</h5>
                    </div>
                    <div class="col-5">
                        <h4 class="mt-1">' . $p_tiempo . '</h4>
                    </div>
                </div>
                <hr>
            </div>
            <div class="col-3"> 
                <div class="col-8 mx-auto">
                    <img class="img-thumbnail" src="' . $p_imagen . '" onclick="modalImagen(this.src, \'' . $permiso->nombre . '\')">
                </div>
                <div class="custom-file mt-3">
                    <input type="file" name="archivo" class="custom-file-input" lang="es" id="file-' . $permiso->id . '">
                    <label class="custom-file-label">Buscar archivo</label>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-9">
            </div>
            <div class="col-3">
                <button type="submit" class="btn btn-primary float-right">Guardar</button>
            </div>
        </div>
        </form>
        <script>
          $("#file-' . $permiso->id . '").on("change", function() {
            var fileName = $(this).val().split("\\\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
          });
        </script>';
        }

        if ($pds_permisos->mpatente == 'true') {

            $permiso = Permiso::where('nombre', 'Patentes')->first();
            $permisopds = Permisospds::where('id_pds', $request->id)->where('id_permiso', $permiso->id)->first();

            $p_permisopds = 0;
            $p_tiempo = 0;
            $p_expedicion = '';
            $p_caducidad = '';
            $p_attachment = '';

            if ($permisopds != null) {
                if (date('Y-m-d') < $permisopds->caducidad) {
                    $p_tiempo = Carbon::parse($permisopds->caducidad)->diffInDays(\Carbon\Carbon::now());
                }
                $p_permisopds = $permisopds->id;
                $p_expedicion = $permisopds->expedicion;
                $p_caducidad = $permisopds->caducidad;
                $p_attachment = $permisopds->id_attachment;
            }

            if ($p_attachment != '') {
                $p_imagen = url('/imagen/' . $p_attachment);
            } else {
                $p_imagen = url('person.jpg');
            }

            $html .= '<form method="post" action="' . url('permisos/guardar') . '" enctype="multipart/form-data">' . csrf_field() . '
            <input type="hidden" name="pds" value="' . $request->id . '">
            <input type="hidden" name="permiso" value="' . $permiso->id . '">
            <input type="hidden" name="permisopds" value="' . $p_permisopds . '">
            <div class="row mt-3">
            <div class="col-9">
                <div class="row">
                    <div class="col-8">
                        <h4 class="text-uppercase">' . $permiso->nombre . '</h4>
                    </div>
                    <div class="col-2">
                        <h4>Si</h2>
                    </div>
                    <div class="col-2">
                        <h4>No</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <h5>Estatus</h5>
                    </div>
                    <div class="col-2">
                        <input class="form-check-input" type="radio" name="aplica" id="aplica_si" value="1" style="left: 30%; opacity: 1;" checked>
                    </div>
                    <div class="col-2">
                        <input class="form-check-input" type="radio" name="aplica" id="aplica_no" value="0" style="left: 30%; opacity: 1;">
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col-7">
                        <h5 class="titulos mt-2">Fecha de expedición</h5>
                    </div>
                    <div class="col-5">
                        <input name="fexp" type="date" class="form-control" placeholder="00-00-0000" value="' . $p_expedicion . '">
                    </div>
                </div>
                <hr>
                <div class="row my-2">
                    <div class="col-7">
                        <h5 class="titulos mt-2">Fecha de caducidad</h5>
                    </div>
                    <div class="col-5">
                        <input name="fcad" type="date" class="form-control" placeholder="00-00-0000" value="' . $p_caducidad . '">
                    </div>
                </div>
                <hr>
                <div class="row my-2">
                    <div class="col-7">
                        <h5 class="titulos mt-2">Conteo regresivo</h5>
                    </div>
                    <div class="col-5">
                        <h4 class="mt-1">' . $p_tiempo . '</h4>
                    </div>
                </div>
                <hr>
            </div>
            <div class="col-3"> 
                <div class="col-8 mx-auto">
                    <img class="img-thumbnail" src="' . $p_imagen . '" onclick="modalImagen(this.src, \'' . $permiso->nombre . '\')">
                </div>
                <div class="custom-file mt-3">
                    <input type="file" name="archivo" class="custom-file-input" lang="es" id="file-' . $permiso->id . '">
                    <label class="custom-file-label">Buscar archivo</label>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-9">
            </div>
            <div class="col-3">
                <button type="submit" class="btn btn-primary float-right">Guardar</button>
            </div>
        </div>
        </form>
        <script>
          $("#file-' . $permiso->id . '").on("change", function() {
            var fileName = $(this).val().split("\\\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
          });
        </script>';
        }

        if ($pds_permisos->mtasa == 'true') {

            $permiso = Permiso::where('nombre', 'Tasa de habilitación')->first();
            $permisopds = Permisospds::where('id_pds', $request->id)->where('id_permiso', $permiso->id)->first();

            $p_permisopds = 0;
            $p_tiempo = 0;
            $p_expedicion = '';
            $p_caducidad = '';
            $p_attachment = '';

            if ($permisopds != null) {
                if (date('Y-m-d') < $permisopds->caducidad) {
                    $p_tiempo = Carbon::parse($permisopds->caducidad)->diffInDays(\Carbon\Carbon::now());
                }
                $p_permisopds = $permisopds->id;
                $p_expedicion = $permisopds->expedicion;
                $p_caducidad = $permisopds->caducidad;
                $p_attachment = $permisopds->id_attachment;
            }

            if ($p_attachment != '') {
                $p_imagen = url('/imagen/' . $p_attachment);
            } else {
                $p_imagen = url('person.jpg');
            }

            $html .= '<form method="post" action="' . url('permisos/guardar') . '" enctype="multipart/form-data">' . csrf_field() . '
            <input type="hidden" name="pds" value="' . $request->id . '">
            <input type="hidden" name="permiso" value="' . $permiso->id . '">
            <input type="hidden" name="permisopds" value="' . $p_permisopds . '">
            <div class="row mt-3">
            <div class="col-9">
                <div class="row">
                    <div class="col-8">
                        <h4 class="text-uppercase">' . $permiso->nombre . '</h4>
                    </div>
                    <div class="col-2">
                        <h4>Si</h2>
                    </div>
                    <div class="col-2">
                        <h4>No</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <h5>Estatus</h5>
                    </div>
                    <div class="col-2">
                        <input class="form-check-input" type="radio" name="aplica" id="aplica_si" value="1" style="left: 30%; opacity: 1;" checked>
                    </div>
                    <div class="col-2">
                        <input class="form-check-input" type="radio" name="aplica" id="aplica_no" value="0" style="left: 30%; opacity: 1;">
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col-7">
                        <h5 class="titulos mt-2">Fecha de expedición</h5>
                    </div>
                    <div class="col-5">
                        <input name="fexp" type="date" class="form-control" placeholder="00-00-0000" value="' . $p_expedicion . '">
                    </div>
                </div>
                <hr>
                <div class="row my-2">
                    <div class="col-7">
                        <h5 class="titulos mt-2">Fecha de caducidad</h5>
                    </div>
                    <div class="col-5">
                        <input name="fcad" type="date" class="form-control" placeholder="00-00-0000" value="' . $p_caducidad . '">
                    </div>
                </div>
                <hr>
                <div class="row my-2">
                    <div class="col-7">
                        <h5 class="titulos mt-2">Conteo regresivo</h5>
                    </div>
                    <div class="col-5">
                        <h4 class="mt-1">' . $p_tiempo . '</h4>
                    </div>
                </div>
                <hr>
            </div>
            <div class="col-3"> 
                <div class="col-8 mx-auto">
                    <img class="img-thumbnail" src="' . $p_imagen . '" onclick="modalImagen(this.src, \'' . $permiso->nombre . '\')">
                </div>
                <div class="custom-file mt-3">
                    <input type="file" name="archivo" class="custom-file-input" lang="es" id="file-' . $permiso->id . '">
                    <label class="custom-file-label">Buscar archivo</label>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-9">
            </div>
            <div class="col-3">
                <button type="submit" class="btn btn-primary float-right">Guardar</button>
            </div>
        </div>
        </form>
        <script>
          $("#file-' . $permiso->id . '").on("change", function() {
            var fileName = $(this).val().split("\\\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
          });
        </script>';
        }

        if ($pds_permisos->lpermiso == 'true') {

            $permiso = Permiso::where('nombre', 'Letreros')->first();
            $permisopds = Permisospds::where('id_pds', $request->id)->where('id_permiso', $permiso->id)->first();

            $p_permisopds = 0;
            $p_tiempo = 0;
            $p_expedicion = '';
            $p_caducidad = '';
            $p_attachment = '';

            if ($permisopds != null) {
                if (date('Y-m-d') < $permisopds->caducidad) {
                    $p_tiempo = Carbon::parse($permisopds->caducidad)->diffInDays(\Carbon\Carbon::now());
                }
                $p_permisopds = $permisopds->id;
                $p_expedicion = $permisopds->expedicion;
                $p_caducidad = $permisopds->caducidad;
                $p_attachment = $permisopds->id_attachment;
            }

            if ($p_attachment != '') {
                $p_imagen = url('/imagen/' . $p_attachment);
            } else {
                $p_imagen = url('person.jpg');
            }

            $html .= '<form method="post" action="' . url('permisos/guardar') . '" enctype="multipart/form-data">' . csrf_field() . '
            <input type="hidden" name="pds" value="' . $request->id . '">
            <input type="hidden" name="permiso" value="' . $permiso->id . '">
            <input type="hidden" name="permisopds" value="' . $p_permisopds . '">
            <div class="row mt-3">
            <div class="col-9">
                <div class="row">
                    <div class="col-8">
                        <h4 class="text-uppercase">' . $permiso->nombre . '</h4>
                    </div>
                    <div class="col-2">
                        <h4>Si</h2>
                    </div>
                    <div class="col-2">
                        <h4>No</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <h5>Estatus</h5>
                    </div>
                    <div class="col-2">
                        <input class="form-check-input" type="radio" name="aplica" id="aplica_si" value="1" style="left: 30%; opacity: 1;" checked>
                    </div>
                    <div class="col-2">
                        <input class="form-check-input" type="radio" name="aplica" id="aplica_no" value="0" style="left: 30%; opacity: 1;">
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col-7">
                        <h5 class="titulos mt-2">Fecha de expedición</h5>
                    </div>
                    <div class="col-5">
                        <input name="fexp" type="date" class="form-control" placeholder="00-00-0000" value="' . $p_expedicion . '">
                    </div>
                </div>
                <hr>
                <div class="row my-2">
                    <div class="col-7">
                        <h5 class="titulos mt-2">Fecha de caducidad</h5>
                    </div>
                    <div class="col-5">
                        <input name="fcad" type="date" class="form-control" placeholder="00-00-0000" value="' . $p_caducidad . '">
                    </div>
                </div>
                <hr>
                <div class="row my-2">
                    <div class="col-7">
                        <h5 class="titulos mt-2">Conteo regresivo</h5>
                    </div>
                    <div class="col-5">
                        <h4 class="mt-1">' . $p_tiempo . '</h4>
                    </div>
                </div>
                <hr>
            </div>
            <div class="col-3"> 
                <div class="col-8 mx-auto">
                    <img class="img-thumbnail" src="' . $p_imagen . '" onclick="modalImagen(this.src, \'' . $permiso->nombre . '\')">
                </div>
                <div class="custom-file mt-3">
                    <input type="file" name="archivo" class="custom-file-input" lang="es" id="file-' . $permiso->id . '">
                    <label class="custom-file-label">Buscar archivo</label>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-9">
            </div>
            <div class="col-3">
                <button type="submit" class="btn btn-primary float-right">Guardar</button>
            </div>
        </div>
        </form>
        <script>
          $("#file-' . $permiso->id . '").on("change", function() {
            var fileName = $(this).val().split("\\\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
          });
        </script>';
        }

        return $html;
    }

    public function guardarPermisos(Request $request)
    {
        $cimagen = new Attachment();
        $cimagen->file = file_get_contents($request->file('archivo')->getRealPath());
        $cimagen->user_id = Auth::user()->id;
        $cimagen->save();

        $permisopds = $request->permisopds != 0 ? Permisospds::find($request->permisopds) : new Permisospds();
        $permisopds->id_pds = $request->pds;
        $permisopds->id_permiso = $request->permiso;
        $permisopds->id_attachment = $cimagen->idattachments;
        $permisopds->aplica = $request->aplica;
        $permisopds->expedicion = $request->fexp;
        $permisopds->caducidad = $request->fcad;
        $permisopds->save();

        return redirect('permisos/permisos');
    }

    public function perfil()
    {
        $user = User::where('id', Auth::user()->id)->leftJoin('mantenimiento_users', 'users.id', 'mantenimiento_users.user_id')->first();
        return view('vistas.pages.permisos.perfil')->with('user', $user);
    }
}
