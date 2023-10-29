<?php
class PreguntaModel {

    private $database;
    
    public function __construct($database) {
        $this->database = $database;
    }

    public function agregarPreguntaSugerida($preguntaSugerida){
        $sql = "INSERT INTO `preguntassugeridas`(`descripcion`) VALUES ('{$preguntaSugerida}')";
        $this->database->execute($sql);
    }
    public function traerPreguntasSugeridas(){
        $sql = "SELECT * FROM `preguntassugeridas`";
        return $this->database->query($sql);
    }
    public function traerPreguntasReportadas(){
        $sql = "SELECT * FROM `preguntas` WHERE reportada = 1";
        return $this->database->query($sql);
    }
}