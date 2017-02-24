<?php

class Profesiones extends ActiveRecord
{
    public function ProfesOrde()
    {
        $prof = new Profesiones();
        return $prof->find('order: profesion');
    }
    
     public function ProfesOrde2()
    {
        $prof = new Profesiones();
        return ($prof->find("conditions: mostrar = 'SI'","order: profesion"));
    }
    
    public function DevolverProfesion($cod)
    {
        $prof = new Profesiones();
        return ($prof->find_first("id=$cod")->profesion);
    }
    
    public function DevolverProfRef($cod) //Devuelve el codigo de la profecion de referencia asociada a la profesion con codigo $cod
    {
        $prof =  new Profesiones();
        return($prof->find_first("id=$cod")->codprofref);
    }
    
   public function DevolverNombProfRef($cod) //Devuelve el nombre de la profecion de referencia asociada a la profesion con codigo $cod
    {
        $prof =  new Profesiones();
        return($prof->find_first("id=$cod")->profesionref);
    }
}

