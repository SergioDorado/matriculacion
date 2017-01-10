<?php
class persona extends ActiveRecord
{
    
   public function Ultimo() // devuelve el ultimo matriculado registrado
    {
      $pers = new persona();
      return ($pers->find_first("order: id desc"));
    }
    public function GuardarDoc($tipo,$idpersona) //Guarda el Dni del matriculado
    {
        Load::model('documento');
        $doc = new documento();
        $doc->Guardar($tipo,$idpersona); // pasa los parametros al modelo documento donde se realiza el guardado
    }
    
    public function GuardarTels($id,$tiene,$tipo1,$tel1,$tipo2,$tel2,$tipo3,$tel3,$tipo4,$tel4) //Guarda el o los telefonos del matriculado
    {
        Load::model('telefono');
        $telef = new telefono();
        $telef->Guardar($id, $tiene, $tipo1, $tel1, $tipo2, $tel2, $tipo3, $tel3, $tipo4, $tel4); // pasa los parametros al modelo telefono donde se raliza 
        
    }
    
    public function GuardarForma($tipo,$prof,$titulo,$fecheg,$rev,$fecrev,$instrev,$profref,$instiform,$idpers,$profasoc,$orgreg)
    {
        Load::model('formacion');
        $form = new Formacion();
        $form->Guardar($tipo, $prof, $titulo, $fecheg, $rev, $fecrev, $instrev, $profref,$instiform, $idpers, $profasoc, $orgreg);
    }
    
    public function GuardarMatricula($nromat,$fecha,$situacion,$prov,$prof,$personaid,$codprof)
    {
        Load::model('matriculacion');
        $matric = new Matriculacion();
        $matric->Guardar($nromat, $fecha, $situacion, $prov, $prof, $personaid, $codprof);
    }
    public function buscar($dni)
    {
        $pers = new persona();
        return ($pers->find_first("dni=$dni"));
    }
    
    public function Formatofeha($fecha)
    {
       $time= new DateTime($fecha);
       return $time->format('d/m/Y');
    }
    
    public function Sexo($sexo)
    {
        if($sexo == 'M')
        {
            return 'Masculino';
        }
        else {return 'Femenino';}
    }
    
    public function DevolverId($dni)
    {
        $pers = new persona();
        return ($pers->find_first("dni=$dni")->id);
    }
    
    public function Modificar($dni,$parametro)
    {
       $pers = new persona();
       $pers = Load::model('persona')->buscar($dni);
       $pers->dni = $parametro->dni;
       $pers->Apellido = $parametro->Apellido;
       $pers->Nombre = $parametro->Nombre;
       $pers->FechaNac = $parametro->FechaNac;
       $pers->PaisNac = $parametro->PaisNac;
       $pers->Nacionalidad = $parametro->Nacionalidad;
       $pers->Sexo = $parametro->Sexo;
       $pers->CuilCuit = $parametro->CuilCuit;
       $pers->Barrio = $parametro->Barrio;
       $pers->DomCalle = $parametro->DomCalle;
       $pers->DomNro = $parametro->DomNro;
       $pers->DomPiso = $parametro->DomPiso;
       $pers->DomDepto = $parametro->DomDepto;
       $pers->CuidadNac = $parametro->CiudadNac;
       $pers->Mail = $parametro->Mail;
       $pers->update();
    }
    
}
