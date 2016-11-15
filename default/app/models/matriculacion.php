<?php 
Load::model('Matriculareferencia');
class Matriculacion extends ActiveRecord
{
   public function Guardar($nromat,$fecha,$situacion,$prov,$prof,$personaid,$codprof)
   {
      
      $parametros = array('Nromatricula'=>$nromat,'FechaMat'=>$fecha,'Situacion'=>$situacion,'Provincia'=>$prov,'Profesionmat'=>$prof,
           'persona_id'=>$personaid,'CodProfesional'=>$codprof);
       $matri = new Matriculacion($parametros);
       $matri->save();
   }
   
   public function GenerarNro($nivforma)//Genera el numero de matricula
   {
       if ($nivforma == 1)
       {
           $niv = 'A';
       }
       if ($nivforma == 2)
       {
           $niv = 'T';
       }
       if ($nivforma == 3)
       {
           $niv = 'U';
       }
       $ref1 = new Matriculareferencia(); 
      $ref = $ref1->buscar();
      if($ref->folio < $ref->maximofolio)  // si el numero de folio es menor al maximo
      {
          $lib = $ref->libro;
          $folio = $ref->folio +1;  // incrementar el nro de folio en 1
          $ref->folio = $folio;
          $ref->update();
          $nromat = $niv.$lib.$folio;
          return $nromat;
      } 
      else  //sino el nro de folio es = al maximo
      {
          $lib = $ref->libro +1; 
          $folio = 001;
          $ref->folio = $folio;
          $ref->libro = $lib;
          $ref->save();
          $nromat = $niv.$lib.$folio;
      }
   }
}
