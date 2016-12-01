<?php
Load::models('tipos_formacion','profesion','inst_form');
class Formacion extends ActiveRecord
{
    public function Guardar($tipo,$prof,$titulo,$fecheg,$rev,$fecrev,$instrev,$profref,$instiform,$idpers,$profasoc,$orgreg)
    {
        $parametro = array('TipoFormacion'=>$tipo,'Profesion'=>$prof,'Titulo'=>$titulo,'FechaEgreso'=>$fecheg,
            'Revalida'=>$rev,'FechaRevalida'=>$fecrev,'InstitucionRevalida'=>$instrev,'ProfesionReferencia'=>$profref,
            'instform'=>$instiform,'persona_id'=>$idpers,'ProfesionalAsociado'=>$profasoc,'OrganismoRegistro'=>$orgreg);
        $form = new Formacion($parametro);
        $form->save();
    }
    
    public function buscar($id)
    {
        $formac = new Formacion();
        return ($formac->find_first("persona_id=$id"));
    }
    
    public function Formatofeha($fecha)
    {
       $time= new DateTime($fecha);
       return $time->format('d/m/Y');
    }
    
    public function NivelFormacion($cod)
    {
        $tipo = new TiposFormacion();
        return ($tipo->NivelDeFormacion($cod));
    }
    
    public function ProfRefe($cod)
    {
        $prof = new Profesion();
        return ($prof->DevolverProfesion($cod));
    }
    
    public function Institucion($cod)
    {
        $inst = new InstForm();
        return ($inst->DevolverInstitucion($cod));
    }
}
