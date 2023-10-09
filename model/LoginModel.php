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
            return false;
        }
    
        // Obtener el primer registro (debería ser único)
        $usuario = $resultado->fetch_assoc();
    
        // Verificar la contraseña
        if($contrasenia == $usuario["contrasenia"]){
            //return $usuario;
            return true;
        }else{
            //throw new Exception("Contraseña incorrecta");
            return false;
            //header("location:/login/verifyForm/estado=error");
        }
    
    }
}