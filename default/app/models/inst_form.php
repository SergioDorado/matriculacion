<?php

class InstForm extends ActiveRecord
{
    public function instorde()
    {
        $inst = new InstForm();
        return ($inst->find("order: nombre"));
    }
    
    public function DevolverInstitucion($cod)
    {
        $inst = new InstForm();
        return ($inst->find_first("id=$cod")->nombre);
    }
}
