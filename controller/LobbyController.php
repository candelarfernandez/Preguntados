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

        $usuario = $this->model->buscarUsuarioPorMail($_SESSION['usuario']);
        $_SESSION['usuarioId'] = $usuario['id'];
        $this->renderer->render('lobby', $usuario);
    }

}