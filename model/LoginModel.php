<?php

class LoginModel {

    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    // public function getDatabase(){
    //     $sql = "SELECT * FROM usuarios";
    //     $resultado = $this->database->query($sql);

    //     if ($resultado) {
    //         // La consulta se ejecutó correctamente, puedes procesar los resultados.
    //     } else {
    //         // Hubo un error en la consulta.
    //         echo "Error en la consulta: " . $this->database->error;
    //     }
    // }

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
        



   /* public function traerIdConMail($datos){
        $mail = $datos['mail'];
         $sql = " SELECT id FROM `usuarios` WHERE mail like '{$mail}'";
         $id=  $this->database->execute($sql);
         return $id;
    }*/
    public function traerIdConMail($email){
        var_dump("$email");
        $sql = "SELECT id FROM `usuarios` WHERE mail = '{$email}';";
        $result = $this->database->queryUnSoloRegistro($sql);

        if ($result != null) {

            return $result;
            var_dump("$result");


        } else {
            var_dump("error en el id");
            return null;
        }
    }



}
    