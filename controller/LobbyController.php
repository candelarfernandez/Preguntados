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

        $this->renderer->render('lobby', $usuario);
    }

}

    public function traerPreguntas(){
     //aca habria que mostrar las preguntas con sus respectivas opciones para que el usuario pueda elegir. hay que traerlas de la base
     $mostrarPreguntas = $this->model->mostrarPregunta();
     //como se muestran con la vista???? no entiendo eso jeje
    }
    public function validarCuenta($codigo){
     $this->model->validarCuenta($codigo);
     $_SESSION['CuentaActivada'] = true;
     unset($_SESSION['activarCuenta']);
     header('Location: /login/list');
    exit();
     }


}

