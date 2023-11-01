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
     public function traerJugadores(){

      $jugadores =  $this->model->TraerTodosLosJugadores();

         $datosJugadores = [
             'jugadores' => $jugadores
         ];

         $this->renderer->render('listadoJugadores', $datosJugadores);
     }



}