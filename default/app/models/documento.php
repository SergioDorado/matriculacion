<?php

class documento extends ActiveRecord
{
    public function Guardar($tipo,$nro,$idpersona)
    {
        $parametros = array('tipodoc'=>$tipo, 'nrodoc'=>$nro,'persona_id'=>$idpersona);
        $doc= new documento($parametros);
        $doc->save();
    }
    
}
