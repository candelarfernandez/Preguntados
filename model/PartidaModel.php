<?php

class PartidaModel {

    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function traerPreguntaAleatoria() {
        $sql = "SELECT * FROM preguntas";
        $listadoPreguntas= $this->database->query($sql);
        $numAleatorio = rand(0, sizeof($listadoPreguntas)-1);
      //  var_dump($listadoPreguntas[$numAleatorio]);
        return $listadoPreguntas[$numAleatorio];
    }
    
    public function traerRespuestas($idPregunta) {
    $sql = "SELECT * FROM respuestas WHERE idPregunta = '{$idPregunta}'";
    //var_dump($this->database->query($sql));
    return $this->database->query($sql);
    }

    public function verSiEsCorrecta($datos){
        $sql = "SELECT * FROM respuestas WHERE id = '{$datos['id']}'";
        $respuesta = $this->database->queryUnSoloRegistro($sql);
        if($respuesta['esCorrecta'] == "true"){
            return true;
        }else{
            return false;
        }
    }
}