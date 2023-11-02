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
        $sql = "SELECT * FROM `preguntas`";
        return $this->database->query($sql);
    }

    public function obtenerUsuariosPorPais()
    {
        $consulta = "SELECT pais, COUNT(*) AS cantidad FROM usuarios GROUP BY pais";

        $query = $this->database->query($consulta);

        $cabecera = ['Pais', 'Cantidad'];

        return $this->convertirArrayAJSON($query, $cabecera);
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