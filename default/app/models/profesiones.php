<?php

class Profesiones extends ActiveRecord
{
    public function ProfesOrde()
    {
        $prof = new Profesiones();
        return $prof->find('order: profesion');
    }
    
    public function DevolverProfesion($cod)
    {
        $prof = new Profesiones();
        return ($prof->find_first("id=$cod")->profesion);
    }
}

