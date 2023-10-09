<?php

class LoginController {

    private $renderer;
    private $model;

    public function __construct($renderer, $model) {
        $this->renderer = $renderer;
        $this->model = $model;
    }

    public function list() {
        $this->renderer->render("login");
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
        $contrasenia = $_POST["contrasenia"];
        $nombreUsuario = $_POST["nombreUsuario"];

        $result = $this->model->verify($nombreUsuario, $contrasenia);

        header("location:/login/verifyForm/estado=exito");
        exit();
    }
}