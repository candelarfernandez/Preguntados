<?php

class AdminController
{

    private $renderer;
    private $model;


    public function __construct($model, $renderer)
    {

        $this->model = $model;
        $this->renderer = $renderer;
    }
    public function list() {
        $this->renderer->render('admin');
    }

     public function traerPreguntas(){
      $preguntas = $this->model->traerPreguntas();
         $preguntasDelJuego = [
             'preguntasDelJuego' => $preguntas
         ];
         $this->renderer->render('PreguntasListado', $preguntasDelJuego);
     }

     public function traerPreguntasCreadas(){
        $preguntasSug = $this->model->traerPreguntasSugeridas();
        $preguntasSugeridas = [
            'preguntasSugeridas' => $preguntasSug
        ];
        $this->renderer->render('preguntasSugeridasListado', $preguntasSugeridas);
     }


    public function traerJugadores() {
        $jugadores = $this->model->traerTodosLosJugadores();
        $totalUsuarios = count($jugadores);

        // Calcular el porcentaje para cada jugador
        foreach ($jugadores as &$jugador) {
            if ($jugador['cantRespuestas'] > 0) {
                $jugador['porcentaje'] = ($jugador['cantRespuestasCorrectas'] / $jugador['cantRespuestas']) * 100;
            } else {
                $jugador['porcentaje'] = 0; // Evita la división por cero si cantRespuestas es cero
            }
        }

        $datosJugadores = [
            'jugadores' => $jugadores,
            'totalUsuarios' => $totalUsuarios
        ];

        $this->renderer->render('listadoJugadores', $datosJugadores);
    }


    public function traerPartidas(){
        //intentamos que se muestre el nombre del usuario en vez del id, pero no se muestra nada
        $partidas = $this->model->traerTodasLasPartidas();
        $nombresUsuarios = [];

        foreach ($partidas as $partida) {
            $idUsuario = $partida['idUsuario'];
            $nombreUsuario = $this->model->traerNombrePorId($idUsuario);
            $nombresUsuarios[$idUsuario] = $nombreUsuario;
        }
    
        $totalPartidas = count($partidas);
    
        $datosPartidas = [
            'partidas' => $partidas,
            'totalPartidas' => $totalPartidas,
            'nombresUsuarios' => $nombresUsuarios,
        ];
    
        $this->renderer->render('listadoPartidas', $datosPartidas);
       }


    public function listadoPaises(){

        $usuariosPorPaises = $this->model->obtenerUsuariosPorPais();

        $datos_json['usuariosPorPaises'] = $usuariosPorPaises;

        $this->renderer->render('graficoPorPais', $datos_json);

    }

    public function listadoPorSexo(){

        $usuariosPorSexo = $this->model->obtenerUsuariosPorSexo();

        $datos_json['usuariosPorSexo'] = $usuariosPorSexo;

        $this->renderer->render('graficoPorSexo', $datos_json);

    }
    public function listadoPorGrupoDeEdad(){

        $usuariosPorEdad = $this->model->obtenerUsuariosPorEdad();


        $datos_json['usuariosPorEdad'] = $usuariosPorEdad;

        $this->renderer->render('graficoPorEdad', $datos_json);

    }

    public function respuestasCorrectasPorUsuario(){
        $respuestasPorUsuario = $this->model->obtenerRespuestasCorrectasPorUsuario();

        $datos_json['respuestasCorrectasPorUsuario'] = $respuestasPorUsuario;

        $this->renderer->render('graficoPorRespuestas', $datos_json);
    }


}