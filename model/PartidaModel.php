<?php

class PartidaModel {

    private $database;
    
    public function __construct($database) {
        $this->database = $database;
    }


    public function traerDatosPreguntas($idPartid, $idUsuario){


        $error = false;
        $maxAttempts = 10;
        $attempts = 0;

        do {
            $pregunta = $this->traerPreguntaAleatoria($idUsuario);
                $estaUsadaLapregunta = $this->ValidarQueNoSeHayaUsadoLaPreguntaEnLaPartida($idPartid, $pregunta["id"]);
                $attempts++;
                if ($attempts >= $maxAttempts) {
                    $error = true;
                    break;
            }
        }while (($estaUsadaLapregunta));

        $respuestas = $this->traerRespuestas($pregunta['id']);

        $this->actualizarPreguntasEntregadasAlUsuario($idUsuario);
        $this->actualizarAparicionesDeLaPregunta($pregunta['id']);
        $this->calcularDificultadPregunta($pregunta["id"]);
        $categoria = $this->colorCategoria($pregunta["id_categoria"]);
        return $datosPregunta =[
            'pregunta'=> $pregunta,
            'respuestas'=>$respuestas,
            'categoria' => $categoria
        ];
    }

    public function crearPartida(){
        //Establecer el puntaje en 0
        $_SESSION['puntaje'] =  0;
        $datosPartida =[
            'idUsuario'=> $_SESSION['usuarioId'],
            'puntaje'=>  $_SESSION['puntaje']
        ];
        $sql = "INSERT INTO `partida` (`idUsuario`, `puntaje`, `fecha`) VALUES ('{$datosPartida['idUsuario']}', '{$datosPartida['puntaje']}', NOW())";
        $this->database->execute($sql);

        $partida = $this->consultarIdPartida($datosPartida['idUsuario']);

        $_SESSION['partidaId'] = $partida;
    }

    public function verSiEsCorrecta($datos, $idUsuario){
        $sql = "SELECT * FROM respuestas WHERE id = '{$datos['id']}'";
        $respuesta = $this->database->queryUnSoloRegistro($sql);
        if($respuesta['esCorrecta'] == "true"){

            $this->actualizarAciertosPregunta($respuesta['idPregunta']);
            $this->actualizarAciertosUsuario($idUsuario);
            return true;
        }else{
            return false;
        }
    }

    public function guardarPuntaje($datos){
        $puntaje = $datos['puntaje'];
        $partidaId = $datos ['idPartida'];
        $idUsuario =$datos ['idUsuario'];
        //Actualizar el puntaje de la partida
        $sql = "UPDATE partida SET puntaje = '$puntaje' WHERE id = '$partidaId'";
        $this->database->execute($sql);
        $this->actualizarPuntajeTotalUsuario($idUsuario);
        $this->calcularNivelUsuario($idUsuario);
    }
    public function calcularTiempoDeRespuesta($datosPartida){

        $tiempoinicial = $_SESSION["tiempoInicial"];
        $tiempoFinal = microtime(true);
        $tiempoDeRespuesta = $tiempoFinal - $tiempoinicial;
        $idPartida = $datosPartida['idPartida'];

        $sql = "UPDATE preguntasusadas SET tiempo = $tiempoDeRespuesta WHERE idPartida = $idPartida";
        $this->database->execute($sql);
    }

    //Métodos privados
    //Métodos utilizados en ($idPartid)

    private function traerPreguntaAleatoria($idUsuario) {
        $nivel = $this->consultarNivelUsuario($idUsuario);
        $sql = $this->traerPreguntasPorNivel($nivel);
    
        $listadoPreguntas = $this->database->query($sql);
        
        if (empty($listadoPreguntas)) {
            return false;
        }
        
        $numAleatorio = rand(0, sizeof($listadoPreguntas) - 1);
        $pregunta = $listadoPreguntas[$numAleatorio];
    
        $sqlCategoria = "SELECT * FROM categorias c WHERE c.id_categoria = '{$pregunta['id_categoria']}'";   
        $categoria = $this->database->queryUnSoloRegistro($sqlCategoria);
    
        $pregunta['categoria'] = $categoria;

        return $pregunta;
    }

    private function traerRespuestas($idPregunta) {
        $sql = "SELECT * FROM respuestas WHERE idPregunta = '{$idPregunta}' ORDER BY RAND()";
        return $this->database->query($sql);
    }

    private function ValidarQueNoSeHayaUsadoLaPreguntaEnLaPartida($partidaId, $idPregunta){
        /* $idPregunta = (string)$idPregunta; // Convierte a cadena si es necesario
         $partidaId = (string)$partidaId;   // Convierte a cadena si es necesario*/
 
         $sql = "SELECT * FROM `preguntasusadas` WHERE idPartida = '{$partidaId}' and idPregunta = '{$idPregunta}' ;";
         $resultado = $this->database->queryUnSoloRegistro($sql);
         if (is_null($resultado)){
             $tiempoInicial = microtime(true);
             $_SESSION['tiempoInicial'] = $tiempoInicial;

             $consulta = "INSERT INTO `preguntasusadas`( `idPregunta`,`idPartida` )   VALUES ( '{$idPregunta}','{$partidaId}');";
 
             $this->database->execute($consulta);
             return false;
         }else {
             return  true;
 
         }
     }




     //Métodos utilizados en crearPartida()

     private function consultarIdPartida($idUsuario){
        $sql =  "SELECT id FROM partida WHERE idUsuario = '$idUsuario' ORDER BY id DESC  LIMIT 1 ;";
        $partidaBuscada =  $this->database->query($sql);
        $idPart = ($partidaBuscada[0]['id']);

        return $idPart;

    }

    //Métodos utilizados en guardarPuntaje($datos)

    private function actualizarPuntajeTotalUsuario($idUsuario){
        $updateSql = "UPDATE usuarios AS u
        SET u.puntajeTotal = (
            SELECT SUM(puntaje)
            FROM partida AS p
            WHERE p.idUsuario = u.id
        )
        WHERE u.id = '{$idUsuario}'";
        $this->database->execute($updateSql);
    }

    //Métodos utilizados en 

    private function traertiempoLimitePorPregunta() {
        $sql = "SELECT tiempo_limite FROM preguntas";
        $resultado['tiempo'] = $this->database->query($sql);

        $listadoPreguntas= $this->database->query($sql);
        $numAleatorio = rand(0, sizeof($listadoPreguntas)-1);
        $resultado['pregunta'] =$listadoPreguntas[$numAleatorio];

        return $resultado;

    }
    public function agregarPreguntaReportada($idPreguntaReportada){
        $sql = "UPDATE preguntas SET reportada = 1 WHERE id = '$idPreguntaReportada'";
        $this->database->execute($sql);
    }
    private function actualizarAparicionesDeLaPregunta($idPregunta){
        $sql0 = "SELECT apariciones FROM preguntas WHERE id = $idPregunta";
        $resultado = $this->database->queryUnSoloRegistro($sql0);
        $apariciones =$resultado["apariciones"] +1 ;

        $sql = "UPDATE preguntas SET apariciones = $apariciones WHERE id = $idPregunta";
        $this->database->execute($sql);
    }
    private function actualizarAciertosPregunta($idPregunta){
        $sql0 = "SELECT aciertos FROM preguntas WHERE id = $idPregunta";
        $resultado = $this->database->queryUnSoloRegistro($sql0);
        $aciertos =$resultado["aciertos"] +1 ;

        $sql = "UPDATE preguntas SET aciertos = $aciertos WHERE id = $idPregunta";
        $this->database->execute($sql);
    }

    private function calcularDificultadPregunta($idPregunta){
        $sql = "SELECT apariciones FROM preguntas WHERE id = $idPregunta";
        $resultadoApariciones = $this->database->queryUnSoloRegistro($sql);

        $sql1 = "SELECT aciertos FROM preguntas WHERE id = $idPregunta";
        $resultadoAciertos = $this->database->queryUnSoloRegistro($sql1);

        if($resultadoApariciones["apariciones"]>10){
            $division = ($resultadoAciertos["aciertos"] / $resultadoApariciones["apariciones"]) * 100;
            $sqlUpdate = "";

            if ($division <= 30) {
                $sqlUpdate = "UPDATE preguntas SET dificultad = 3 WHERE id = $idPregunta";
            } elseif ($division> 30 && $division < 60) {
                $sqlUpdate = "UPDATE preguntas SET dificultad = 2 WHERE id = $idPregunta";
            } elseif ($division >= 60) {
                $sqlUpdate = "UPDATE preguntas SET dificultad = 1 WHERE id = $idPregunta";
            }
            $this->database->execute($sqlUpdate);
        }
    }
    private function actualizarPreguntasEntregadasAlUsuario($idUsuario){
        $sql0 = "SELECT cantRespuestas FROM usuarios WHERE id = $idUsuario";
        $resultado = $this->database->queryUnSoloRegistro($sql0);
        $cantRespuestas =$resultado["cantRespuestas"] + 1 ;

        $sql = "UPDATE usuarios SET cantRespuestas = $cantRespuestas WHERE id = $idUsuario";
        $this->database->execute($sql);
    }
    private function actualizarAciertosUsuario($idUsuario){
        $sql0 = "SELECT cantRespuestasCorrectas FROM usuarios WHERE id = $idUsuario";
        $resultado = $this->database->queryUnSoloRegistro($sql0);
        $cantRespuestasCorrectas =$resultado["cantRespuestasCorrectas"] + 1 ;

        $sql = "UPDATE usuarios SET cantRespuestasCorrectas = $cantRespuestasCorrectas WHERE id = $idUsuario";
        $this->database->execute($sql);
    }
    private function calcularNivelUsuario($idUsuario){
        $sql = "SELECT cantRespuestas FROM usuarios WHERE id = $idUsuario";
        $cantRespuestas  = $this->database->queryUnSoloRegistro($sql);

        $sql1 = "SELECT cantRespuestasCorrectas FROM usuarios WHERE id = $idUsuario";
        $cantRespuestasCorrectas = $this->database->queryUnSoloRegistro($sql1);

        if($cantRespuestas["cantRespuestas"]>10){
            $division = ($cantRespuestasCorrectas["cantRespuestasCorrectas"] / $cantRespuestas["cantRespuestas"]) * 100;
            $sqlUpdate = "";

            if ($division <= 30) {
                $sqlUpdate = "UPDATE usuarios SET nivel = 'principiante' WHERE id = $idUsuario";
            } elseif ($division> 30 && $division < 60) {
                $sqlUpdate = "UPDATE usuarios SET nivel = 'avanzado' WHERE id = $idUsuario";
            } elseif ($division >= 60) {
                $sqlUpdate = "UPDATE usuarios SET nivel = 'experto' WHERE id = $idUsuario";
            }
            $this->database->execute($sqlUpdate);
        }
    }

    private function consultarNivelUsuario($idUsuario){
        $sql = "SELECT nivel FROM usuarios WHERE id = $idUsuario";
        $nivelUsuario =$this->database->queryUnSoloRegistro($sql);

    return $nivelUsuario["nivel"];

    }
    private function traerPreguntasPorNivel($nivel){
        $sql = "";

        switch ($nivel){
            case "principiante": $sql = "SELECT * FROM preguntas WHERE dificultad IN (1,2)";
                break;
            case "avanzado": $sql = "SELECT * FROM preguntas WHERE dificultad IN (2,3)";
                break;
            case "experto" : $sql = "SELECT * FROM preguntas WHERE dificultad IN (3)";
                break;
        }
    return $sql;
    }

    private function colorCategoria($idCategoria){
        $color = "";

        switch($idCategoria){
            case 1: $color = "#FCA5A5";
                break;
            case 2: $color = "#FDBA74";
                break;
            case 3: $color = "#FCD34D";
                break;
            case 4: $color = "#C4B5FD";
                break;
            case 5: $color = "#BEF264";
                break;
            case 6: $color = "#67E8F9";
                break;
            case 7: $color = "#A5B4FC"; 
                break;
            case 8: $color = "#D8B4FE";
                break;
            case 9: $color = "#F9A8D4";
                break;
            case 10: $color = "#5EEAD4";
                break;
        }

        return $color;
    }

}

