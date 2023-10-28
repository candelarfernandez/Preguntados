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
        $puntaje = $datos['puntaje'];
        $partidaId = $datos ['idPartida'];
        $idUsuario =$datos ['idUsuario'];
        //$sql = "INSERT INTO partida (idUsuario, puntaje) VALUES ('{$idUsuario}', '{$puntaje}')";
        $sql = "UPDATE partida SET puntaje = '$puntaje' WHERE id = '$partidaId'";
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
    


    public function traertiempoLimitePorPregunta() {
        $sql = "SELECT tiempo_limite FROM preguntas";
        $resultado['tiempo'] = $this->database->query($sql);

        $listadoPreguntas= $this->database->query($sql);
        $numAleatorio = rand(0, sizeof($listadoPreguntas)-1);
        $resultado['pregunta'] =$listadoPreguntas[$numAleatorio];

        return $resultado;

    }

    public function consultarIdPartida($idUsuario){
        $sql =  "SELECT id FROM partida WHERE idUsuario = '$idUsuario' ORDER BY id DESC  LIMIT 1 ;";
        $partidaBuscada =  $this->database->query($sql);
        $idPart = ($partidaBuscada[0]['id']);

        return $idPart;

    }
    public function ValidarQueNoSeHayaUsadoLaPreguntaEnLaPartida($partidaId, $idPregunta){
       /* $idPregunta = (string)$idPregunta; // Convierte a cadena si es necesario
        $partidaId = (string)$partidaId;   // Convierte a cadena si es necesario*/

        $sql = "SELECT * FROM `preguntasusadas` WHERE idPartida = '{$partidaId}' and idPregunta = '{$idPregunta}' ;";
        $resultado = $this->database->queryUnSoloRegistro($sql);
        if (is_null($resultado)){
            $consulta = "INSERT INTO `preguntasusadas`( `idPregunta`,`idPartida` )   VALUES ( '{$idPregunta}','{$partidaId}');";

            $this->database->execute($consulta);
            return false;
        }else {
            return  true;

        }
    }

    public function crearPartida(){
        $_SESSION['puntaje'] =  0;
        $datosPartida =[
            'idUsuario'=> $id_Usuario = $_SESSION['usuarioId'],
            'puntaje'=>  $_SESSION['puntaje']
        ];
        $partida = $this->consultarIdPartida($_SESSION['usuarioId']);

        if(isset($partida)){
            $sql = "INSERT INTO `partida` (`idUsuario`, `puntaje`) VALUES ('{$datosPartida ['idUsuario']}','{$datosPartida['puntaje']}') ";
            $this->database->execute($sql);
        }

        $_SESSION['partidaId'] = $partida;
    }

    public function traerDatosPreguntas($idPartid){

        $maxAttempts = 10;
        $attempts = 0;

        do {
            $pregunta = $this->traerPreguntaAleatoria();
            $estaUsadaLapregunta = $this->ValidarQueNoSeHayaUsadoLaPreguntaEnLaPartida($idPartid, $pregunta["id"]);
            $attempts++;
            if ($attempts >= $maxAttempts) {
                break;
            }
        }while (($estaUsadaLapregunta));
        if ($attempts >= $maxAttempts) {
            var_dump("error");
        }
        $respuestas = $this->traerRespuestas($pregunta['id']);
        return $datosPregunta =[
            'pregunta'=> $pregunta,
            'respuestas'=>$respuestas
        ];
    }
    public function agregarPreguntaReportada($idPreguntaReportada){
        $sql = "UPDATE preguntas SET reportada = 1 WHERE id = '$idPreguntaReportada'";
        $this->database->execute($sql);
    }

   
}