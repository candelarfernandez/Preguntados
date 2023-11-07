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
        $categoriasDelJuego = $this->model->traerCategorias();
        $data = [
            'preguntasSugeridas' => $preguntasSugeridas,
            'preguntasReportadas' => $preguntasReportadas,
            'preguntasDelJuego' => $preguntasDelJuego,
            'categoriasDelJuego' => $categoriasDelJuego
        ];
        if(isset($preguntasSugeridas)){
            $data['mostrarpreguntasSugeridas'] = true;
        }
        if(isset($preguntasReportadas)){
            $data['mostrarPreguntasReportadas'] = true;
        }
        $this->renderer->render('editor', $data);
    }

    //PREGUNTAS SUGERIDAS

    public function sugerirPregunta(){
        $datos = $_POST['datos'];
        $this->model->agregarPreguntaSugerida($datos);
        header('location: /lobby/list?preguntaSugerida=true');
    }

    public function darDeAltaPreguntaSugerida(){
        $pregunta = $_POST['pregunta'];
        $idPregunta = $pregunta['idPreguntaSugerida'];
        $respuestas = $this->model->traerRespuestasDePreguntaSugerida($idPregunta);
        $idCategoria = $pregunta ['idCategoria'];
        $this->model->darDeAltaPreguntaSugerida($idPregunta,$idCategoria, $respuestas);
    }

    //PREGUNTAS REPORTADAS

    public function aprobarPreguntaReportada(){
        $idPregunta = $_GET['id'];
        $this->model->aprobarPreguntaReportada($idPregunta);
    }

    public function darDeAltaPreguntaReportada(){
        $idPregunta = $_GET['id'];
        $this->model->eliminarPreguntaReportada($idPregunta);
    }

    //PREGUNTAS

    public function darDeBajaPregunta(){
        $idPregunta = $_GET['id'];
        $this->model->eliminarPregunta($idPregunta);
    }

    public function darDeAltaNuevaPregunta(){
        $datos = $_POST['datos'];
        $this->model->agregarPregunta($datos);
    }
    public function modificarPregunta(){
        $datos = $_POST['datos'];
        $this->model->modificarPregunta($datos);
    }

    //CATEGORIAS

    public function darDeAltaCategoria(){
        $datos = $_POST;
        $datos['foto'] = $_FILES['foto'];
        $this->model->agregarCategoria($datos);
    }

    public function darDeBajaCategoria(){
        $idCategoria = $_GET['id'];
        $this->model->eliminarCategoria($idCategoria);
    }

    public function modificarCategoria(){
        $datos = $_POST['datos'];
        $this->model->modificarCategoria($datos);
    }
}