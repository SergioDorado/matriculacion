<?php
class PaisNacionalidad extends ActiveRecord
{
    public function paisord() { //listado de paises ordenado por Pais
        $pais = new PaisNacionalidad();
        return ($pais->find("order: Pais"));
    }
    
    public function nacord() //Listado de Nacionalidades ordenado por nacionalidad
    {
        $nac = new PaisNacionalidad();
        return ($nac->find("order: Nacionalidad"));
    }
    
    public function Pais($cod)
    {
        $pais = new PaisNacionalidad(); 
        return ($pais->find_first("Codigo=$cod")->Pais);
    }
    
     public function Nacionalidad($cod)
    {
        $nac = new PaisNacionalidad(); 
        return ($nac->find_first("Codigo=$cod")->Nacionalidad);
    }
}
