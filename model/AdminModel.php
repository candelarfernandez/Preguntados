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

    public function obtenerUsuariosPorPais()
    {
        $consulta = "SELECT pais, COUNT(*) AS cantidad FROM usuarios GROUP BY pais";

        $query = $this->database->query($consulta);

        $cabecera = ['Pais', 'Cantidad'];

        return $this->convertirArrayAJSON($query, $cabecera);
    }

    public function obtenerUsuariosPorSexo()
    {
        $consulta = "SELECT sexo, COUNT(*) AS cantidad FROM usuarios GROUP BY sexo";

        $query = $this->database->query($consulta);

        $cabecera = ['Sexo', 'Cantidad'];

        return $this->convertirArrayAJSON($query, $cabecera);
    }
    public function obtenerUsuariosPorEdad()
    {
        $consulta = "SELECT CASE WHEN DATEDIFF(CURDATE(), anio) < 6570 THEN 'Menores' 
    WHEN DATEDIFF(CURDATE(), anio) >= 6570 AND DATEDIFF(CURDATE(), anio) <= 21900 THEN 'Mayores' 
    WHEN DATEDIFF(CURDATE(), anio) > 21900 THEN 'Jubilados' 
    END AS Grupo, COUNT(*) AS Cantidad FROM usuarios GROUP BY Grupo";

        $query = $this->database->query($consulta);

        $cabecera = ['Grupo', 'Cantidad'];

        return $this->convertirArrayAJSON($query, $cabecera);
    }
    public function obtenerRespuestasCorrectasPorUsuario($fechaRegistro = null){
        $whereClause = '';
    
        if (!empty($fechaRegistro)) {
            $whereClause = "WHERE DATE(fechaRegistro) = DATE('$fechaRegistro')";
        }
        $consulta = "SELECT nombre, (SUM(cantRespuestasCorrectas) / SUM(cantRespuestas)) * 100 AS porcentajeRespuestasCorrectas FROM usuarios GROUP BY nombre";

        $query = $this->database->query($consulta);

        $cabecera = ['nombre', 'porcentajeRespuestasCorrectas'];

        return $this->convertirArrayAJSON($query, $cabecera);
    }

    public function obtenerUsuariosNuevos(){
        $consulta = "SELECT * FROM usuarios WHERE fechaRegistro >= DATE_SUB(CURDATE(), INTERVAL 3 DAY)";
        return $this->database->query($consulta);
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