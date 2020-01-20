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
    public function save_pds_agend($agenda_id,$seleccs){

        foreach ($seleccs as $selecc => $val) {
            $countpds = (new AgendaPd())->where(['pds_id'=>$val,'agenda_id'=>$agenda_id])->count();
            if ($countpds == 0){
                $ag_pds = new AgendaPd();
                $ag_pds->agenda_id = $agenda_id;
                $ag_pds->pds_id=$val;
                $ag_pds->save();
            }


        }
    }
}
