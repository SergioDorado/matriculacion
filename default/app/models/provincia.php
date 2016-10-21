<?php
class Provincia extends ActiveRecord
{
    public function ProvOrd()
    {
        $prov = new Provincia();
        return $prov->find('order: nombre');
    }
}

