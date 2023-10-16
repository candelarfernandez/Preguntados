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
        }else{
            if(!$this->validarQueNoHayaDatosIncorrectos($datos)){
                $errores['datosIncorrectos'] = true;
            }
        }


        if(empty($errores)){
            $this->ingresarAlLobby($datos);
        }

        return $errores;
    }

    public function validarQueNoHayaDatosIncorrectos($datos) {

        $mail = $datos['mail'];
        $contrasenia = password_hash($datos['contrasenia'], PASSWORD_DEFAULT);
        $resultado = false;

        if(filter_var($mail, FILTER_VALIDATE_EMAIL) && !empty($contrasenia)){
            
            $sql = "SELECT * FROM `usuarios` WHERE mail='{$mail}';";

            $consulta = $this->database->execute($sql);

            if(!empty($consulta) && $consulta['contrasenia'] == $contrasenia){
                $resultado = true;
                return $resultado;
            }
        }
        else{
            return false;
        }

    }


    public function validarQueElMailEstaActivo($datos) {

        $mail = $datos['mail'];

        if(filter_var($mail, FILTER_VALIDATE_EMAIL)){

            $sql = "SELECT * FROM usuarios where mail='{$mail}'";
            $resultado = $this->database->query($sql);

            if ($resultado && $resultado[0]['estaActiva'] == 1) {
                unset($_SESSION['activarCuenta']);
                return true;
            } else {
                return false;
            }

        }
    }

            public function validarCuenta($codigo){
                $sql = "UPDATE `usuarios` SET `estaActiva`= true WHERE codigo='{$codigo}';";
                $this->database->execute($sql);
            }   

        }
    