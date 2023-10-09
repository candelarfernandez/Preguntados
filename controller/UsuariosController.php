<?php

class UsuariosController {

    private $model;
    private $renderer;

    public function __construct($model, $renderer) {
        $this->model = $model;
        $this->renderer = $renderer;
    }

    public function list() {
        $data["usuarios"] = $this->model->getUsuarios();
        $this->renderer->render("usuarios", $data);
    }

    public function addForm(){
        $data=array();
        if(isset($_GET["estado"])){
            if($_GET['estado'] == "exito"){
                $data['exito'] = true;
            } else {
                $data['error'] = true;
            }
        }$this->renderer->render("registro",$data);
        
    }

    public function add(){
        $nombre = $_POST["nombre"];
        $anio = $_POST["anio"];
        $sexo = $_POST["sexo"];
        $pais = $_POST["pais"];
        $ciudad = $_POST["ciudad"];
        $mail = $_POST["mail"];
        $contrasenia = $_POST["contrasenia"];
        $confirmar_contrasena= $POST["confirmar_contrasena"];
        $nombreUsuario = $_POST["nombreUsuario"];
        $foto = $_POST["foto"];

        if($contrasenia == $confirmar_contrasena){
            $result = $this->model->add($nombre, $anio, $sexo, $pais, $ciudad, $mail, $contrasenia, $nombreUsuario, $foto);
            header("location:/usuarios/addForm/estado=exito");
            exit();
        } else {
            header("location:/usuarios/addForm/estado=error");
            exit();
        }
      
    }


    
}