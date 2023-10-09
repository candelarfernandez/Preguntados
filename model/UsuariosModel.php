<?php

class UsuariosModel {

    private $database;

    public function __construct($database) {
        $this->database = $database;
    }
    public function add($nombre, $anio, $sexo, $pais, $ciudad, $mail, $contrasenia, $nombreUsuario, $foto){
        $sql = "INSERT INTO `usuarios`( `nombre`, `anio`, `sexo`, `pais`, `ciudad`, `mail`, `contrasenia`, `nombreUsuario`, `foto`) 
                VALUES ( '" . $nombre . "', '" . $anio .  "' , '" . $sexo .  "', '" . $pais .  "' , '" . $ciudad .  "', '" . $mail .  "', '" . $contrasenia .  "', '" . $nombreUsuario .  "'
                , '" . $foto .  "')";
        $this->database->execute($sql);
    }

    public function getUsuarios() {
        return $this->database->query('SELECT * FROM usuarios');
    }
}