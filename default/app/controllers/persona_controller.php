<?php

Load::models('persona','documento','telefono','formacion','matriculacion');
class PersonaController extends AppController
{
    public function documentacion()
    {
        If(Input::hasPost('cuil','dni'))
        {
            View::select('create');
        }
        else{ Flash::error('FALTAN REQUISITOS OBLIGATORIOS, NO SE PUEDEN EMPEZAR LOS TRAMITES!!'); }
    }
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
                $persona->GuardarDoc($docum->tipodoc,$idpersona );
                $persona->GuardarTels($idpersona, $telef->TieneTel, $telef->Tipo1, $telef->NumTel1, $telef->Tipo2, $telef->NumTel2, $telef->Tipo3, $telef->NumTel3, $telef->Tipo4, $telef->NumTel4);
                Flash::valid('Carga de DATOS PERSONALES Exitosa');
                //Eliminamos el POST, si no queremos que se vean en el form
                //Input::delete();
                $this->formacion1($idpersona);
                View::select('formacion1');
                return;               
            }else{
                Flash::error('Falló Operación');
            }
        }
    }
    
    public function formacion1($id)
    {
        $persona = new persona();
        $this->persona =$persona->find($id);
        
        $this->param1 = $id;

        if(Input::hasPost('formacion')){
            $forma = new Formacion(Input::post('formacion'));
            $profrefe = $forma->Referencia($forma->Profesion);
            $persona->GuardarForma($forma->TipoFormacion,$forma->Profesion,$forma->Titulo,$forma->FechaEgreso, $forma->Revalida,
                    $forma->FechaRevalida, $forma->InstitucionRevalida, $profrefe,$forma->instform, $id,
                    $forma->ProfesionalAsociado, $forma->OrganismoRegistro);
            Flash::valid('Carga de DATOS PROFESIONALES Exitosa');
            $this->matricula1($id);
            View::select('matricula1');
        }else{
            //Flash::error('Falló Operación');
        }
    }
    
    public function matricula1($id)
    {
        $persona = new persona();
        $this->persona =$persona->find($id);
        $this->paramet2 = $id;
        $formacion = new Formacion();
        $this->formacion = $formacion->find("conditions: persona_id=$id");
        $nivel = $formacion->find_first("conditions: persona_id=$id")->TipoFormacion;
        if(Input::hasPost('matriculacion'))
        {
            $doc = new documento();
            $doc = Load::model('documento')->buscar($persona->id);
            $codigoprof = ('54'.$doc->tipodoc.'0'.$persona->dni);
            $matricula = new Matriculacion(Input::post('matriculacion'));
            $persona->GuardarMatricula($matricula->GenerarNro($nivel),$matricula->FechaMat,$matricula->Situacion,$matricula->Provincia
                    ,$matricula->Profesionmat,$id,$codigoprof);
            Flash::valid('Carga de DATOS DE MATRICULA Exitosa');
        }
    }
    
    public function verificar()
    {
        if(Input::hasPost('verificar1'))
        {
            $dni = Input::post('verificar1');
            $persona= new persona();
            if($persona->exists("dni=$dni"))
            {
               View::select('modificar');
               $this->modificar($dni);                     
            }
            else{Flash::error('Persona no encontrada');} 
        }
    }
    
    public function modificar($dni)
    {
        $persona = new persona();
        $formacion = new Formacion();
        $matricula = new Matriculacion();
        $this->Modparam = $dni;
        If(Input::hasPost('persona'))
        {
            $parametros = new persona(Input::post('persona'));
            $persona->Modificar($dni, $parametros);
            Flash::valid('Modificacion exitosa');
            $this->persona = $persona->find_first("conditions: dni=$dni");
            $id = $persona->DevolverId($dni);
            $this->formacion = $formacion->find_first("conditions: persona_id=$id");
            $this->matriculacion = $matricula->find_first("conditions: persona_id=$id");
        }
        else
            {
                $this->persona = $persona->find_first("conditions: dni=$dni");
                $id = $persona->DevolverId($dni);
                $this->formacion = $formacion->find_first("conditions: persona_id=$id");
                $this->matriculacion = $matricula->find_first("conditions: persona_id=$id");
            }
                
    }
    
    public function modifdatospers($dni)
    {
        View::select(modificar);
        $formacion = new Formacion();
        $id = Load::model('persona')->DevolverId($dni);
        if(Input::hasPost('formacion'))
        {
            if($formacion->update(Input::post('formacion')))
            {
                Flash::valid('Modificación Exitosa');
            }
        }
        else
        {
            $id = Load::model('persona')->DevolverId($dni);
            $this->formacion = $formacion->find_first("conditions: persona_id=$id");
        }
    }
    
    public function modifmat($dni)
    {
        $matricula = new Matriculacion();
        If(Input::hasPost('matriculacion'))
        {
            
        }
    }
    
    public function pruebaajax()
    {
        
    }

}
