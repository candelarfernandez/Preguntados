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
    public function verifyForm(){
        if(isset($_GET["estado"])){
            if($_GET['estado'] == "exito"){
                $data['exito'] = true;
            } else {
                $data['error'] = error;
            }
        }
        $this->renderer->render("login",$data);
    }

    public function verify(){
        $nombreUsuario = $_POST["nombreUsuario"];
        $contrasenia = $_POST["contrasenia"];

        $result = $this->model->verify($nombreUsuario, $contrasenia);

        header("location:/login/verifyForm/estado=exito");
        exit();
    }
}