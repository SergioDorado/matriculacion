<?php
Load::models('persona','formacion','matriculacion','telefono','documento','pais_nacionalidad');
//Load::lib('barcode.inc');
class ConstanciaController extends AppController
{
    public function Buscar()
    {
        if (Input::hasPost('buscar1'))
        {
            //Flash::valid('Hay post');
            $dni = Input::post('buscar1');
            $persona= new persona();
            if($persona->exists("dni=$dni"))
            {
               View::select('GenerarConstancia'); 
               $this->GenerarConstancia($dni) ;
            }
            else{Flash::error('Persona no encontrada');}
        }
    }
    
    public function GenerarConstancia($dni)
    {
       View::template(NULL);
       $persona1 = new persona();
       $persona1 = Load::model('persona')->buscar($dni);
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
       $forma = Load::model('formacion')->buscar($persona1->id);
       $this->FecEgreCons = $forma->Formatofeha($forma->FechaEgreso);
       $this->FormaCons = Load::model('formacion')->NivelFormacion($forma->TipoFormacion);
       $this->ProfRefeCons = Load::model('formacion')->ProfRefe($forma->ProfesionReferencia);
       $this->TituloCons = $forma->Titulo;
       $this->InstFormCons= Load::model('formacion')->Institucion($forma->instform);
       $this->RegistroCons = 'Ministerio de Salud de Jujuy';
       
       $mat = new Matriculacion();
       $mat = Load::model('matriculacion')->buscar($persona1->id);
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
       
       $this->FolioCons = substr($mat->Nromatricula,3,3);
       $this->LibroCons = substr($mat->Nromatricula,1,2);
       
       $doc = new documento();
       $doc = Load::model('documento')->buscar($persona1->id);
       $this->CodProfCons = '54'.$doc->tipodoc.'0'.$persona1->dni;
       
       //$this->CodBar = new barCodeGenrator($this->CodProfCons,0,190,130,VERDADERO);
       
    }
}