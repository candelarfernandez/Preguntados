<?php

class PartidaController {

    private $renderer;
    private $model;
    private $puntaje;
    private $tiempoRestante;

    public function __construct($model, $renderer) {
        $this->model = $model;
        $this->renderer = $renderer;
        $this->puntaje = 0;
        $this->tiempoRestante = 20;
    }

    public function list() {
        $this->renderer->render('partida', $_SESSION['idUsuario']);
       
    }

    public function jugar(){

        $datosPregunta= $this->traerDatosPreguntas();
        $datosPregunta['mostrarImagen'] = true;
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
       
        if($esCorrecta){
            $this->sumar();
            $alertas['mensaje'] = true;
            $alertas['seguirJugando'] = true;
            $alertas['puntaje'] = $_SESSION['puntaje'];
            $this->renderer->render('partida', $alertas);

        }else {
            $this->model->guardarPuntaje($datosPartida);
            $this->restablecerPuntaje();
            unset($_SESSION['puntaje']);
            if(isset($_GET['tiempoAgotado']) && $_GET['tiempoAgotado'] == 'true'){
                header('location: /lobby/list?tiempoAgotado=true');
                
            }else{
                header('location: /lobby/list?rtaIncorrecta=true');
            }
            
            exit();
    }

}}
    public function traerDatosPreguntas(){
    $pregunta= $this->model->traerPreguntaAleatoria();
    $respuestas= $this->model->traerRespuestas($pregunta['id']);

    return $datosPregunta =[
        'pregunta'=> $pregunta,
        'respuestas'=>$respuestas
        ];
    }

    public function sumar(){
        $this->puntaje++;
       // $_SESSION['puntaje'] +=  $this->puntaje;
        $_SESSION['puntaje'] +=  1;

        var_dump( $_SESSION['puntaje']);
    }

    private function restablecerPuntaje(){
        $this->puntaje = 0;
        $_SESSION['puntaje'] = 0;
    }      

}  
