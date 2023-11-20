<?php

class LoginModel {

    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function ejecutarValidaciones($datos){

        $errores = [];

        if(!$this->validarQueElMailEstaActivo($datos)){
            $errores['mailNoActivo'] = true;
        }

        if(!$this->validarQueNoHayaDatosIncorrectos($datos)){
            $errores['datosIncorrectos'] = true;
        }

    
        return $errores;
    }

    public function ingresarAlLobby(){
        header('location: /lobby/list');
        exit();
    }

    public function validarQueNoHayaDatosIncorrectos($datos) {

        $mail = $datos['mail'];
        $contrasenia = md5($datos['contrasenia']);
        $resultado = false;

        if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
                
            $sql = "SELECT * FROM usuarios where mail='{$mail}'";
            $consulta = $this->database->query($sql);

            if(!empty($consulta) && $consulta[0]['contrasenia'] == $contrasenia){
                $resultado = true;
                return $resultado;
            }
        }
        else{
            echo "Error en la consulta: " . $this->database->error;
            return false;
        }

    }
        

        public function validarQueElMailEstaActivo($datos) {

            $mail = $datos['mail'];
    
            if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
                
                $sql = "SELECT * FROM usuarios where mail='{$mail}'";
                $resultado = $this->database->query($sql);

                if ($resultado && $resultado[0]['estaActiva'] == 1) {

                        return true;
                } else {
                   return false;
                }            
    
            }
        }

        public function validarCuenta($codigo){

            $sql = "UPDATE usuarios SET estaActiva = 1 WHERE codigo='{$codigo}'";

            $this->database->execute($sql);
        }
        

    public function traerIdConMail($email){
        $sql = "SELECT id FROM `usuarios` WHERE mail = '{$email}';";
        $result = $this->database->queryUnSoloRegistro($sql);

        if ($result != null) {
            return $result;


        } else {
            return null;
        }
    }

    public function verificarRol($mail) {
        $sql = "SELECT idRol FROM `usuarios` WHERE mail = '{$mail}';";
        $idRol = $this->database->queryUnSoloRegistro($sql);
    
            switch($idRol["idRol"]){
                case '1':
                    header('location: /lobby/list');
                    exit();
                case '2':
                    header('location: /admin/list');
                    exit();
                case '3':
                    header('location: /pregunta/editorList');
                    exit();
            
                }
    }

   



}
    