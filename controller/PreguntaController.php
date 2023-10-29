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
        $data = [
            'preguntasSugeridas' => $preguntasSugeridas,
            'preguntasReportadas' => $preguntasReportadas
        ];
        $this->renderer->render('editor', $data);
    }

    public function sugerirPregunta(){
        $preguntaSugerida = $_POST['preguntaSugerida'];
        $this->model->agregarPreguntaSugerida($preguntaSugerida);
        header('location: /lobby/list?preguntaSugerida=true');
    }

}