<?php

class telefono extends ActiveRecord
{
    public function Guardar($id,$tiene,$tipo1,$tel1,$tipo2,$tel2,$tipo3,$tel3,$tipo4,$tel4)
    {
        if ($tiene==1)
        {
            $parametros = array('persona_id'=>$id,'TieneTel'=>1,'Tipo1'=>$tipo1,'NumTel1'=>$tel1,'Tipo2'=>$tipo2,'NumTel2'=>$tel2,
                                'Tipo3'=>$tipo3,'NumTel3'=>$tel3,'Tipo4'=>$tipo4,'NumTel4'=>$tel4);
            $telef = new telefono($parametros);
            $telef->save();
        }
        else
            {
             $parametros = array('persona_id'=>$id,'TieneTel'=>0);
             $telef = new telefono($parametros);
             $telef->save();
            }
    }
}