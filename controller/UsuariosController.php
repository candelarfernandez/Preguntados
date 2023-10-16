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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = $_POST['registro'];

            // Ejecutar validaciones y obtener errores
            $errores = $this->model->ejecutarValidaciones($datos);

            if (empty($errores)) {
                // No hay errores, el registro fue exitoso
                header('location: /mail/sendMail&usuario=' . urldecode($_POST['registro']['mail']));
                exit();
            } else{
                $this->renderer->render("registro", $errores);
            }
        }
    }


    
}