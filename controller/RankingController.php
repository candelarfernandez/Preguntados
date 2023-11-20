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
        $data['primerosPuestos'] = $this->model->cargarPrimerosPuestos();
        $this->renderer->render('ranking', $data);
    }

    public function traerUsuariosPorPuntajeAjax(){
        $usuarios = $this->model->cargarUsuarios();
        header('Content-Type: application/json');
        echo json_encode(['usuarios' => $usuarios]);
    }

    public function verUsuario() {
        if ($_SESSION['usuario'] == null) {
            $urlOriginal = $_SERVER['REQUEST_URI'];
            $_SESSION['redirect_url'] = $urlOriginal;
            header('location: /login/list');
            exit();
        }
        $id_Usuario = $_GET['id'];
        $usuario = $this->model->obtenerDatosDelUsuarioPorID($id_Usuario);
        if(count($usuario['partidas']) > 0){
            $usuario['mostrarPartidas'] = true;
        }
        $this->renderer->render('jugador', $usuario);
    }

}