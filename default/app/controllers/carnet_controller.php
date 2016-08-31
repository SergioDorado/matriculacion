<?php

class CarnetController extends AppController
{
    public function GenerarCarnet()
    {
        View::template(NULL);
        $this->NomCar = 'hola mundo';
    }
}