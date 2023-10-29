<?php

class PreguntaController {
    private $renderer;
    private $model;


    public function __construct($model, $renderer) {
        $this->model = $model;
        $this->renderer = $renderer;
    }

    public function list() {
        $this->renderer->render('preguntaSugerida');
    }
    public function editorList() {
        $preguntasSugeridas = $this->model->traerPreguntasSugeridas();
        $preguntasReportadas = $this->model->traerPreguntasReportadas();
        $preguntasDelJuego = $this->model->traerPreguntas();
        $data = [
            'preguntasSugeridas' => $preguntasSugeridas,
            'preguntasReportadas' => $preguntasReportadas,
            'preguntasDelJuego' => $preguntasDelJuego
        ];
        if(isset($preguntasSugeridas)){
            $data['mostrarpreguntasSugeridas'] = true;
        }
        if(isset($preguntasReportadas)){
            $data['mostrarPreguntasReportadas'] = true;
        }
        $this->renderer->render('editor', $data);
    }

    public function sugerirPregunta(){
        $preguntaSugerida = $_POST['preguntaSugerida'];
        $this->model->agregarPreguntaSugerida($preguntaSugerida);
        header('location: /lobby/list?preguntaSugerida=true');
    }

    public function darDeAltaPreguntaSugerida(){
        $pregunta = $_POST['pregunta'];
        $idPregunta = $pregunta['idPreguntaSugerida'];
        $idCategoria = $pregunta ['idCategoria'];
        var_dump($pregunta);
        $this->model->darDeAltaPreguntaSugerida($idPregunta,$idCategoria);
    }

    public function aprobarPreguntaReportada(){
        $idPregunta = $_GET['id'];
        $this->model->aprobarPreguntaReportada($idPregunta);
    }

    public function darDeAltaPreguntaReportada(){
        $idPregunta = $_GET['id'];
        $this->model->eliminarPreguntaReportada($idPregunta);
    }

    public function darDeBajaPregunta(){
        $idPregunta = $_GET['id'];
        $this->model->eliminarPregunta($idPregunta);
    }

    public function darDeAltaNuevaPregunta(){
        $datos = $_POST['datos'];
        var_dump($datos);
        $this->model->agregarPregunta($datos);
    }
}