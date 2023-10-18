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
        $data['activarCuenta'] = isset($_SESSION['activarCuenta']) ? $_SESSION['activarCuenta'] : false;
        $this->renderer->render('login' , $data);
    }

    public function traerPreguntas(){
     //aca habria que mostrar las preguntas con sus respectivas opciones para que el usuario pueda elegir. hay que traerlas de la base
     $mostrarPreguntas = $this->model->mostrarPregunta();
     //como se muestran con la vista???? no entiendo eso jeje
    }
    public function validarCuenta(){
       
        
                    $this->model->validarCuenta($codigo);
                    $_SESSION['CuentaActivada'] = true;
                    unset($_SESSION['activarCuenta']);
                    header('Location: /login/list');
                    exit();
                }
}