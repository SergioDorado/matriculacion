<?php
class Matriculacion extends ActiveRecord
{
   public function Guardar($nromat,$fecha,$situacion,$prov,$prof,$personaid,$codprof)
   {
      $parametros = array('Nromatricula'=>$nromat,'FechaMat'=>$fecha,'Situacion'=>$situacion,'Provincia'=>$prov,'Profesionmat'=>$prof,
           'persona_id'=>$personaid,'CodProfesional'=>$codprof);
       $matri = new Matriculacion($parametros);
       $matri->save();
   }
}
