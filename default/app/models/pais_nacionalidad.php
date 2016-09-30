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
}
