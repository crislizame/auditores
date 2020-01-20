<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndicadoresController extends Controller
{
    public function index(){
        return view('vistas.pages.admin.indicadores.indicadores');
    }
}
