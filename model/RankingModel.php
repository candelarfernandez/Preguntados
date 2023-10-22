<?php

class RankingModel {

    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function cargarUsuarios(){
        $sql = "SELECT * FROM usuarios ORDER BY puntajeTotal DESC";
        $resultado = $this->database->query($sql);
        return $resultado; 
    }

    public function obtenerDatosDelUsuarioPorID($id){
        $sql = "SELECT * FROM usuarios WHERE id = '{$id}'";
        $resultado = $this->database->queryUnSoloRegistro($sql);
        return $resultado;
    }
}