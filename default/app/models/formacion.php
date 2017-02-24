<?php
Load::models('tipos_formacion','profesion','inst_form','profesiones');
class Formacion extends ActiveRecord
{
    public function Guardar($tipo,$prof,$titulo,$fecheg,$fechatit,$rev,$fecrev,$instrev,$profref,$instiform,$idpers,$profasoc,$orgreg)
    {
        $parametro = array('TipoFormacion'=>$tipo,'Profesion'=>$prof,'Titulo'=>$titulo,'FechaEgreso'=>$fecheg,
            'FechaTitulo'=>$fechatit,'Revalida'=>$rev,'FechaRevalida'=>$fecrev,'InstitucionRevalida'=>$instrev,
            'ProfesionReferencia'=>$profref,'instform'=>$instiform,'persona_id'=>$idpers,'ProfesionalAsociado'=>$profasoc,
            'OrganismoRegistro'=>$orgreg);
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
    
    public function Referencia($cod)// Parametro que recibe: Codigo de Profesion
    {                               // Devuelve el codigo de profesion de referencia asociado al codigo de profesion
        $profs = new Profesiones(); // que llega como parametro
        return($profs->DevolverProfRef($cod));
    }
    
    public function NombReferencia($cod) //Parametro recibido: Codigo de Profesion
    {                                    //Devuelve el nombre de la profesion de referencia asociado al codigo de profesion   
        $profs = new Profesiones();      //que llega como parametro
        return($profs->DevolverNombProfRef($cod));
    }
    
    public function Modificar($id,$parametro)
    {
        $forma = new Formacion();
        $forma->TipoFormacion = $parametro->TipoFormacion;
        $forma->Profesion = $parametro->Profesion;
        $forma->Titulo = $parametro->Titulo;
        $forma->FechaEgreso = $parametro->FechaEgreso;
        $forma->Revalida = $parametro->Revalida;
        $forma->FechaRevalida= $parametro->FechaRevalida;
        $forma->InstitucionRevalida = $parametro->InstitucionRevalida;
        $forma->ProfesionReferencia= $parametro->ProfesionReferencia;
        $forma->instform = $parametro->instform;
        $forma->ProfesionalAsociado = $parametro->ProfesionalAsociado;
        $forma->OrganismoRegistro = $parametro->OrganismoRegistro;
        $forma->update();
    }
    
    public function ListaForma($id)
    {
        $forma = new Formacion();
        return $forma->find("conditions: persona_id=$id");
    }
    
    public function DevolverPersona($idform)
    {
        $forma = new Formacion();
        return $forma->find_first($idform)->persona_id;
    }
}
