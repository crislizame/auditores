<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Problema;
use App\Subarea;
use App\Entidad;
use App\Area;

class AreasComisionistaController extends Controller
{
    public function index()
    {
        $entidades = Entidad::all();
        $areas = Area::all();
        $subareas = Subarea::all();
        return view('vistas.pages.admin.areascomisionistas.areascomisionistas')->with('entidades', $entidades)->with('areas', $areas)->with('subareas', $subareas);
    }

    public function subareas(Request $request)
    {
        $subareas = Subarea::where('area_id', $request->id)->get();
        $control = 1;
        $text = '<ul class="nav subm flex-column" data-toggle="buttons">';
        foreach ($subareas as $subarea) {
            $text .= '<li class="nav-item subm-item" data-toggle="button" aria-pressed="false"><a class="subm-a mx-auto p-2 row" href="#" onclick="buscarProblemas(this)" data="' . $subarea->idsubareas . '"><div class="col-6 d-flex"><span class="align-self-center">' . $subarea->nombre . '</span></div><div class="col-6"><img class="img-fluid" src="' . $subarea->url . '"></div></a></li>';
        }
        $text .= '</ul>';
        return $text;
    }

    public function problemas(Request $request)
    {
        $text = '<div class="row">';
        $data = DB::select("SELECT * FROM problemas WHERE subarea_id = " . $request->id);
        $chunked = array_chunk($data, 3);
        foreach ($chunked as $chunk) {
            foreach ($chunk as $problema) {
                $text .= '<div class="col-4 table-active p-3">' . $problema->nombre . '</div>';
            }
        }
        $text .= '</div>';
        return $text;
    }

    public function agregarArea(Request $request)
    {
        $area = new Area();
        $area->entidad_id = $request->entidad;
        $area->nombre = $request->area;
        $area->save();
        return redirect('comisionista/areas');
    }

    public function agregarSubarea(Request $request)
    {
        $subarea = new Subarea();
        $subarea->area_id = $request->area;
        $subarea->nombre = $request->subarea;
        $subarea->save();
        return redirect('comisionista/areas');
    }

    public function buscarSubareas(Request $request)
    {
        $opciones = '';
        $subareas = Subarea::where('area_id', $request->id)->get();
        foreach ($subareas as $subarea) {
            $opciones .= '<option value="'.$subarea->idsubareas.'">'.$subarea->nombre.'</option>';
        }
        return $opciones;
    }

    public function agregarProblema(Request $request)
    {
        $problema = new Problema();
        $problema->subarea_id = $request->subareasareas;
        $problema->nombre = $request->problema;
        $problema->save();
        return redirect('comisionista/areas');
    }
}
