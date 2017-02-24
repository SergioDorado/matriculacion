<?php
Load::models('persona','formacion','matriculacion','telefono','documento','pais_nacionalidad');
//Load::lib('barcode.inc');
class ConstanciaController extends AppController
{
    public function Buscar() //Llama a la bista buscar para comprobar si el dni ingresado existe o no
    {
        $persona= new persona();
        $this->listaforma ='';
        $this->nomb = '';
        $this->apell = '';
        $this->docum = '';
        
        if (Input::hasPost('buscar1')) //Si hay post del formulario
        {
            $dni = Input::post('buscar1');   //capturamos el dni del imput
            if($persona->exists("dni=$dni"))  //si la persona existe
            { 
               $this->listaforma = Load::model('formacion')->ListaForma($persona->DevolverId($dni)); // creamos una lista con todas las formciones que la persona posea
               $aux = new persona();
               $aux = $persona->buscar($dni); // buscamos los datos de la persona y los pasamos a variables globales para llamarlas en la vista
               $this->nomb = $aux->Nombre;  
               $this->apell = $aux->Apellido;
               $this->docum = $dni;
            }
            else{Flash::error('Persona no encontrada');}
        }
    }
    
    public function GenerarConstancia($idformacion) // Accion que prepara los parametros de la constancia para pasarlos a la vista
    {
       View::template(NULL);  // Para no mostrar lo heredado por la master

       $persona1 = Load::model('persona')->buscarid(Load::model('formacion')->DevolverPersona($idformacion)); //Buscamos los datos de la persona a partir de la formación seleccionada
       //Pasamos todos los datos de la persona que necesitamos para la copnstancia a variables globales
       $this->NomCons = $persona1->Nombre;
       $this->ApeCons = $persona1->Apellido;
       $this->DniCons = $persona1->dni;
       $this->FnacCons = $persona1->Formatofeha($persona1->FechaNac);
       $this->PaisCons = Load::model('pais_nacionalidad')->Pais($persona1->PaisNac);
       $this->NacioCons = Load::model('pais_nacionalidad')->Nacionalidad($persona1->Nacionalidad);
       $this->SexoCons = $persona1->Sexo($persona1->Sexo);
       $this->CuilCons =$persona1->CuilCuit;
       $this->Padron = 'NO';
       $this->NroCerti = '*sin dato*';
       $this->FecCertif = '*sin dato*';
       $this->Juris1 = 'Jujuy';
       $this->Juris2 = '*sin dato*';
       $this->Juris3 = '*sin dato*';
       $this->Activo = 'SI';
       
       $forma = new Formacion();
       $forma = Load::model('formacion')->find_first("conditions: id=$idformacion"); //traemos los datos de la formacion seleccionada
       //Pasamos los datos de formación que necesitamos para la constancia a variable globales.
       $this->FecTitCons = $forma->Formatofeha($forma->FechaTitulo);
       $this->FormaCons = Load::model('formacion')->NivelFormacion($forma->TipoFormacion);
       $this->ProfRefeCons = Load::model('formacion')->ProfRefe($forma->ProfesionReferencia);
       $this->TituloCons = $forma->Titulo;
       $this->InstFormCons= Load::model('formacion')->Institucion($forma->instform);
       $this->RegistroCons = 'Ministerio de Salud de Jujuy';
       
       $mat = new Matriculacion();
       $mat = Load::model('matriculacion')->buscar($idformacion); //Buscamos los datos de la matricula de la formación seleccionada
       //Pasamos los datos de matricula que necesitamos para la constancia a variables globales
       $this->FecMatCons = $mat->Formatofeha($mat->FechaMat);
       $this->MatCons = $mat->Nromatricula;
       $this->ProfMatCons = Load::model('matriculacion')->Prof($mat->Profesionmat);
       $this->ProvCons = Load::model('matriculacion')->Prov($mat->Provincia);
       $this->SituacionCons = Load::model('matriculacion')->Habilitado($mat->Situacion);
       $this->CalleCons = $persona1->DomCalle;
       $this->NroDomCons = $persona1->DomNro;
       $this->PisoDomCons = $persona1->DomPiso;
       $this->DptoDomCons = $persona1->DomDepto;
       
       $tel = new telefono();
       $tel = Load::model('telefono')->buscar($persona1->id);
       $this->TipoTelCons = $tel->Tipo1;
       $this->NumTelCons = $tel->NumTel1;
       
       $this->FolioCons = substr($mat->Nromatricula,3,3); // separamaos el numero de matricula en libro y folio
       $this->LibroCons = substr($mat->Nromatricula,1,2);
       
       $doc = new documento();
       $doc = Load::model('documento')->buscar($persona1->id);
       $this->CodProfCons = '54'.$doc->tipodoc.'0'.$persona1->dni;// Armamos el codigo de profesional (54 + tipo de documento + 0 + nro de documento)
//       
//       //$this->CodBar = new barCodeGenrator($this->CodProfCons,0,190,130,VERDADERO);
       
    }
}