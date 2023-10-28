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

    public function obtenerPosicion(){
        $sql = "SELECT * FROM usuarios ORDER BY puntajeTotal DESC";
        $usuarios = $this->database->query($sql);
        $posicion = 1;
        foreach ($usuarios as $usuario) {
            if($usuario['mail'] == $_SESSION['usuario']){
                return $posicion;
            }
            $posicion++;
        }
    }
}
