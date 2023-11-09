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
  
    $fechaRegistro = null;
 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      
        $fechaRegistro = isset($_POST['fechaRegistro']) ? $_POST['fechaRegistro'] : null;
    }

   
    if ($fechaRegistro !== null) {
        $usuariosPorPaises = $this->model->obtenerUsuariosPorPaisFiltradoPorFecha($fechaRegistro,1);
    } else {
       
        $usuariosPorPaises = $this->model->obtenerUsuariosPorPais(1);
    }

   
    $datos = [
        'usuariosPorPaises' => $usuariosPorPaises,
        'fechaIngresada' => $fechaRegistro,
    ];

    $this->renderer->render('graficoPorPais', $datos);
}


public function listadoPorSexo()
{
    
    $fechaRegistro = null;

   
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $fechaRegistro = isset($_POST['fechaRegistro']) ? $_POST['fechaRegistro'] : null;
    }

    
    if ($fechaRegistro !== null) {
        $usuariosPorSexo = $this->model->obtenerUsuariosPorSexoFiltradoPorFechaYRol($fechaRegistro, 1);
    } else {
       
        $usuariosPorSexo = $this->model->obtenerUsuariosPorSexoYRol(1);
    }

    
    $datos = [
        'usuariosPorSexo' => $usuariosPorSexo,
        'fechaIngresada' => $fechaRegistro,
    ];

    $this->renderer->render('graficoPorSexo', $datos);
}

    public function listadoPorGrupoDeEdad()
    {
        $fechaRegistro = null;
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
           
            $fechaRegistro = isset($_POST['fechaRegistro']) ? $_POST['fechaRegistro'] : null;
    
           
            $usuariosPorEdad = $this->model->obtenerUsuariosPorEdadFiltradoPorFecha($fechaRegistro,1);
        } else {
           
            $usuariosPorEdad = $this->model->obtenerUsuariosPorEdad(1);
        }
    
       
        $datos = [
            'usuariosPorEdad' => $usuariosPorEdad,
            'fechaIngresada' => $fechaRegistro,
        ];
    
        $this->renderer->render('graficoPorEdad', $datos);
    }

    public function respuestasCorrectasPorUsuario()
{
    // Verifica si se ha enviado el formulario con la fecha seleccionada
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Obtén la fecha del formulario
        $fechaRegistro = isset($_POST['fechaRegistro']) ? $_POST['fechaRegistro'] : null;

        // Llama a la función del modelo con el parámetro de fecha
        $respuestasPorUsuario = $this->model->obtenerRespuestasCorrectasPorUsuario($fechaRegistro, 1);

        // Renderiza la vista con los datos filtrados y la fecha ingresada
        $datos = [
            'respuestasCorrectasPorUsuario' => $respuestasPorUsuario,
            'fechaIngresada' => $fechaRegistro,
        ];

        $this->renderer->render('graficoPorRespuestas', $datos);
    } else {
        // Si no se ha enviado el formulario, obtén todos los resultados sin filtrar por fecha
        $respuestasPorUsuario = $this->model->obtenerRespuestasCorrectasPorUsuario(null, 1);

        // Renderiza la vista con todos los resultados
        $datos = [
            'respuestasCorrectasPorUsuario' => $respuestasPorUsuario,
            'fechaIngresada' => null, // Puedes establecer la fecha en null o cualquier otro valor predeterminado
        ];

        $this->renderer->render('graficoPorRespuestas', $datos);
    }
}
   

    public function traerUsuariosNuevos(){
        $usuariosNuevos = $this->model->obtenerUsuariosNuevos();
        $nuevosUsuarios = [
            'usuariosNuevos' => $usuariosNuevos
        ];
        $this->renderer->render('listadoUsuariosNuevos', $nuevosUsuarios);
    }


}