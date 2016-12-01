<?php

class Profesion extends ActiveRecord
{
    public function proforde() {
        $prof = new Profesion();
        return($prof->find("order: prf_refe"));
    }
    
    public function DevolverProfesion($cod)
    {
        $prof = new Profesion();
        return ($prof->find_first("id=$cod")->prf_refe);
    }
}
