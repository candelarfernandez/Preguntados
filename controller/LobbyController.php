<?php

class LobbyController {

    private $renderer;
    private $model;

    public function __construct($model, $renderer) {
        $this->model = $model;
        $this->renderer = $renderer;

    }
    public function jugar(){
        $datosPregunta= $this->traerDatosPreguntas();
        $this->renderer->render('partida',$datosPregunta);
    }


    public function traerDatosPreguntas(){
   $pregunta= $this->model->traerPreguntaAleatoria();
   $respuestas= $this->model->traerRespuestas($pregunta['id']);
    return $datosPregunta =[
        'pregunta'=> $pregunta,
        'respuestas'=>$respuestas
        ];
    }



/*
public function list() {
    //aca habria que listar la pregunta con sus respectivas opciones
    $this->renderer->render('lobby');
}

*/
}