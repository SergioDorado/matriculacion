<?php

class documento extends ActiveRecord
{
    public function Guardar($tipo,$idpersona)
    {
        $parametros = array('tipodoc'=>$tipo,'persona_id'=>$idpersona);
        $doc= new documento($parametros);
        $doc->save();
    }
    
}
