<?php

class LobbyController {

    private $renderer;
    private $model;

    public function __construct($model, $renderer) {
        $this->model = $model;
        $this->renderer = $renderer;
    }

    public function list() {
        //aca habria que listar la pregunta con sus respectivas opciones
        $this->renderer->render('lobby');
    }

    public function traerPreguntas(){
     //aca habria que mostrar las preguntas con sus respectivas opciones para que el usuario pueda elegir. hay que traerlas de la base
    }
}