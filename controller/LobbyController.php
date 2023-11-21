<?php

class LobbyController
{


    private $renderer;
    private $model;


    public function __construct($model, $renderer)
    {

        $this->model = $model;
        $this->renderer = $renderer;
    }

    public function list()
    {
        if ($_SESSION['usuario'] == null) {
            header('location: /login/list');
            exit();
        }

        $usuario = $this->model->buscarUsuarioPorMail($_SESSION['usuario']);
        $usuario['ranking'] = $this->model->obtenerPosicion();
        $_SESSION['usuarioId'] = $usuario['id'];
        $this->model->generarQR($usuario['id']);

        if (isset($_GET['rtaIncorrecta'])) {
            $usuario['error'] = true;
        }
        if(isset($_GET['tiempoAgotado'])){
            $usuario['errorTiempo'] = true;
        }
        if (isset($_GET['preguntaSugerida'])) {
            $usuario['preguntaSugerida'] = true;
        }

        if (isset($_GET['preguntaReportada'])) {
            $usuario['preguntaReportada'] = true;
        }
        if(isset($_GET['noHayMasPreguntas'])){
            $usuario['noHayMasPreguntas'] = true;
        }

        $this->renderer->render('lobby', $usuario);
    }

    public function cerrarSesion()
    {
        session_destroy();
        header('location: /login/list');
        exit();
    }
    public function verMiPerfil() {
        if ($_SESSION['usuario'] == null) {
            $urlOriginal = $_SERVER['REQUEST_URI'];
            $_SESSION['redirect_url'] = $urlOriginal;
            header('location: /login/list');
            exit();
        }
        $usuario = $this->model->obtenerDatosDelUsuarioPorID($_SESSION['usuarioId']);
        if(count($usuario['partidas']) > 0){
            $usuario['mostrarPartidas'] = true;
        }
        $this->renderer->render('verMiPerfil', $usuario);
    
    }

    public function editarUsuario(){
        if ($datos = $_POST['usuario']) {  
            $errores = $this->model->ejecutarValidaciones($datos);

            if (empty($errores)) {
                if (isset($_GET['usuarioModificado'])) {
                    $errores['usuarioModificado'] = true;
                }
                header('location: /lobby/verMiPerfil?usuarioModificado=true');
                exit();
            } else {
                $this->renderer->render("verMiPerfil", $errores);
            }
        }
    }

}

