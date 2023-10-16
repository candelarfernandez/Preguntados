<?php

class LobbyController {

    private $renderer;
    private $model;
    private $lobbyModel;

    public function __construct($model, $renderer,$lobbyModel) {
        $this->model = $model;
        $this->renderer = $renderer;
        $this->lobbyModel=$lobbyModel;
    }


    public function jugar(){
        $this->renderer->render('partida',$this->traerDatosPreguntas());
    }


    public function traerDatosPreguntas(){
   $pregunta= $this->lobbyModel->traerPreguntaAleatoria();
   $respuestas= $this->lobbyModel->traerRespuestas($pregunta['id']);
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