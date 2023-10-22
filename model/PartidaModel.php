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
        
        // Agrega el tiempo límite a la pregunta
        
        return $pregunta;
    }

    public function traertiempoLimitePorPregunta() {
        $sql = "SELECT tiempo_limite FROM preguntas";
        $tiempo = $this->database->query($sql);
        return $tiempo;
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
    

  
    
    
}