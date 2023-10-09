<?php

class IntegrantesModel {

    private $database;

    public function __construct($database) {
        $this->database = $database;
    }
    public function add($nombre,$instrumento){
        $sql = "INSERT INTO `integrantes`( `nombre`, `instrumento`) 
                VALUES ( '" . $nombre . "', '" . $instrumento .  "' )";
        $this->database->execute($sql);
    }
}