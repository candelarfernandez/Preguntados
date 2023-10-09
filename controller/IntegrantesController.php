<?php

class IntegrantesController {

    private $model;
    private $renderer;

    public function __construct($model, $renderer) {
        $this->model = $model;
        $this->renderer = $renderer;
    }

    public function list(){
        header("location:/");
        exit();
    }

    public function addForm(){
        if(isset($_GET["estado"])){
            if($_GET['estado'] == "exito"){
                $data['exito'] = true;
            } else {
                $data['error'] = error;
            }
        }
        $this->renderer->render("integrantesForm",$data);
    }

    public function add(){
        $nombre = $_POST["nombre"];
        $instrumento = $_POST['instrumento'];

        $result = $this->model->add($nombre,$instrumento);


        header("location:/integrantes/addForm/estado=exito");
        exit();
    }
}