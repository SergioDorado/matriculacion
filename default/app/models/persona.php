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
        $doc->Guardar($tipo,$nro,$idpersona); // pasa los parametros al modelo documento donde se realiza el guardado
    }
    
    public function GuardarTels($id,$tiene,$tipo1,$tel1,$tipo2,$tel2,$tipo3,$tel3,$tipo4,$tel4) //Guarda el o los telefonos del matriculado
    {
        Load::model('telefono');
        $telef = new telefono();
        $telef->Guardar($id, $tiene, $tipo1, $tel1, $tipo2, $tel2, $tipo3, $tel3, $tipo4, $tel4); // pasa los parametros al modelo telefono donde se raliza 
        
    }
    
    public function GuardarForma($tipo,$prof,$titulo,$fecheg,$rev,$fecrev,$instrev,$profref,$idpers,$profasoc,$orgreg)
    {
        Load::model('formacion');
        $form = new Formacion();
        $form->Guardar($tipo, $prof, $titulo, $fecheg, $rev, $fecrev, $instrev, $profref, $idpers, $profasoc, $orgreg);
    }
}
