<?php

class PartidaController {

    private $renderer;
    private $model;
    private $puntaje;

    public function __construct($model, $renderer) {
        $this->model = $model;
        $this->renderer = $renderer;
        $this->puntaje = 0;
    }

    public function list() {
        $this->renderer->render('partida');
    }

    public function jugar(){
        $datosPregunta= $this->traerDatosPreguntas();
        $this->renderer->render('partida',$datosPregunta);
        
    }

    public function respuesta(){
        $alertas = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = $_POST;
            
           $datosPartida =[
                'idUsuario'=> $id_Usuario = $_SESSION['usuarioId'],
                'puntaje'=> $_SESSION['puntaje']
                ];
        $esCorrecta = $this->model->verSiEsCorrecta($datos);
       // $tiempo = $this->model->seTerminoElTiempoLimite($datos);
       
        if($esCorrecta){
            $alertas['mensaje'] = true;
            $alertas['seguirJugando'] = true;
            $alertas['puntaje'] = $_SESSION['puntaje'];
            $this->renderer->render('partida', $alertas);
            $suma = $this->sumar();         
        }else {
            $alertas['error'] = true;
            var_dump($datosPartida);
            $this->model->guardarPuntaje($datosPartida);
            $this->renderer->render('lobby', $alertas);
    }

}}
    public function traerDatosPreguntas(){
    $pregunta= $this->model->traerPreguntaAleatoria();
    $respuestas= $this->model->traerRespuestas($pregunta['id']);
    //$tiempo= $this->model->traertiempoLimitePorPregunta();
    return $datosPregunta =[
        'pregunta'=> $pregunta,
        'respuestas'=>$respuestas
        //'tiempo_limite'=>$tiempo
        ];
    }

    public function sumar(){
        $this->puntaje++;
        $_SESSION['puntaje'] +=  $this->puntaje;
        var_dump( $_SESSION['puntaje']);
    }

      

}