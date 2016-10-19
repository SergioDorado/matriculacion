<?php

class InstForm extends ActiveRecord
{
    public function instorde()
    {
        $inst = new InstForm();
        return ($inst->find("order: nombre"));
    }
            
}
