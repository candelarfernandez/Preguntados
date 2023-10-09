<?php

class LoginModel {

    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function verify($nombreUsuario, $contrasenia) {
        // Preparar la consulta SQL
        $query = "SELECT * FROM usuarios WHERE nombreUsuario = :nombreUsuario";

        // Preparar la declaración SQL
        $stmt = $this->database->prepare($query);

        // Bind de los parámetros
        $stmt->bindParam(":nombreUsuario", $nombreUsuario);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener el resultado como un arreglo asociativo
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar si se encontró un usuario
        if ($usuario) {
            // Verificar la contraseña
            if (password_verify($contrasenia, $usuario["contrasenia"])) {
                // Las credenciales son válidas
                return $usuario;
            }
        }

        // Las credenciales no son válidas
        return false;
    }
}