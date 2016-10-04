<?php
class persona extends ActiveRecord
{
    
   public function Ultimo() // devuelve el ultimo matriculado registrado
    {
      $pers = new persona();
      return ($pers->find_first("order: id desc"));
    }
    public function GuardarDoc($tipo,$nro,$idpersona) //Guarda el Dni del matriculado
    {
        Load::model('documento');
        $doc = new documento();
        $doc->Guardar($tipo,$nro,$idpersona);
    }
    
}
