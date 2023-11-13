<?php

class AdminModel
{

    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }
    public function traerTodosLosJugadores(){
        $sql = "SELECT * FROM usuarios WHERE idRol = 1";
       return $this->database->query($sql);
    }
    public function traerTodasLasPartidas(){
        $sql = "SELECT * FROM partida";
       return $this->database->query($sql);
    }
    public function traerNombrePorId($idUsuario){
        $sql = "SELECT nombre FROM usuarios WHERE id = $idUsuario";
        return $this->database->query($sql);
    }
    public function traerPreguntas(){
        $sql = "SELECT * FROM preguntas";
        return $this->database->query($sql);
    }
    public function traerPreguntasSugeridas(){
        $sql = "SELECT * FROM preguntassugeridas";
        return $this->database->query($sql);
    }

    public function obtenerUsuariosPorPaisFiltradoPorFecha($fechaRegistro = null,$idRol){
    $whereClause = '';

    if (!empty($fechaRegistro)) {
        $whereClause = "WHERE DATE(fechaRegistro) = DATE('$fechaRegistro')";
        $whereClause .= " AND idRol = $idRol";
    }

    $consulta = "SELECT pais, COUNT(*) AS cantidad FROM usuarios $whereClause GROUP BY pais";

    $query = $this->database->query($consulta);

    $cabecera = ['Pais', 'Cantidad'];

    return $this->convertirArrayAJSON($query, $cabecera);
}

public function obtenerUsuariosPorPais($idRol)
{
    $consulta = "SELECT pais, COUNT(*) AS cantidad FROM usuarios WHERE idRol = $idRol GROUP BY pais";

    $query = $this->database->query($consulta);

    $cabecera = ['Pais', 'Cantidad'];

    return $this->convertirArrayAJSON($query, $cabecera);
}

public function obtenerUsuariosPorSexoFiltradoPorFechaYRol($fechaRegistro = null, $idRol)
{
    $whereClause = '';

    if (!empty($fechaRegistro)) {
        $whereClause .= " WHERE DATE(fechaRegistro) = DATE('$fechaRegistro')";
        $whereClause .= " AND idRol = $idRol";
    }

    $consulta = "SELECT sexo, COUNT(*) AS cantidad FROM usuarios $whereClause GROUP BY sexo";

    $query = $this->database->query($consulta);

    $cabecera = ['Sexo', 'Cantidad'];

    return $this->convertirArrayAJSON($query, $cabecera);
}

public function obtenerUsuariosPorSexoYRol($idRol)
{
    $consulta = "SELECT sexo, COUNT(*) AS cantidad FROM usuarios WHERE idRol = $idRol GROUP BY sexo";

    $query = $this->database->query($consulta);

    $cabecera = ['Sexo', 'Cantidad'];

    return $this->convertirArrayAJSON($query, $cabecera);
}
    
public function obtenerUsuariosPorEdadFiltradoPorFecha($fechaRegistro = null, $idRol)
{
    $whereClause = '';

    if (!empty($fechaRegistro)) {
        $whereClause .= "WHERE DATE(fechaRegistro) = DATE('$fechaRegistro')";
        // Agrega el filtro para idRol
        $whereClause .= " AND idRol = $idRol";
    }

    $consulta = "SELECT CASE WHEN DATEDIFF(CURDATE(), anio) < 6570 THEN 'Menores' 
        WHEN DATEDIFF(CURDATE(), anio) >= 6570 AND DATEDIFF(CURDATE(), anio) <= 21900 THEN 'Mayores' 
        WHEN DATEDIFF(CURDATE(), anio) > 21900 THEN 'Jubilados' 
        END AS Grupo, COUNT(*) AS Cantidad FROM usuarios $whereClause GROUP BY Grupo";

    $query = $this->database->query($consulta);

    $cabecera = ['Grupo', 'Cantidad'];

    return $this->convertirArrayAJSON($query, $cabecera);
}

public function obtenerUsuariosPorEdad($idRol)
{
    $consulta = "SELECT CASE WHEN DATEDIFF(CURDATE(), anio) < 6570 THEN 'Menores' 
        WHEN DATEDIFF(CURDATE(), anio) >= 6570 AND DATEDIFF(CURDATE(), anio) <= 21900 THEN 'Mayores' 
        WHEN DATEDIFF(CURDATE(), anio) > 21900 THEN 'Jubilados' 
        END AS Grupo, COUNT(*) AS Cantidad FROM usuarios WHERE idRol = $idRol GROUP BY Grupo";

    $query = $this->database->query($consulta);

    $cabecera = ['Grupo', 'Cantidad'];

    return $this->convertirArrayAJSON($query, $cabecera);
}

public function obtenerRespuestasCorrectasPorUsuario($fechaRegistro = null, $idRol)
{
    $whereClause = '';

    if (!empty($fechaRegistro)) {
        $whereClause = "WHERE DATE(fechaRegistro) = DATE('$fechaRegistro') AND idRol = $idRol";
    } else {
        // Si no se proporciona una fecha, solo aplicar el filtro de idRol
        $whereClause = "WHERE idRol = $idRol";
    }

    $consulta = "SELECT nombre, (SUM(cantRespuestasCorrectas) / SUM(cantRespuestas)) * 100 AS porcentajeRespuestasCorrectas FROM usuarios $whereClause GROUP BY nombre";

    $query = $this->database->query($consulta);

    $cabecera = ['nombre', 'porcentajeRespuestasCorrectas'];

    return $this->convertirArrayAJSON($query, $cabecera);
}
   


    public function obtenerUsuariosNuevos($idRol){
        $consulta = "SELECT * FROM usuarios WHERE fechaRegistro >= DATE_SUB(CURDATE(), INTERVAL 3 DAY)";
        return $this->database->query($consulta);
    }

    public function imprimirTodosLosUsuariosParaPDF(){
        $sql = "SELECT * FROM usuarios WHERE idRol = 1";
        $result = $this->database->print($sql);
        return $result;
    }
    public function mostrarTodasLasPartidas(){
        $query = "SELECT DISTINCT * FROM partida";
        return $this->database->print($query);
    }
    public function mostrarTodasLasPreguntas(){
        $query = "SELECT * FROM preguntas";
        $result = $this->database->print($query);
        return $result;
    }

    //Métodos privados

    private function convertirArrayAJSON($array, $cabecera) {
        $result = [];
        $result[] = $cabecera; 
        
        foreach ($array as $element) {
            $result[] = [$element[0], (int)$element[1]];
        }
        
        return json_encode($result);
    }

}