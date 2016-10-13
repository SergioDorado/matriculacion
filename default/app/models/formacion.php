<?php

class Formacion extends ActiveRecord
{
    public function Guardar($tipo,$prof,$titulo,$fecheg,$rev,$fecrev,$instrev,$profref,$idpers,$profasoc,$orgreg)
    {
        $parametro = array('TipoFormacion'=>$tipo,'Profesion'=>$prof,'Titulo'=>$titulo,'FechaEgreso'=>$fecheg,
            'Revalida'=>$rev,'FechaRevalida'=>$fecrev,'InstitucionRevalida'=>$instrev,'ProfesionReferencia'=>$profref,
            'persona_id'=>$idpers,'ProfesionalAsociado'=>$profasoc,'OrganismoRegistro'=>$orgreg);
        $form = new Formacion($parametro);
        $form->save();
    }
}
