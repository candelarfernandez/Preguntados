<?php

class LoginModel {

    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function verify($nombreUsuario, $contrasenia) {
        // Preparar la consulta SQL
        $query = "SELECT * FROM usuarios WHERE nombreUsuario = :nombreUsuario
        AND contrasenia = :contrasenia";

        // Preparar la declaración SQL
        $stmt = $this->database->prepare($query);

        // Bind de los parámetros
        $stmt->bindParam(":nombreUsuario", $nombreUsuario);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener el resultado como un arreglo asociativo
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$usuario) {
            throw new Exception("Usuario no encontrado");
        }
    
        // Verificar la contraseña
        if (!password_verify($contrasenia, $usuario["contrasenia"])) {
            throw new Exception("Contraseña incorrecta");
        }
    
        // Las credenciales son válidas, se devuelve el usuario
        return $usuario;

    }
}