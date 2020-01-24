<?php

namespace App\Http\Controllers\Agenda;

use App\Agenda;
use App\AgendaAuditore;
use App\AgendaPd;
use App\Attachment;
use App\Auditore;
use App\Encauditdata_attachment;
use App\Pdsperfile;
use App\Arqueo_attachment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AgendaController extends Controller
{
    //------------------- Seccion Ver Agenda -----------------------//
    //Carga vista Ver Agenda
    public function veragenda()
    {
        return view('vistas.pages.admin.agenda.ver-agenda');
    }
    public function eliminarpdsdeagenda()
    {
        $idpds = \request('id');
        $idagenda = \request('idagenda');
        (new AgendaPd())->where(['pds_id' => $idpds, 'agenda_id' => $idagenda])->delete();
        return 1;
    }
    public function eliminarauditordeagenda()
    {
        $idpds = \request('id');
        $idagenda = \request('idagenda');
        (new AgendaAuditore())->where(['auditor_id' => $idpds, 'agenda_id' => $idagenda])->delete();
        return 1;
    }
    public function editarpdsdeagenda()
    {
        $idpds = \request('id');
        $nidpds = \request('nid');
        $idagenda = \request('idagenda');
        (new AgendaPd())->where(['pds_id' => $idpds, 'agenda_id' => $idagenda])->update(['pds_id' => $nidpds]);
        return 1;
    }
    public function editarauditdeagenda()
    {
        $idpds = \request('id');
        $nidpds = \request('nid');
        $idagenda = \request('idagenda');
        (new AgendaAuditore())->where(['auditor_id' => $idpds, 'agenda_id' => $idagenda])->update(['auditor_id' => $nidpds]);
        return 1;
    }
    public function eliminaragenda()
    {
        $id = \request('id');
        (new Agenda())->where('id', $id)->delete();
        return 1;
    }
    public function cargarfechas()
    {
        $start = \request('start');
        $end = \request('end');
        $agendf = (new Agenda())->whereBetween('agenda_date', [$start, $end])->get();
        $res = array();
        setlocale(LC_ALL, 'es_ES');

        foreach ($agendf as $item) {
            $res[] = array(
                'title' => ' ', 'start' => $item->agenda_date, 'id' => $item->id,
                'textfecha' => ucfirst(Carbon::parse($item->agenda_date)->isoFormat('dddd, D \d\e\ MMMM \d\e\l YYYY'))
            );
        }
        return $res;
    }
    public function cargarauditxfecha()
    {
        $agendaid = json_decode(\request('id'));
        $mpds = new AgendaAuditore();

        $sqlend = null;
        $sql = $mpds;
        $pds_agendas = $sql->where('agenda_id', $agendaid)->get();
        $res = null;
        $active = null;
        foreach ($pds_agendas as $pds_agenda) {
            $pds = new Auditore();
            $auditore = $pds->where('id', $pds_agenda->auditor_id)->first();
            $res .= "<li class=\"nav-item audititem\">
                                            <span class=\"nav-link \" >" . mb_strimwidth($auditore->aud_nombre . ' ' . $auditore->aud_apellidos, 0, 15, "...") . " <span class=\"check-or-not\"><i class=\"fa fa-trash float-right text-info btn-delaudit p-1 \" data-id='$auditore->id' data-agenda='$agendaid'></i><i class=\"fa fa-edit text-info btn-editaudit float-right p-1 \" data-id='$auditore->id' data-nombre='$auditore->aud_nombre $auditore->aud_apellidos' data-agenda='$agendaid'></i></span></span>
                                        </li>";
        }
        return $res;
    }
    public function cargarpdsxfecha()
    {
        $agendaid = json_decode(\request('id'));
        $mpds = new AgendaPd();

        $sqlend = null;
        $sql = $mpds;
        $pds_agendas = $sql->where('agenda_id', $agendaid)->get();
        $res = null;
        $active = null;
        foreach ($pds_agendas as $pds_agenda) {
            $pds = new Pdsperfile();
            $pd = $pds->where('id', $pds_agenda->pds_id)->first();
            $res .= "<li class=\"nav-item\">
                                            <div class=\"nav-link pds-lista-item text-left \">" . mb_strimwidth($pd->pds_name, 0, 80, '...') . " <i class=\"fa fa-trash float-right mini-btn btn-delpds text-info fa-lg\" data-id='$pd->id' data-agenda='$agendaid'></i><i class=\"fa fa-edit text-info float-right btn-editarpds mini-btn fa-lg\" data-agenda='$agendaid' data-id='$pd->id' data-nombre='$pd->pds_name'></i></div>
                                        </li>";
        }
        return $res;
    }

    //------------------- Seccion Crear Agenda -----------------------//
    //Carga vista Crear Agenda
    public function crearagenda()
    {
        return view('vistas.pages.admin.agenda.crear-agenda');
    }
    //Save Data Ajax POST
    public function saveagenda()
    {
        try {
            DB::transaction(function () {
                $pdslist = (object) json_decode(\request('pdslist'), true);
                $auditlist = (object) json_decode(\request('auditlist'), true);
                $datecalendar = \request('datecalendar');
                $countagenda = (new Agenda())->where(['agenda_date' => $datecalendar, 'agenda_active' => '1'])->count();
                if ($countagenda > 0) {
                    $agenda_id = (new Agenda())->where(['agenda_date' => $datecalendar, 'agenda_active' => '1'])->value('id');
                } else {
                    $agendamodel = new Agenda();
                    $agendamodel->agenda_date = $datecalendar;
                    $agendamodel->save();
                    $agenda_id = $agendamodel->id;
                }

                (new AgendaPd())->save_pds_agend($agenda_id, $pdslist);
                (new AgendaAuditore())->save_audit_agend($agenda_id, $auditlist);
            });
            return 1;
        } catch (\Exception $e) {
            return 2;
        }
        return 2;
    }
    // Cargas Ajax POST
    public function cargarpdslista()
    {
        $selects = json_decode(\request('pdslist')); //valor en array con los id seleccionados
        $mpds = new Pdsperfile();

        $sqlend = null;
        $sql = $mpds;
        $pds = $sql->get();
        $res = null;
        $active = null;
        foreach ($pds as $pd) {
            if (array_search($pd->id, $selects) !== false) {
                $res .= "<li class=\"nav-item\" >
                                            <span style='font-size: 0.8em;' class=\"nav-link titulos \" > " . mb_strimwidth($pd->pds_name, 0, 25, '...') . "</span>
                                            <hr class=\"p-0 m-0\">
                                        </li>";
            }
        }
        return $res;
    }
    public function cargarauditlista()
    {
        $selects = json_decode(\request('auditlist')); //valor en array con los id seleccionados

        $mpds = new Auditore();
        $auditores = $mpds->get();
        $res = null;
        $active = null;
        $i = 1;
        foreach ($auditores as $auditore) {
            if (array_search($auditore->id, $selects) !== false) {
                $res .= "<li class=\"nav-item\" >
                                            <span style='font-size: 0.8em;' class=\"nav-link titulos \" > " . mb_strimwidth($auditore->aud_nombre . ' ' . $auditore->aud_apellidos, 0, 15, "...") . "</span>
                                            <hr class=\"p-0 m-0\">
                                        </li>";
            }
        }
        return $res;
    }
    public function cargarpds()
    {
        $selects = json_decode(\request('selecc')); //valor en array con los id seleccionados
        $filtro = \request('filtro'); //filtrar por: a-z, ciudad, o ciudad especifica
        $buscar = \request('buscar'); //buscar un valor x
        $mpds = new Pdsperfile();
        $is_ciudad = false;

        $sqlend = null;
        $sql = $mpds;
        if ($buscar !== "") {
            $sql = $sql->where('pds_name', 'like', '%' . $buscar . "%");
        }
        switch ($filtro) {
            case "az":
                $sqlend = $sql->orderBy('pds_name', "asc");
                break;
            default:
                if ($filtro == "ciudad") {
                    //ordenar por ciudad
                    $is_ciudad = true;
                    $sqlend = $sql->orderBy('pds_ciudad', "asc");
                } else if ($filtro !== "") {
                    $sqlend = $sql->where('pds_ciudad', 'like', "%" . $filtro);
                    $is_ciudad = true;
                }
                break;
        }
        $pds = $sql->get();
        $res = null;
        $ciudad_act = null;
        $active = null;
        $activeclass = "fa-circle-o text-secondary";
        foreach ($pds as $pd) {
            if (array_search($pd->id, $selects) !== false) {
                $active = 'active';
                $activeclass = "fa-check text-white";
            } else {
                $active = null;
                $activeclass = "fa-circle-o text-secondary";
            }
            if ($is_ciudad) {
                if ($pd->pds_ciudad !== $ciudad_act) {
                    $res .= " <li class=\"nav-item \">
                                            <span class=\"nav-link bold  titulos-grandes text-center\">" . mb_strimwidth($pd->pds_ciudad, 0, 15, '...') . "</span></span>
                                            <hr class=\"p-0 m-0\">
                                        </li>";
                }
                $res .= "<li class=\"nav-item\" data-id='$pd->id'>
                                            <span class=\"nav-link pdsitem $active\" > " . mb_strimwidth($pd->pds_name, 0, 25, '...') . "<span class=\"check-or-not\"><i class=\"fa $activeclass float-right p-1 mr-2\"></i></span></span>
                                            <hr class=\"p-0 m-0\">
                                        </li>";
            } else {


                $res .= "<li class=\"nav-item\" data-id='$pd->id'>
                                            <span class=\"nav-link pdsitem $active\" > " . mb_strimwidth($pd->pds_name, 0, 25, '...') . "<span class=\"check-or-not\"><i class=\"fa $activeclass float-right p-1 mr-2\"></i></span></span>
                                            <hr class=\"p-0 m-0\">
                                        </li>";
            }
            $ciudad_act = $pd->pds_ciudad;
        }
        return $res;
    }
    public function npds()
    {
        $selects = json_decode(\request('selecc')); //valor en array con los id seleccionados
        $filtro = \request('filtro'); //filtrar por: a-z, ciudad, o ciudad especifica
        $buscar = \request('buscar'); //buscar un valor x
        $mpds = new Pdsperfile();
        $is_ciudad = false;

        $sqlend = null;
        $sql = $mpds;
        if ($buscar !== "") {
            $sql = $sql->where('pds_name', 'like', '%' . $buscar . "%");
        }
        switch ($filtro) {
            case "az":
                $sqlend = $sql->orderBy('pds_name', "asc");
                break;
            default:
                if ($filtro == "ciudad") {
                    //ordenar por ciudad
                    $is_ciudad = true;
                    $sqlend = $sql->orderBy('pds_ciudad', "asc");
                } else if ($filtro !== "") {
                    $sqlend = $sql->where('pds_ciudad', 'like', "%" . $filtro);
                    $is_ciudad = true;
                }
                break;
        }
        $pds = $sql->count();
        $res = $pds;
        $ciudad_act = null;
        $active = null;
        $activeclass = "fa-circle-o text-secondary";

        return $res;
    }
    public function cargarauditores()
    {
        $mpds = new Auditore();
        $auditores = $mpds->get();
        $res = null;
        $active = null;
        $i = 1;
        foreach ($auditores as $auditore) {

            if ($i % 2) {
                $res .= "<li class=\"nav-item audititem\" data-id='$auditore->id'>
                                        <span  class=\"nav-link\" href=\"#\">" . mb_strimwidth($auditore->aud_nombre . ' ' . $auditore->aud_apellidos, 0, 15, "...") . " <span class=\"check-or-not\"><i class=\"fa float-right p-1 \"></i></span></span>
                                    </li>";
            } else {
                $res .= "<li class=\"nav-item audititem bg-gray\" data-id='$auditore->id'>
                                        <span class=\"nav-link\" href=\"#\">" . mb_strimwidth($auditore->aud_nombre . ' ' . $auditore->aud_apellidos, 0, 15, "...") . " <span class=\"check-or-not\"><i class=\"fa float-right p-1 \"></i></span></span>
                                    </li>";
            }
            $i = $i + 1;
        }
        return $res;
    }
    public function cargarpdsnombres()
    {
        $buscar = \request('query');
        $mpds = new Pdsperfile();
        $pds = $mpds->where('pds_name', 'like', '%' . $buscar . "%")->get();
        $result = array();
        foreach ($pds as $pd) {
            $result['suggestions'][] = array('value' => $pd->pds_name, 'data' => $pd->id);
        }
        return response()->json($result);
    }

    //------------------- Seccion Reporte -----------------------//
    //Carga vista Reporte
    public function reportes()
    {
        return view('vistas.pages.admin.agenda.reportes');
    }
    public function reportesitem()
    {
        return view('vistas.pages.admin.agenda.reportes-item');
    }
    public function imprimirreportesitem()
    {
        return view('vistas.pages.admin.agenda.imprimirreportes-item');
    }
    public function imagen($id)
    {
        $img = (new Attachment())->where('idattachments', $id)->value('file');

        header('Content-type: ' . "image/jpeg");
        echo $img;
    }
    public function getimages()
    {
        $id = \request('id');
        $res = "";
        if (\request('cat') == 'N') {
            $imgs = (new Encauditdata_attachment())->where('encauditdatas_id', $id)->get();
            foreach ($imgs as $img) {
                $res .= " <div class=\"col-md-6 col-lg-3 col-xl-3\">
                                            <a href=\"" . url('imagen/' . $img->attachments_id) . "\" data-fancybox=\"group2\">
                                                <img src=\"" . url('imagen/' . $img->attachments_id) . "\" alt=\"lightbox\" class=\"lightbox-thumb img-thumbnail\">
                                            </a>
                                        </div>";
            }
        } else if (\request('cat') == 'P') {
            $imgs = (new Arqueo_attachment())->where('arqueo_id', $id)->get();
            foreach ($imgs as $img) {
                $res .= " <div class=\"col-md-6 col-lg-3 col-xl-3\">
                                            <a href=\"" . url('imagen/' . $img->attachments_id) . "\" data-fancybox=\"group2\">
                                                <img src=\"" . url('imagen/' . $img->attachments_id) . "\" alt=\"lightbox\" class=\"lightbox-thumb img-thumbnail\">
                                            </a>
                                        </div>";
            }
        } else if (\request('cat') == 'Print') {
            $imgs = (new Arqueo_attachment())->where('arqueo_id', $id)->get();
            foreach ($imgs as $img) {
                $res .= " <div class=\"col-2\">
                                            <a href=\"" . url('imagen/' . $img->attachments_id) . "\" data-fancybox=\"group2\">
                                                <img src=\"" . url('imagen/' . $img->attachments_id) . "\" alt=\"lightbox\" class=\"lightbox-thumb img-thumbnail\">
                                            </a>
                                        </div>";
            }
        }
        return $res;
    }
}
