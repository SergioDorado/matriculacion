<?php

class CiudadNacimiento extends ActiveRecord
{
    public function ciudadord()
    {
        $ciudad = new CiudadNacimiento();
        return ($ciudad->find("order: Localidad"));
    }
}
