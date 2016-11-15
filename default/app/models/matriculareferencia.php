<?php

class Matriculareferencia extends ActiveRecord
{
    public function buscar()
    {
        $nummat = new matriculareferencia();
        return ($nummat->find_first("order: id desc"));
    }
}