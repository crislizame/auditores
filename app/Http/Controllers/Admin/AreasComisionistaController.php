<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Problema;
use App\Subarea;
use App\Area;

class AreasComisionistaController extends Controller
{
    public function index()
    {
        $areas = Area::all();
        return view('vistas.pages.admin.areascomisionistas.areascomisionistas')->with('areas', $areas);
    }

    public function subareas(Request $request)
    {
        $subareas = Subarea::where('area_id', $request->id)->get();

        $control = 1;
        $text = '<ul class="nav subm flex-column" data-toggle="buttons">';
        foreach ($subareas as $subarea) {
            $text .= '<li class="nav-item subm-item" data-toggle="button" aria-pressed="false"><a class="nav-linkk subm-a p-2 ml-2 row" href="#" onclick="buscarProblemas(this)" data="' . $subarea->idsubareas . '"><div class="col-6 d-flex"><span class="align-self-center">' . $subarea->nombre . '</span></div><div class="col-6"><img class="img-fluid" src="' . $subarea->url . '"></div></a></li>';
        }
        $text .= '</ul>';

        return $text;
    }

    public function problemas(Request $request)
    {
        $problemas = Problema::where('subarea_id', $request->id)->get();

        $control = 0;
        $text = '<div class="row">';

        $datos_problemas = array_chunk($problemas, 3);
        for ($row = 0; $row < count($datos_problemas); $row++) {
            for($i = 0;$i < $datos_problemas[$row];$i++){
                $text .= '<div class="col-4 table-active p-3">'.$datos_problemas[$row][$i].'</div>';
            }
        }
        $text .= '</div>';
        return $text;
    }
}
