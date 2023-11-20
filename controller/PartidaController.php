<?php

class PartidaController {

    private $renderer;
    private $model;
    private $tiempoAgotado;

    public function __construct($model, $renderer) {
        $this->model = $model;
        $this->renderer = $renderer;
        $this->tiempoAgotado = false;
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

        $datosPregunta['reportar'] = true;
       
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
            $this->model->calcularTiempoDeRespuesta($datosPartida);
        $idUsuario = $_SESSION['usuarioId'];
        $esCorrecta = $this->model->verSiEsCorrecta($datos,$idUsuario);

        if($esCorrecta){
            $this->sumar();
            $alertas['mensaje'] = true;
            $alertas['seguirJugando'] = true;
            $alertas['puntaje'] = $_SESSION['puntaje'];
            $alertas['reportar'] = false;
            unset($_SESSION['preguntaActual']);
            $this->renderer->render('partida', $alertas);
           
        }
        else {
            if($this->tiempoAgotado){
                header('location: //lobby/list?tiempoAgotado=true');
            }
            else{
            $this->model->guardarPuntaje($datosPartida);
            $this->restablecerPartida();
            unset($_SESSION['preguntaActual']);
            header('location: /lobby/list?rtaIncorrecta=true');
            exit();
            }


            }
       
        }
    }

    public function tiempoAgotado() {
        $this->tiempoAgotado = true;

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
        $idPregunta = $_POST['idPregunta'];
        $this->model->agregarPreguntaReportada($idPregunta);
        echo json_encode(['status' => 'success']);
        exit;
    }
    

}  
