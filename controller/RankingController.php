<?php

class RankingController {

    private $renderer;
    private $model;

    public function __construct($model, $renderer) {
        $this->model = $model;
        $this->renderer = $renderer;
    }

    public function list() {
        IF($_SESSION['usuario'] == null){
            header('location: /login/list');
            exit();
        }
        $usuarios = $this->model->cargarUsuarios();
        $this->renderer->render('ranking', ['usuarios' => $usuarios]);
    }

    public function verUsuario() {
        IF($_SESSION['usuario'] == null){
            header('location: /login/list');
            exit();
        }
        $id_Usuario = $_GET['id'];
        $usuario = $this->model->obtenerDatosDelUsuarioPorID($id_Usuario);
        $this->renderer->render('jugador', $usuario);
    }

}