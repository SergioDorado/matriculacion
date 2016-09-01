<?php

class CarnetController extends AppController
{
    public function GenerarCarnet()
    {
        View::template(NULL);
        $this->NomCar = 'NOMBRE1 NOMBRE2';
        $this->ApeCar = 'APELLIDO';
        $this->DniCar = '12345678';
        $this->NacCar = 'ARGENTINA';
        $this->SexoCar = 'M';
        $this->FecEmiCar = '15/07/2015';
        $this->FecVenCar = '15/07/2020';
        $this->CodProfCar ='12345678912345';
        $this->ProfCar = 'TECNICO RADIOLOGO';
        $this->NumMatCar ='U026304M';
    }
}