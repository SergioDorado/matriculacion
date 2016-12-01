<?php

class documento extends ActiveRecord
{
    public function Guardar($tipo,$idpersona)
    {
        $parametros = array('tipodoc'=>$tipo,'persona_id'=>$idpersona);
        $doc= new documento($parametros);
        $doc->save();
    }
    
    public function buscar($id)
    {
        $doc = new documento();
        return ($doc->find_first("persona_id=$id"));
    }
    
}
