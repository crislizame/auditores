<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AreasComisionistaController extends Controller
{
    public function index(){
        return view('vistas.pages.admin.areascomisionistas.areascomisionistas');
    }
}
