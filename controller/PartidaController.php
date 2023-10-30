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
    
        // Verificar si ya hay una pregunta en la sesión
        if (!isset($_SESSION['preguntaActual'])) {
           // Obtener una nueva pregunta
          
            $datosPregunta = $this->model->traerDatosPreguntas($idPartid);
            $datosPregunta['mostrarImagen'] = true;
            $_SESSION['preguntaActual'] = $datosPregunta; 
         // Guardar la pregunta en la sesión
        } else {
            // Mostrar la pregunta existente
            $datosPregunta = $_SESSION['preguntaActual'];
        }
       
        $this->renderer->render('partida', $datosPregunta);
      
      /*  if (!isset( $_SESSION['partidaId'])){
        $this->model->crearPartida();
        }

        $idPartid = $_SESSION['partidaId'];

        $datosPregunta= $this->model->traerDatosPreguntas($idPartid);
        $datosPregunta['mostrarImagen'] = true;
        $this->renderer->render('partida',$datosPregunta);  */   
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
            unset($_SESSION['preguntaActual']);
            $this->renderer->render('partida', $alertas);
           
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
                unset($_SESSION['preguntaActual']);
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
