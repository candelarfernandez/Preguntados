<?php

class PartidaController {

    private $renderer;
    private $model;

    public function __construct($model, $renderer) {
        $this->model = $model;
        $this->renderer = $renderer;
    }

    public function list() {
        $this->renderer->render('partida');
    }

    public function jugar(){
        $datosPregunta= $this->traerDatosPreguntas();
        $this->renderer->render('partida',$datosPregunta);
    }

    public function respuesta(){
        $alertas = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = $_POST;
        $esCorrecta = $this->model->verSiEsCorrecta($datos);
        if($esCorrecta){
            $alertas['mensaje'] = true;
            $alertas['seguirJugando'] = true;
            $this->renderer->render('partida', $alertas);
        }else{
            $alertas['error'] = true;
            $this->renderer->render('lobby', $alertas);


    }
}}
    public function traerDatosPreguntas(){
    $pregunta= $this->model->traerPreguntaAleatoria();
    $respuestas= $this->model->traerRespuestas($pregunta['id']);
    return $datosPregunta =[
        'pregunta'=> $pregunta,
        'respuestas'=>$respuestas
        ];
    }

}