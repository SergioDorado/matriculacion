<?php 
Load::models('Matriculareferencia','profesiones','provincia');
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
   
   public function buscar($id)
   {
       $mat = new Matriculacion();
       return ($mat->find_first("persona_id=$id"));
   }
   
   public function Formatofeha($fecha)
    {
       $time= new DateTime($fecha);
       return $time->format('d/m/Y');
    }
    
    public function Prof($cod)
    {
        $prof = new Profesiones();
        return ($prof->DevolverProfesion($cod));
    }
    
    public function Habilitado($param)
    {
        if($param == 0)
        {
            return('No Habilitado');
        }
        else{return 'Habilitado';}
        
    }
    
    public function Prov($cod)
    {
        $provin = new Provincia();
        return ($provin->DevolverProvincia($cod));
    }
}
