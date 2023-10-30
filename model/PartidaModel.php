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

    public function crearPartida(){
        //Establecer el puntaje en 0
        $_SESSION['puntaje'] =  0;
        $datosPartida =[
            'idUsuario'=> $_SESSION['usuarioId'],
            'puntaje'=>  $_SESSION['puntaje']
        ];

        //Crear la partida
        $sql = "INSERT INTO `partida` (`idUsuario`, `puntaje`, `fecha`) VALUES ('{$datosPartida['idUsuario']}', '{$datosPartida['puntaje']}', NOW())";
        $this->database->execute($sql);

        //Obtener el id de la partida creada
        $partida = $this->consultarIdPartida($datosPartida['idUsuario']);


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

        $_SESSION['partidaId'] = $partida;
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
        //Actualizar el puntaje de la partida

        $sql = "UPDATE partida SET puntaje = '$puntaje' WHERE id = '$partidaId'";
        $this->database->execute($sql);
        $this->actualizarPuntajeTotalUsuario($idUsuario);
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
    //Métodos privados
    //Métodos utilizados en traerDatosPreguntas($idPartid)

    private function traerPreguntaAleatoria() {
        $sql = "SELECT * FROM preguntas";
        $listadoPreguntas = $this->database->query($sql);
        $numAleatorio = rand(0, sizeof($listadoPreguntas) - 1);
        $pregunta = $listadoPreguntas[$numAleatorio];

        $sqlCategoria = "SELECT c.nombre_categoria, c.urlImagen FROM categorias c WHERE c.id_categoria = '{$pregunta['id_categoria']}'";   
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

   
}