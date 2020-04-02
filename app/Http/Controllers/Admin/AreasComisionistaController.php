<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Subarea;
use App\Area;

class AreasComisionistaController extends Controller
{
    public function index()
    {
        $areas = Area::all();
        return view('vistas.pages.admin.areascomisionistas.areascomisionistas')->with('areas', $areas);
    }

    public function subareas(Request $request){
        $subareas = Subarea::where('area_id',$request->id)->get();
        
        $control = 1;
        $text = '<ul class="nav subm flex-column">';
        foreach($subareas as $subarea){
            $text .= '<li class="nav-item subm-item"><a id="ls-{{ $control++ }}" class="nav-link subm-a p-5" href="#" onclick="buscarProblemas(this)" data="'.$subarea->idsubareas.'">'.$subarea->nombre.'</a></li>';
        }
        $text .= '</ul>';

        return $text;    
    }
}
