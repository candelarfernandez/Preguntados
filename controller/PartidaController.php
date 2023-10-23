<?php

class PartidaController {

    private $renderer;
    private $model;
    private $puntaje;

    public function __construct($model, $renderer) {
        $this->model = $model;
        $this->renderer = $renderer;
        $this->puntaje = 0;
    }

    public function list() {
       // $data2['idUsuario'] = isset($_SESSION['idUsuario']) ? $_SESSION['idUsuario'] : false;

        $this->renderer->render('partida', $_SESSION['idUsuario']);
    }

    public function jugar(){
        if (!isset($_SESSION['partidaId'])){
            $this->crearPartidaSiNoExiste();
        }
        $_SESSION['puntaje'] =  $this->puntaje;
        $datosPregunta= $this->traerDatosPreguntas();
        $this->renderer->render('partida',$datosPregunta);
        
    }
    public function crearPartidaSiNoExiste(){

        $_SESSION['puntaje'] =  $this->puntaje;
        $datosPartida =[
            'idUsuario'=> $id_Usuario = $_SESSION['idUsuario'],
            'puntaje'=>  $_SESSION['puntaje']
        ];
        $this->model->crearPartida($datosPartida);
            $partida = $this->model->consultarIdPartida($_SESSION['idUsuario']);
            $_SESSION['partidaId'] = $partida;
    }

    public function respuesta(){
        $alertas = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = $_POST;

           $datosPartida =[
                'idUsuario'=> $id_Usuario = $_SESSION['idUsuario'],
                'puntaje'=> $_SESSION['puntaje'],
                'partidaId'=>$_SESSION['partidaId']
           ];
        $esCorrecta = $this->model->verSiEsCorrecta($datos);
       // $tiempo = $this->model->seTerminoElTiempoLimite($datos);
       
        if($esCorrecta){
            $alertas['mensaje'] = true;
            $alertas['seguirJugando'] = true;
            $alertas['puntaje'] = $_SESSION['puntaje'];
            $this->renderer->render('partida', $alertas);
            $suma = $this->sumar();         
        }else {
            $alertas['error'] = true;
           // var_dump($datosPartida);
            $this->model->guardarPuntaje($datosPartida);
            $this->renderer->render('lobby', $alertas);
            unset($_SESSION['partidaId']);
           ;


        }

}}
    public function traerDatosPreguntas(){
        $partida = $this->model->consultarIdPartida($_SESSION['idUsuario']);

        $_SESSION['partidaId'] = $partida;

    $pregunta= $this->model->traerPreguntaAleatoria($_SESSION['partidaId']);
    $respuestas= $this->model->traerRespuestas($pregunta['id']);
    //$tiempo= $this->model->traertiempoLimitePorPregunta();

    return $datosPregunta =[
        'pregunta'=> $pregunta,
        'respuestas'=>$respuestas
        //'tiempo_limite'=>$tiempo
        ];
    }

    public function sumar(){
        $this->puntaje++;
        $_SESSION['puntaje'] +=  $this->puntaje;
        var_dump( $_SESSION['puntaje']);
    }

      

}