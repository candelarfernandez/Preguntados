<?php

class LoginModel {

    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function verify($nombreUsuario, $contrasenia) {
        // Preparar la consulta SQL
        $query = "SELECT * FROM usuarios WHERE nombreUsuario = ?";

        // Preparar la declaración SQL
        $stmt = $this->database->prepare($query);

        // Bind de los parámetros
        $stmt->bind_param("s", $nombreUsuario);

        // Ejecutar la consulta
        $stmt->execute();

        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 0) {
            throw new Exception("Usuario no encontrado");
        }
    
        // Obtener el primer registro (debería ser único)
        $usuario = $resultado->fetch_assoc();
        echo "Contraseña almacenada en la base de datos: " . $usuario["contrasenia"] . "<br>";
        echo "Contraseña" . $contrasenia;
    
        // Verificar la contraseña
        if($contrasenia == $usuario["contrasenia"]){
            return $usuario;
        }else{
            throw new Exception("Contraseña incorrecta");
        }
    
        // Las credenciales son válidas, se devuelve el usuario
        return $usuario;
    }
}