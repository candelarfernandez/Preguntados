<?php

class LobbyModel {

    private $database;

    public function __construct($database) {
        $this->database = $database;
    }


    public function buscarUsuarioPorMail($mail){
        $sql = "SELECT * FROM usuarios where mail='{$mail}'";
        $usuario = $this->database->queryUnSoloRegistro($sql);
        return $usuario;
    }
}