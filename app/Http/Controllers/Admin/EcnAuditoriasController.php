<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EcnAuditoriasController extends Controller
{
    public function index(){
        return view('vistas.pages.admin.encaudit.encuesta');
    }
}
