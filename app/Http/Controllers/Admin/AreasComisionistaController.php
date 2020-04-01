<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Area;

class AreasComisionistaController extends Controller
{
    public function index()
    {
        $areas = Area::all();
        return view('vistas.pages.admin.areascomisionistas.areascomisionistas')->with('areas', $areas);
    }
}
