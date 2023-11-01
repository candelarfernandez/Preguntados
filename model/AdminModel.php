<?php

class AdminModel
{

    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }
    public function TraerTodosLosJugadores(){
        $sql = "Select * from usuarios where idRol = 1  ";
       return $this->database->query($sql);

    }

}