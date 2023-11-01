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
        if (!isset($_SESSION['partidaId'])) {
            $this->model->crearPartida();
        }
    
        $idPartid = $_SESSION['partidaId'];
        $idUsuario = $_SESSION['usuarioId'];
       
        if (!isset($_SESSION['preguntaActual'])) {
          
          
            $datosPregunta = $this->model->traerDatosPreguntas($idPartid, $idUsuario);
            $datosPregunta['mostrarImagen'] = true;
            $_SESSION['preguntaActual'] = $datosPregunta; 
       
        } else {
            
            $datosPregunta = $_SESSION['preguntaActual'];
        }
       
        $this->renderer->render('partida', $datosPregunta);
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
        $idUsuario = $_SESSION['usuarioId'];
        $esCorrecta = $this->model->verSiEsCorrecta($datos,$idUsuario);
       
        if($esCorrecta){
            $this->sumar();
            $alertas['mensaje'] = true;
            $alertas['seguirJugando'] = true;
            $alertas['puntaje'] = $_SESSION['puntaje'];
            unset($_SESSION['preguntaActual']);
            $this->renderer->render('partida', $alertas);
           
        }
        else {
            if($tiempoAgotado){
                $this->tiempoAgotado();
                
            } else {
                header('location: /lobby/list?rtaIncorrecta=true');
            }

            $this->model->guardarPuntaje($datosPartida);
            $this->restablecerPartida();
              
                unset($_SESSION['preguntaActual']);
            exit();
        }
        unset($_SESSION['preguntaActual']);

    }}

    public function tiempoAgotado() {

        $datosPartida = [
            'idUsuario' => $_SESSION['usuarioId'],
            'puntaje' => $_SESSION['puntaje'],
            'idPartida' => $_SESSION['partidaId']
        ];
    
        $this->model->guardarPuntaje($datosPartida);
        $this->restablecerPartida();
    
       
        echo json_encode(['success' => true]);
        exit();
    }
    
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
