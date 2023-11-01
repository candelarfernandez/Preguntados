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
     public function traerJugadores(){
      $jugadores =  $this->model->traerTodosLosJugadores();
      $totalUsuarios = count($jugadores);
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
      
    



}