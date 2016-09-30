<?php
class persona extends ActiveRecord
{
    
   public function Ultimo() // devuelve el ultimo matriculado registrado
    {
      $pers = new persona();
      return ($pers->find_first("order: id desc"));
    }
    
}
