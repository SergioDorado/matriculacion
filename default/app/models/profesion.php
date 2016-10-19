<?php

class Profesion extends ActiveRecord
{
    public function proforde() {
        $prof = new Profesion();
        return($prof->find("order: prf_refe"));
    }
}
