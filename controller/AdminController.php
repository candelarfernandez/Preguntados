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
        $usuariosNuevos = $this->model->obtenerUsuariosNuevos(1);
        $nuevosUsuarios = [
            'usuariosNuevos' => $usuariosNuevos
        ];
        $this->renderer->render('listadoUsuariosNuevos', $nuevosUsuarios);
    }


    //-- Crear reportes en PDF --
    public function reporteDeUsuarios(){
        require ("helpers/JugadoresTotales.php");

        $pdf = new JugadoresTotales("L");
        $pdf->AddPage();
        $pdf->AliasNbPages();

        $tablaUsuarios = $this->model->imprimirTodosLosUsuariosParaPDF();

        $pdf->SetFont('Arial', '', 12);
        $pdf->SetDrawColor(163, 163, 163);

        foreach ($tablaUsuarios as $fila ){
            $pdf->Cell(25,25,($fila["id"]),1, 0, 'C', 0);
            $pdf->Cell(45,25,($fila["nombreUsuario"]),1, 0, 'C', 0);
            $pdf->Cell(60,25,($fila["mail"]),1, 0, 'C', 0);
            $pdf->Cell(30,25,($fila["sexo"]),1, 0, 'C', 0);
            $pdf->Cell(30,25,($fila["anio"]),1, 0, 'C', 0);
            $pdf->Cell(50,25,($fila["fechaRegistro"]),1, 0, 'C', 0);
            $pdf->Cell(35,25,($fila["cantRespuestasCorrectas"]),1, 0, 'C', 0);
            $pdf->Ln();
        }

        $pdf->Output('JugadoresTotales.pdf', 'D');
    }

    public function partidasTotalesPDF(){
        require ("helpers/PartidasTotales.php");

        $pdf = new PartidasTotales();
        $pdf->AddPage();
        $pdf->AliasNbPages();

        $tablaPartidas = $this->model->mostrarTodasLasPartidas();
        $pdf->SetFont('Arial', '',12 );
        $pdf->SetDrawColor(163, 163, 163);

        foreach ($tablaPartidas as $fila) {
            $pdf->Ln(); // Salto de línea después de cada fila
            $pdf->Cell(45, 10, ($fila["idUsuario"]), 1, 0, 'C', 0);
            $pdf->Cell(45, 10, ($fila["puntaje"]), 1, 0, 'C', 0);
            $pdf->Cell(70, 10, ($fila["fecha"]), 1, 0, 'C', 0);
            if ($pdf->GetY() > 250) {
                $pdf->AddPage();
            }
        }
        $pdf->Output('PartidasTotales.pdf', 'I');
    }
    public function listadoDePreguntas(){
        require("helpers/ListadoDePreguntas.php");

        $pdf = new ListadoDePreguntas("L");
        $pdf->AddPage();
        $pdf->AliasNbPages();

        $tablaPreguntas = $this->model->mostrarTodasLasPreguntas();
        $pdf->SetFont('Arial', '',12 );
        $pdf->SetDrawColor(163, 163, 163);

        foreach ($tablaPreguntas as $fila) {
            $pdf->Ln(); // Salto de línea después de cada fila
            $pdf->Cell(10, 10, ($fila["id"]), 1, 0, 'C', 0);
            $pdf->Cell(240, 10, ($fila["pregunta"]), 1, 0, 'C', 0);
            $pdf->Cell(20, 10, ($fila["dificultad"]), 1, 0, 'C', 0);

            if ($pdf->GetY() > 150) {
                $pdf->AddPage();
            }
        }
        $pdf->Output('PreguntasTotales.pdf', 'I');
    }
    public function graficoPorPais(){
        require('helpers/Graficos.php');
        $pdf = new Graficos();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $tituloPDF = $_POST['tituloPDF'];
        $titulo = $_POST['titulo'];
        $pdf->SetTitle($tituloPDF);
        $pdf->SetFont('Arial', 'B', 15);
        $pdf->Cell(190,30,$titulo,0,1,'C',0);

        $grafico = $_POST['graficoImagen'];

        $pdf->image($grafico, 0, 50, 200, 0, 'png');
        $pdf->Output();
    }

}