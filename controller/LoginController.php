<?php

class LoginController {

    private $renderer;
    private $model;

    public function __construct($model, $renderer) {
        $this->model = $model;
        $this->renderer = $renderer;
    }

    public function list() {
        $data['activarCuenta'] = isset($_SESSION['activarCuenta']) ? $_SESSION['activarCuenta'] : false;
        $this->renderer->render('login' , $data);
    }

    public function validarCuenta(){
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $codigo = $_GET['codigo'];

            $this->model->validarCuenta($codigo);
            $_SESSION['CuentaActivada'] = true;
            unset($_SESSION['activarCuenta']);
            header('Location: /login/list');
            exit();
        }
    }
   



    public function verificarDatos(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = $_POST['login'];

            $errores = $this->model->ejecutarValidaciones($datos);

            if (empty($errores)) {
                $_SESSION['usuario'] = $datos['mail'];
                $email = $datos['mail'];
                $usuarioId = $this->model->traerIdConMail($email);
                $_SESSION['usuarioId'] =  $usuarioId;

                if (isset($_SESSION['redirect_url'])) {
                    $redirectUrl = $_SESSION['redirect_url'];
                    unset($_SESSION['redirect_url']); 
                    header('location: ' . $redirectUrl);
                    exit();
                }else{
                    $this->model->verificarRol($email);
                }
            } else{
                $this->renderer->render("login", $errores);
            }
        }
    }
    }
