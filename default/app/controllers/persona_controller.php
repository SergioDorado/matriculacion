<?php

Load::models('persona','documento','telefono','formacion','matriculacion');
class PersonaController extends AppController
{
    
     public function create()
    {
      /**
         * Se verifica si el usuario envio el form (submit) y si ademas 
         * dentro del array POST existe uno llamado "menus"
         * el cual aplica la autocarga de objeto para guardar los 
         * datos enviado por POST utilizando autocarga de objeto
         */
        if(Input::hasPost('persona')){
            /**
             * se le pasa al modelo por constructor los datos del form y ActiveRecord recoge esos datos
             * y los asocia al campo correspondiente siempre y cuando se utilice la convención
             * model.campo
             */
            $pesaux = new persona();
            $persona = new persona(Input::post('persona'));
            $docum = new documento(Input::post('documento'));
            $telef = new telefono(Input::post('telefono'));
            
            //En caso que falle la operación de guardar
            if($persona->create()){
                $idpersona =  $pesaux->find_first("order: id desc")->id;
                $persona->GuardarDoc($docum->tipodoc, $docum->nrodoc,$idpersona );
                $persona->GuardarTels($idpersona, $telef->TieneTel, $telef->Tipo1, $telef->NumTel1, $telef->Tipo2, $telef->NumTel2, $telef->Tipo3, $telef->NumTel3, $telef->Tipo4, $telef->NumTel4);
                //Flash::valid();
                //Eliminamos el POST, si no queremos que se vean en el form
                //Input::delete();
                return;               
            }else{
                Flash::error('Falló Operación');
            }
        }
    }
    
    public function formacion()
    {
        View::select('create');
        if(Input::hasPost('formacion')){
            $forma = new Formacion(Input::post('formacion'));
            $persona = new persona();
            $persona->GuardarForma($forma->TipoFormacion,$forma->Profesion,$forma->Titulo,$forma->FechaEgreso, $forma->Revalida,
                    $forma->FechaRevalida, $forma->InstitucionRevalida, $forma->ProfesionReferencia,$forma->instform, $forma->persona_id,
                    $forma->ProfesionalAsociado, $forma->OrganismoRegistro);
            Flash::valid('instoformf  '+$forma->instform);
        }else{
            Flash::error('Falló Operación');
        }
    }
    
    public function matricula()
    {
        View::select('create');
        if(Input::hasPost('matriculacion'))
        {
            $matricula = new Matriculacion(Input::post('matriculacion'));
            $persona = new persona();
            $persona->GuardarMatricula($matricula->Nromatricula,$matricula->FechaMat,$matricula->Situacion,$matricula->Provincia
                    ,$matricula->Profesionmat,$matricula->persona_id,$matricula->CodProfesional);
        }
    }

}
