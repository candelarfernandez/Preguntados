<?php

class UsuariosController {

    private $model;
    private $renderer;

    public function __construct($model, $renderer) {
        $this->model = $model;
        $this->renderer = $renderer;
    }

    public function list(){
        $data = [];
        $this->renderer->render("registro", $data);
    }

    public function verificarDatos(){
        if ($datos = $_POST['registro']) {  
            $errores = $this->model->ejecutarValidaciones($datos);


            if (empty($errores)) {

                header('location: /mail/sendMail&usuario=' . urldecode($_POST['registro']['mail']));
                exit();
            } else {
                $this->renderer->render("registro", $errores);
            }
        }
    }


    
}