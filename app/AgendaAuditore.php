<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class AgendaAuditore extends Model
{
    public function save_audit_agend($agenda_id,$seleccs){
        foreach ($seleccs as $selecc => $val) {
            $countaudit = (new AgendaAuditore())->where(['auditor_id'=>$val,'agenda_id'=>$agenda_id])->count();
            if ($countaudit == 0) {
                $ag_audit = new AgendaAuditore();
                $ag_audit->agenda_id = $agenda_id;
                $ag_audit->auditor_id = $val;
                $ag_audit->save();
            }
        }
    }
}
