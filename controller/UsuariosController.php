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
            if (isset($_FILES['registro']['foto']) && $_FILES['registro']['foto']['name']) {
                $imagenNombre = $this->model->subirFotoDePerfil($_FILES['registro']['foto']);
                $datos['foto'] = $imagenNombre; 
            }
        
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