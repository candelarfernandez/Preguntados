<?php

class LoginController {

    private $renderer;
    private $model;

    public function __construct($model, $renderer) {
        $this->model = $model;
        $this->renderer = $renderer;
    }

    public function list() {
       
        $this->renderer->render('login');
    }

    public function validarCuenta(){
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $codigo = $_GET['codigo'];

            $this->model->validarCuenta($codigo);
            $_SESSION['CuentaActivada'] = true;
            header('Location: /login/list');
            exit();
        }
    }


    public function verificarDatos(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = $_POST['login'];

            $errores = $this->model->ejecutarValidaciones($datos);

            if (empty($errores)) {
                header('location: /lobby/list');
                exit();
            } else{
                $this->renderer->render("login", $errores);
            }
        }
    }
}