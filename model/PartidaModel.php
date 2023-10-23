<?php

class PartidaModel
{

    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function traerPreguntaAleatoria($partidaId)
    {

        $pregunta = $this->buscPregunta();
        // Agrega el tiempo límite a la pregunta.
        $estaUsada = $this->verSiEstaUsadaLaPreguntaEnLaPartida($pregunta['id'], $partidaId);
        var_dump($estaUsada);
        if (isset($estaUsada)) {
            $pregunta= $this->buscPregunta();
            var_dump("entro por usada");
            // $this->traerPreguntaAleatoria($partidaId);
            // Agrega el tiempo límite a la pregunta.
            $estaUsada = $this->verSiEstaUsadaLaPreguntaEnLaPartida($pregunta['id'], $partidaId);
        } else {
            $consulta = "INSERT INTO `preguntasusadas`( `idPregunta`, `idPartida` )   VALUES ( '{$pregunta['id']}','{$partidaId}');";

            $this->database->execute($consulta);
            return $pregunta;
        }

    }
public function buscPregunta(){

    $sql = "SELECT * FROM preguntas";
    $listadoPreguntas = $this->database->query($sql);
    $numAleatorio = rand(0, sizeof($listadoPreguntas) -1);
    $pregunta = $listadoPreguntas[$numAleatorio];
    return $pregunta;
}
/*
    public function traerPreguntaAleatoria($partidaId) {
        $sql = "SELECT * FROM preguntas";
        $listadoPreguntas = $this->database->query($sql);
        $numAleatorio = rand(0, sizeof($listadoPreguntas) -1);
        $pregunta = $listadoPreguntas[$numAleatorio];

        $estaUsada = $this->verSiEstaUsadaLaPreguntaEnLaPartida($pregunta['id'], $partidaId);
        var_dump($estaUsada);
        while ($estaUsada) {
            $sql = "SELECT * FROM preguntas";
            $listadoPreguntas = $this->database->query($sql);
            $numAleatorio = rand(0, sizeof($listadoPreguntas) -1);
            $pregunta = $listadoPreguntas[$numAleatorio];
            $this->verSiEstaUsadaLaPreguntaEnLaPartida($pregunta['id'], $partidaId);

        }

        $consulta = "INSERT INTO `preguntasusadas` (`idPregunta`, `idPartida`) VALUES ('{$pregunta['id']}', '{$partidaId}');";
        $this->database->execute($consulta);

        return $pregunta;
    }

*/


/*
    public function traertiempoLimitePorPregunta() {
        $sql = "SELECT tiempo_limite FROM preguntas";
        $tiempo = $this->database->query($sql);
        return $tiempo;
        $listadoPreguntas= $this->database->query($sql);
        $numAleatorio = rand(0, sizeof($listadoPreguntas)-1);
        $pregunta =$listadoPreguntas[$numAleatorio];
        //return $pregunta;
        $estaUsada =$this->verSiEstaUsadaLaPreguntaEnLaPartida($pregunta['id'],$idPartida);
        if (isset($estaUsada ) & $estaUsada != null ){
            $this->traerPreguntaAleatoria();

        } else{
            $consulta = "INSERT INTO `preguntasusadas`( `idPregunta`, `idPartida` ) 
                VALUES ( '{$pregunta['id']}','{$idPartida}');";
            $this->database->execute($consulta);
            return $pregunta;
        }



    }*/

    /*private function verSiEstaUsadaLaPreguntaEnLaPartida($idPregunta, $partidaId){
        $sql = "SELECT * FROM `preguntasusadas` WHERE idPregunta = '{$idPregunta}' and idPartida = '{$partidaId}' ;";
        $resultado =  $this->database->queryUnSoloRegistro($sql);
        return $resultado;

    }*/
    private function verSiEstaUsadaLaPreguntaEnLaPartida($idPregunta, $partidaId){
        // Asegúrate de que $idPregunta y $partidaId sean valores escalares
        $idPregunta = (string)$idPregunta; // Convierte a cadena si es necesario
        $partidaId = (string)$partidaId;   // Convierte a cadena si es necesario

        $sql = "SELECT * FROM `preguntasusadas` WHERE idPregunta = '{$idPregunta}' and idPartida = '{$partidaId}' ;";
        $resultado = $this->database->query($sql);
        return $resultado;
    }




    public function traerRespuestas($idPregunta) {
        if (!is_null($idPregunta)){
        $sql = "SELECT * FROM respuestas WHERE idPregunta = '{$idPregunta}'";
        //var_dump($this->database->query($sql));
        return $this->database->query($sql);}

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
        $partidaId = $datos ['partidaId'];
    //$sql = "INSERT INTO partida (idUsuario, puntaje) VALUES ('{$idUsuario}', '{$puntaje}')";
        $sql = "UPDATE partida SET puntaje = '$puntaje' WHERE id = '$partidaId'";
        $this->database->execute($sql);
    }



    /*
        public function seTerminoElTiempoLimite($datos){
            $tiempo_limite = $this->traertiempoLimitePorPregunta();
            echo "<script>
            const tiempoLimite = $tiempo_limite;
            let tiempoRestante = tiempoLimite;

            const interval = setInterval(function() {
                tiempoRestante--;
                document.getElementById('tiempo-restante').textContent = tiempoRestante;

                if (tiempoRestante <= 0) {
                    clearInterval(interval);
                    // Realizar alguna acción, como marcar la respuesta como incorrecta y avanzar a la siguiente pregunta
                }
            }, 1000);
        </script>";
    return $tiempo_limite;
        }*/


     public function  crearPartida($datosPartida){
             $idUsuario = $datosPartida['idUsuario'];
             $puntaje = $datosPartida['puntaje'];
             $sql = "INSERT INTO partida (idUsuario, puntaje) VALUES ('$idUsuario[id]', '$puntaje');";
             $this->database->execute($sql);
         }


    public function consultarIdPartida($idUsuario){
      $sql =  "SELECT id FROM partida WHERE idUsuario = '$idUsuario[id]' ORDER BY id DESC  LIMIT 1 ;";
     $partidaBuscada =  $this->database->query($sql);
        var_dump($partidaBuscada);
        $idPart = ($partidaBuscada[0]['id']);

        return $idPart;

    }

}