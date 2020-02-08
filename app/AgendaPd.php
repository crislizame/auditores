<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class AgendaPd extends Model
{
    public function pdsxidagenda($id){
        $ag_pds = $this->where('agenda_id',$id)->get();
//        foreach ($ag_pds as $ag_pd) {
//            //copmpletar dspuwes
//        }
    }
    public function save_pds_agend($agenda_id,$seleccs,$audit_list){

        foreach ($seleccs as $selecc => $val) {


            foreach ($audit_list as $seleccx => $valx) {
                $countaudit = (new PdsAuditore())->where(['auditor_id'=>$valx,'agenda_id'=>$agenda_id,'pds_id'=>$val])->count();
                if ($countaudit == 0) {
                    $ag_audit = new PdsAuditore();
                    $ag_audit->agenda_id = $agenda_id;
                    $ag_audit->pds_id = $val;
                    $ag_audit->auditor_id = $valx;
                    $ag_audit->save();
                }
            }
            //return $id_res;


        }
    }
}
