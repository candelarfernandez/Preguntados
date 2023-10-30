<?php

class RankingModel {

    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function cargarPrimerosPuestos(){
        $sql = "SELECT * FROM usuarios ORDER BY puntajeTotal DESC LIMIT 3";
        $resultado = $this->database->query($sql);
        $puestos['primero'] = $resultado[0];
        $puestos['segundo'] = $resultado[1];
        $puestos['tercero'] = $resultado[2];
        return $puestos; 
    }

    public function cargarUsuarios(){
        $sql = "SELECT * FROM usuarios
        ORDER BY puntajeTotal DESC";
        $resultado = $this->database->query($sql);
        return $resultado; 
    }

    public function obtenerDatosDelUsuarioPorID($id){
        $sql = "SELECT * FROM usuarios WHERE id = '{$id}'";
        $resultado['usuario'] = $this->database->queryUnSoloRegistro($sql);
        $resultado['partidas'] = $this->obtenerPartidasDelUsuario($id);
        return $resultado;
    }

    private function obtenerPartidasDelUsuario($id){
        $sql = "SELECT * FROM partida WHERE idUsuario = '{$id}' ORDER BY puntaje DESC LIMIT 5 ";
        $partidas = $this->database->query($sql);
        return $partidas;
    }
}