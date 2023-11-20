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

    public function list()
    {
        $this->renderer->render('admin');
    }

    public function traerPreguntas()
    {
        $preguntas = $this->model->traerPreguntas();
        $preguntasDelJuego = [
            'preguntasDelJuego' => $preguntas
        ];
        $this->renderer->render('PreguntasListado', $preguntasDelJuego);
    }

    public function traerPreguntasCreadas()
    {
        $preguntasSug = $this->model->traerPreguntasSugeridas();
        $preguntasSugeridas = [
            'preguntasSugeridas' => $preguntasSug
        ];
        $this->renderer->render('preguntasSugeridasListado', $preguntasSugeridas);
    }


    public function traerJugadores()
    {
        $jugadores = $this->model->traerTodosLosJugadores();
        $totalUsuarios = count($jugadores);

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


    public function traerPartidas()
    {
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

    public function listadoPaises()
    {

        $fechaDesde = null;
        $fechaHasta = null;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $fechaDesde = isset($_POST['fechaDesde']) ? $_POST['fechaDesde'] : null;
            $fechaHasta = isset($_POST['fechaHasta']) ? $_POST['fechaHasta'] : null;
        }

        $usuariosPorPaises = $this->model->obtenerUsuariosPorPaisFiltradoPorFecha($fechaDesde, $fechaHasta, 1);

        $datos = [
            'usuariosPorPaises' => $usuariosPorPaises,
            'fechaDesde' => $fechaDesde,
            'fechaHasta' => $fechaHasta,
        ];

        $this->renderer->render('graficoPorPais', $datos);
    }


    public function listadoPorSexo()
    {

        $fechaDesde = null;
        $fechaHasta = null;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $fechaDesde = isset($_POST['fechaDesde']) ? $_POST['fechaDesde'] : null;
            $fechaHasta = isset($_POST['fechaHasta']) ? $_POST['fechaHasta'] : null;
        }

        $usuariosPorSexo = $this->model->obtenerUsuariosPorSexoFiltradoPorFechaYRol($fechaDesde, $fechaHasta, 1);

        $datos = [
            'usuariosPorSexo' => $usuariosPorSexo,
            'fechaDesde' => $fechaDesde,
            'fechaHasta' => $fechaHasta,
        ];

        $this->renderer->render('graficoPorSexo', $datos);
    }

    public function listadoPorGrupoDeEdad()
    {
        $fechaDesde = null;
        $fechaHasta = null;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $fechaDesde = isset($_POST['fechaDesde']) ? $_POST['fechaDesde'] : null;
            $fechaHasta = isset($_POST['fechaHasta']) ? $_POST['fechaHasta'] : null;
        }

        $usuariosPorEdad = $this->model->obtenerUsuariosPorEdadFiltradoPorFecha($fechaDesde, $fechaHasta, 1);

        $datos = [
            'usuariosPorEdad' => $usuariosPorEdad,
            'fechaDesde' => $fechaDesde,
            'fechaHasta' => $fechaHasta,
        ];

        $this->renderer->render('graficoPorEdad', $datos);
    }

    public function respuestasCorrectasPorUsuario()
    {

        $fechaDesde = null;
        $fechaHasta = null;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $fechaDesde = isset($_POST['fechaDesde']) ? $_POST['fechaDesde'] : null;
            $fechaHasta = isset($_POST['fechaHasta']) ? $_POST['fechaHasta'] : null;
        }

        $respuestasPorUsuario = $this->model->obtenerRespuestasCorrectasPorUsuario($fechaDesde, $fechaHasta, 1);

        $datos = [
            'respuestasCorrectasPorUsuario' => $respuestasPorUsuario,
            'fechaDesde' => $fechaDesde,
            'fechaHasta' => $fechaHasta,
        ];

        $this->renderer->render('graficoPorRespuestas', $datos);
    }


    public function traerUsuariosNuevos()
    {

        $fechaDesde = null;
        $fechaHasta = null;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $fechaDesde = isset($_POST['fechaDesde']) ? $_POST['fechaDesde'] : null;
            $fechaHasta = isset($_POST['fechaHasta']) ? $_POST['fechaHasta'] : null;
        }

        $usuariosNuevos = $this->model->obtenerUsuariosNuevos($fechaDesde, $fechaHasta);

        $nuevosUsuarios = [
            'usuariosNuevos' => $usuariosNuevos
        ];
        $this->renderer->render('listadoUsuariosNuevos', $nuevosUsuarios);
    }


    //Crear reportes en PDF
    public function reporteDeUsuarios()
    {
        require("helpers/JugadoresTotales.php");

        $pdf = new JugadoresTotales("L");
        $pdf->AddPage();
        $pdf->AliasNbPages();
        $pdf->SetTitle("Usuarios registrados");
        $tablaUsuarios = $this->model->imprimirTodosLosUsuariosParaPDF();

        $pdf->SetFont('Arial', '', 12);
        $pdf->SetDrawColor(163, 163, 163);

        foreach ($tablaUsuarios as $fila) {
            $pdf->Cell(25, 25, ($fila["id"]), 1, 0, 'C', 0);
            $pdf->Cell(45, 25, ($fila["nombreUsuario"]), 1, 0, 'C', 0);
            $pdf->Cell(60, 25, ($fila["mail"]), 1, 0, 'C', 0);
            $pdf->Cell(30, 25, ($fila["sexo"]), 1, 0, 'C', 0);
            $pdf->Cell(30, 25, ($fila["anio"]), 1, 0, 'C', 0);
            $pdf->Cell(50, 25, ($fila["fechaRegistro"]), 1, 0, 'C', 0);
            $pdf->Cell(35, 25, ($fila["cantRespuestasCorrectas"]), 1, 0, 'C', 0);
            $pdf->Ln();
        }

        $pdf->Output('JugadoresTotales.pdf', 'I');
    }

    public function partidasTotalesPDF()
    {
        require("helpers/PartidasTotales.php");

        $fechaDesde = $_POST["fechaDesde"];
        $fechaHasta = $_POST["fechaHasta"];

        $pdf = new PartidasTotales();
        $pdf->AddPage();
        $pdf->AliasNbPages();

        $pdf->SetTitle("Partidas totales realizadas");
        $tablaPartidas = $this->model->mostrarTodasLasPartidas($fechaDesde, $fechaHasta);
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetDrawColor(163, 163, 163);

        //Centrar tabla
        $anchoTotalTabla = 25 + 25 + 45 + 70;
        $margenIzquierdo = ($pdf->GetPageWidth() - $anchoTotalTabla) / 2;

        foreach ($tablaPartidas as $fila) {
            $pdf->Ln(); // Salto de línea después de cada fila
            $pdf->SetX($margenIzquierdo);
            $pdf->Cell(25, 10, ($fila["id"]), 1, 0, 'C', 0);
            $pdf->Cell(25, 10, ($fila["idUsuario"]), 1, 0, 'C', 0);
            $pdf->Cell(45, 10, ($fila["puntaje"]), 1, 0, 'C', 0);
            $pdf->Cell(70, 10, ($fila["fecha"]), 1, 0, 'C', 0);
            if ($pdf->GetY() > 250) {
                $pdf->AddPage();
            }
        }
        $pdf->Output('PartidasTotales.pdf', 'I');
    }

    public function listadoDePreguntas()
    {
        require("helpers/ListadoDePreguntas.php");

        $pdf = new ListadoDePreguntas("L");
        $pdf->AddPage();
        $pdf->AliasNbPages();

        $tablaPreguntas = $this->model->mostrarTodasLasPreguntas();
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetDrawColor(163, 163, 163);
        $pdf->SetTitle("Lista de preguntas");

        foreach ($tablaPreguntas as $fila) {
            $pdf->Ln(); // Salto de línea después de cada fila
            $pdf->Cell(10, 10, ($fila["id"]), 1, 0, 'C', 0);
            $pdf->Cell(240, 10, ($fila["pregunta"]), 1, 0, 'C', 0);
            $fila["dificultad"] = $this->convertirEnStringLadificultad($fila['dificultad']);
            $pdf->Cell(30, 10, ($fila["dificultad"]), 1, 0, 'C', 0);

            if ($pdf->GetY() > 150) {
                $pdf->AddPage();
            }
        }
        $pdf->Output('PreguntasTotales.pdf', 'I');
    }

    public function grafico()
    {
        require('helpers/Graficos.php');
        $pdf = new Graficos();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $tituloPDF = $_POST['tituloPDF'];
        $titulo = $_POST['titulo'];
        $pdf->SetTitle($tituloPDF);
        $pdf->SetFont('Arial', 'B', 15);
        $pdf->Cell(190, 30, $titulo, 0, 1, 'C', 0);

        $grafico = $_POST['graficoImagen'];

        $pdf->image($grafico, 0, 50, 200, 0, 'png');
        $pdf->Output();
    }

    public function reportePreguntasSugeridas()
    {
        require('helpers/PreguntasSugeridas.php');

        $pdf = new PreguntasSugeridas("L");
        $pdf->AddPage();
        $pdf->AliasNbPages();
        $pdf->SetTitle("Preguntas Sugeridas");
        $tablaPreguntas = $this->model->mostrarTodasLasPreguntasSugeridas();
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetDrawColor(163, 163, 163);

        $anchoTotalTabla = 25 + 230;
        $margenIzquierdo = ($pdf->GetPageWidth() - $anchoTotalTabla) / 2;

        foreach ($tablaPreguntas as $fila) {
            $pdf->Ln(); // Salto de línea después de cada fila
            $pdf->SetX($margenIzquierdo);
            $pdf->Cell(25, 10, ($fila["id"]), 1, 0, 'C', 0);
            $pdf->Cell(230, 10, ($fila["descripcion"]), 1, 0, 'C', 0);

        }
        $pdf->Output('PreguntasSugeridas.pdf', 'I');

    }
    public function reporteUsuariosNuevos(){
        require("helpers/UsuariosNuevos.php");

        $pdf = new UsuariosNuevos("L");
        $pdf->AddPage();
        $pdf->AliasNbPages();
        $pdf->SetTitle("Usuarios nuevos");
        $fechaDesde = $_POST["fechaDesdeH"];
        $fechaHasta = $_POST["fechaHastaH"];



        $tablaPreguntas = $this->model->obtenerUsuariosNuevosPDF($fechaDesde, $fechaHasta);

        $pdf->SetFont('Arial', '', 12);
        $pdf->SetDrawColor(163, 163, 163);

        $anchoTotalTabla = 50+40+100+30;
        $margenIzquierdo = ($pdf->GetPageWidth() - $anchoTotalTabla) / 2;


        foreach ($tablaPreguntas as $fila) {
            $pdf->Ln();
            $pdf->SetX($margenIzquierdo);
            $pdf->Cell(50, 10, ($fila["nombre"]), 1, 0, 'C', 0);
            $pdf->Cell(40, 10, ($fila["nombreUsuario"]), 1, 0, 'C', 0);
            $pdf->Cell(100, 10, ($fila["mail"]), 1, 0, 'C', 0);
            $pdf->Cell(30, 10, ($fila["nivel"]), 1, 0, 'C', 0);
        }
        $pdf->Output('UsuariosNuevos.pdf', 'D');

    }



    private function convertirEnStringLadificultad($dificultadNumero) {
    $niveles = [
        1 => "facil",
        2 => "intermedio",
        3 => "dificil"
    ];

    return $niveles[$dificultadNumero] ?? "desconocido";
}

}