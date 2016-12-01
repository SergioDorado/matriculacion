<?php
class Provincia extends ActiveRecord
{
    public function ProvOrd()
    {
        $prov = new Provincia();
        return $prov->find('order: nombre');
    }
    
    public function DevolverProvincia($cod)
    {
        $prov = new Provincia();
        return ($prov->find_first("id=$cod")->nombre);
    }
}

