<?php

class PartidaController {

    private $renderer;
    private $model;
    // private $puntaje;
    // private $tiempoRestante;

    public function __construct($model, $renderer) {
        $this->model = $model;
        $this->renderer = $renderer;
        // $this->puntaje = 0;
        // $this->tiempoRestante = 20;
    }

    public function list() {
        $this->renderer->render('partida', $_SESSION['usuarioId']);
    }

    public function jugar(){
        unset($_SESSION['partidaId']) ;
        if (!isset($_SESSION['partidaId'])){
            $this->crearPartidaSiNoExiste();
        }
        $_SESSION['puntaje'] =  $this->puntaje;
        $datosPregunta= $this->traerDatosPreguntas();
        $this->renderer->render('partida',$datosPregunta);
        
        //Si no existe partida, crearla
        if (!isset( $_SESSION['partidaId'])){
        $this->model->crearPartida();
        }

        $idPartid = $_SESSION['partidaId'];

        $datosPregunta= $this->model->traerDatosPreguntas($idPartid);
        $datosPregunta['mostrarImagen'] = true;
        $this->renderer->render('partida',$datosPregunta);     
    }
    public function crearPartidaSiNoExiste(){

        $_SESSION['puntaje'] =  $this->puntaje;
        $datosPartida =[
            'idUsuario'=> $id_Usuario = $_SESSION['idUsuario'],
            'puntaje'=>  $_SESSION['puntaje']
        ];
        $this->model->crearPartida($datosPartida);
            $partida = $this->model->consultarIdPartida($_SESSION['idUsuario']);
            $_SESSION['partidaId'] = $partida;
    }

    public function respuesta(){
        $alertas = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = $_POST;

           $datosPartida =[

                'idUsuario'=> $_SESSION['usuarioId'],
                'puntaje'=> $_SESSION['puntaje'],
                'idPartida'=> $_SESSION['partidaId']
                ];
                
        $esCorrecta = $this->model->verSiEsCorrecta($datos);
       
        if($esCorrecta){
            $this->sumar();
            $alertas['mensaje'] = true;
            $alertas['seguirJugando'] = true;
            $alertas['puntaje'] = $_SESSION['puntaje'];
            $this->renderer->render('partida', $alertas);

            $this->sumar();

        }else {
            $alertas['error'] = true;
           // var_dump($datosPartida);
            var_dump($datosPartida);
            $this->model->guardarPuntaje($datosPartida);
            $this->renderer->render('lobby', $alertas);
            unset($_SESSION['partidaId']);
           ;


        }

}}
    public function traerDatosPreguntas(){
        $partida = $this->model->consultarIdPartida($_SESSION['idUsuario']);

        $_SESSION['partidaId'] = $partida;

    $pregunta= $this->model->traerPreguntaAleatoria($_SESSION['partidaId']);
    $respuestas= $this->model->traerRespuestas($pregunta['id']);
    //$tiempo= $this->model->traertiempoLimitePorPregunta();

    return $datosPregunta =[
        'pregunta'=> $pregunta,
        'respuestas'=>$respuestas
        //'tiempo_limite'=>$tiempo
        ];
        }
        else {
            $this->model->guardarPuntaje($datosPartida);
            $this->restablecerPartida();
            if(isset($_GET['tiempoAgotado']) && $_GET['tiempoAgotado'] == 'true'){
                header('location: /lobby/list?tiempoAgotado=true');
            }
                else{
                header('location: /lobby/list?rtaIncorrecta=true');
                }
            exit();
        }

    }}

    //Métodos privados

    private function sumar(){
        $_SESSION['puntaje'] +=  1;
    }

    private function restablecerPartida(){
        unset($_SESSION['partidaId']);
        unset($_SESSION['puntaje']);
    }      
   
    public function reportarPregunta(){
        $datos = $_GET;
        $this->model->agregarPreguntaReportada($datos['idPregunta']);
        header('location: /lobby/list?preguntaReportada=true');
    }


}  
