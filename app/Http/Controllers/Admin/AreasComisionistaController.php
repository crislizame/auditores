<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
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
            $text .= '<li class="nav-item subm-item" data-toggle="button" aria-pressed="false"><a class="nav-link subm-a p-2 ml-2 row" href="#" onclick="buscarProblemas(this)" data="' . $subarea->idsubareas . '"><div class="col-6 d-flex"><span class="align-self-center">' . $subarea->nombre . '</span></div><div class="col-6"><img class="img-fluid" src="' . $subarea->url . '"></div></a></li>';
        }
        $text .= '</ul>';

        return $text;
    }

    public function problemas(Request $request)
    {
        $text = '<div class="row">';

        $data = DB::select("SELECT * FROM problemas WHERE subarea_id = ".$request->id);
        $chunked = array_chunk($data, 3);

        foreach ($chunked as $chunk) {
            foreach($chunk as $problema){
                $text .= '<div class="col-4 table-active p-3">'.$problema->nombre.'</div>';
            }
        }
        $text .= '</div>';
        return $text;
    }
}
