<?php

class Profesiones extends ActiveRecord
{
    public function ProfesOrde()
    {
        $prof = new Profesiones();
        return $prof->find('order: profesion');
    }
}

