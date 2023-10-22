<?php

class LobbyController {

    private $renderer;
    private $model;

    public function __construct($model, $renderer) {
        $this->model = $model;
        $this->renderer = $renderer;
    }

    public function list() {
        IF($_SESSION['usuario'] == null){
            header('location: /login/list');
            exit();
        }
        $data = [$usuario, $partidas];
        $usuario = $this->model->buscarUsuarioPorMail($_SESSION['usuario']);
        $partidas = [ ];
        var_dump($data);
        $this->renderer->render('lobby', $data);
    }

}