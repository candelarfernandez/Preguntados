<?php

class LobbyModel {

    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function mostrarPregunta() {
            $sql = "SELECT p.pregunta, r.respuesta 
            FROM pregunta p
            JOIN respuesta r ON p.id = r.idPregunta
            ORDER BY RAND() LIMIT 1";
    
            $resultado = $this->database->query($sql);
    
            if ($resultado) {
                return $resultado->fetch(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
    
    }

    public function buscarUsuarioPorMail($mail){
        $sql = "SELECT * FROM usuarios where mail='{$mail}'";
        $usuario = $this->database->queryUnSoloRegistro($sql);
        return $usuario;
    }
}