<?php
class TiposFormacion extends ActiveRecord
{
    public function NivelDeFormacion($cod)
    {
        $tipo = new TiposFormacion();
        return ($tipo->find_first("id=$cod")->nombre);
    }
}
