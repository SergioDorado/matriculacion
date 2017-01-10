<?php

class CiudadNacimiento extends ActiveRecord
{
    public function ciudadord()
    {
        $ciudad = new CiudadNacimiento();
        return ($ciudad->find("order: Localidad"));
    }
    public function ciudadord2($param)
    {
        $ciudad = new CiudadNacimiento();
        return ($ciudad->find("conditions: Provincia=$param","order: Localidad"));
    }
}
