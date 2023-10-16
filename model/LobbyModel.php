<?php

class LobbyModel {

    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function traerPreguntaAleatoria() {
            $sql = "SELECT * FROM preguntas";
            $listadoPreguntas= $this->database->query($sql);
            $numAleatorio = rand(0, sizeof($listadoPreguntas)-1);
            return $listadoPreguntas[$numAleatorio];
    }
    public function traerRespuestas($idPregunta) {
        $sql = "SELECT * FROM respuestas WHERE idPregunta = '$idPregunta'";
        return $this->database->query($sql);
    }
    }




