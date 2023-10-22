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
        $pregunta =$listadoPreguntas[$numAleatorio];
        return $pregunta;
        /*$estaUsada =$this->verSiEstaUsadaLaPreguntaEnLaPartida($pregunta['id'],$idPartida);
        if (isset($estaUsada ) & $estaUsada != null ){
            $this->traerPreguntaAleatoria();

        } else{
            $consulta = "INSERT INTO `preguntasusadas`( `idPregunta`, `idPartida` ) 
                VALUES ( '{$pregunta['id']}','{$idPartida}');";
            $this->database->execute($consulta);
            return $pregunta;
        }*/


    }
    /*
    private function verSiEstaUsadaLaPreguntaEnLaPartida($idPregunta, $idPartida){
        $sql = "SELECT * FROM `preguntasusadas` WHERE idPregunta = '{$idPregunta}' and idPartida = '{$idPartida}' ;";
        $resultado =  $this->database->query($sql);
        return $resultado;

    }
*/


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


     public function  crearPartida($idUsuario){
         $sql = "INSERT INTO `partida`(idUsuario, puntaje) VALUES ($idUsuario,0);";
         $this->database->execute($sql);
     }

    public function ConsultarIdPartida($idUsuario){
      $sql =  "SELECT id FROM `partida` WHERE 'idUsuario' = $idUsuario ORDER BY id DESC LIMIT 1;";
     $idBuscado =  $this->database->query($sql);
     return $idBuscado;

    }

}