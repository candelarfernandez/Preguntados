<?php

class LobbyController
{


    private $renderer;
    private $model;


    public function __construct($model, $renderer)
    {

        $this->model = $model;
        $this->renderer = $renderer;
    }

    public function list()
    {
        if ($_SESSION['usuario'] == null) {
            header('location: /login/list');
            exit();
        }

        $usuario = $this->model->buscarUsuarioPorMail($_SESSION['usuario']);
        $_SESSION['usuarioId'] = $usuario['id'];

        if (isset($_GET['rtaIncorrecta'])) {
            $usuario['error'] = true;
        }
        if(isset($_GET['tiempoAgotado'])){
            $usuario['errorTiempo'] = true;
        }

        $this->renderer->render('lobby', $usuario);
    }

}

