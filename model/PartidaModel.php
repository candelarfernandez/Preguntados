<?php

class PartidaModel {

    private $database;
    
    public function __construct($database) {
        $this->database = $database;
    }

    public function traerPreguntaAleatoria() {
        $sql = "SELECT * FROM preguntas";
        $listadoPreguntas = $this->database->query($sql);
        $numAleatorio = rand(0, sizeof($listadoPreguntas) - 1);
        $pregunta = $listadoPreguntas[$numAleatorio];

        $sqlCategoria = "SELECT c.nombre_categoria, c.urlImagen FROM categorias c WHERE c.id_categoria = '{$pregunta['id_categoria']}'";   
        $categoria = $this->database->queryUnSoloRegistro($sqlCategoria);
    
        $pregunta['categoria'] = $categoria;
        
        return $pregunta;
    }

    public function traerRespuestas($idPregunta) {
        $sql = "SELECT * FROM respuestas WHERE idPregunta = '{$idPregunta}'";
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

    public function guardarPuntaje($datos){
        $idUsuario = $datos['idUsuario'];
        $puntaje = $datos['puntaje'];
    
        $sql = "INSERT INTO partida (idUsuario, puntaje) VALUES ('{$idUsuario}', '{$puntaje}')";
        $this->database->execute($sql);
    
        $updateSql = "UPDATE usuarios AS u
                      SET u.puntajeTotal = (
                          SELECT SUM(puntaje)
                          FROM partida AS p
                          WHERE p.idUsuario = u.id
                      )
                      WHERE u.id = '{$idUsuario}'";
        $this->database->execute($updateSql);
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

    public function traertiempoLimitePorPregunta() {
        $sql = "SELECT tiempo_limite FROM preguntas";
        $resultado['tiempo'] = $this->database->query($sql);

        $listadoPreguntas= $this->database->query($sql);
        $numAleatorio = rand(0, sizeof($listadoPreguntas)-1);
        $resultado['pregunta'] =$listadoPreguntas[$numAleatorio];

        return $resultado;

    }

}