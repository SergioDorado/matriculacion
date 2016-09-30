<?php

Load::model('persona');
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
            $persona->id = $pesaux->find_first("order: id desc")->id +1;
            //En caso que falle la operación de guardar
            if($persona->create()){
                Flash::valid('Operación exitosa');
                //Eliminamos el POST, si no queremos que se vean en el form
                Input::delete();
                return;               
            }else{
                Flash::error('Falló Operación');
            }
        }
    }
    
}
