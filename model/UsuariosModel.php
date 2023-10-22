<?php

class UsuariosModel {

    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function registrarUsuario($datos) {
        $sql = "INSERT INTO `usuarios`( `nombre`, `anio`, `sexo`, `pais`, `ciudad`, `mail`, `contrasenia`, `nombreUsuario`, `foto`, `codigo` ) 
                VALUES ( '{$datos['nombre']}',
                '{$datos['anio']}',
                '{$datos['sexo']}',
                '{$datos['pais']}',
                '{$datos['ciudad']}',
                '{$datos['mail']}',
                '{$datos['contrasenia']}',
                '{$datos['nombreUsuario']}',
                '{$datos['foto']}',
                '{$datos['codigo']}')";

        $this->database->execute($sql);

    }

    public function validarQueNoHayaCamposVacios($datos){
        
        $result = true;
        foreach ($datos as $key) {
            if(empty($key)){
                $result = false;
            }
        }
        return $result;
    }

    public function validarMail($mail){

        if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
            return true;
        }
        else{
            return false;
        }
    }

    public function validarContraseña($datos){
        $contrasenia = $datos['contrasenia'];
        $contraseniaRepetida = $datos['confirmar_contrasena'];
        if($contrasenia == $contraseniaRepetida){
            return true;
        }
        else{
            return false;
        }
    }

    public function validarQueNoExistaMail($mail){

        $query = "SELECT COUNT(*) AS count FROM usuarios WHERE mail = ?";

            $stmt = $this->database->prepare($query);
            $stmt->bind_param("s", $mail);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            if ($row['count'] > 0) {
                return false;
            } else {
                return true;
            }
    }

//public function subirFotoDePerfil($imagen){}
    public function subirFotoDePerfil($datos){

        if (isset($datos['foto']['name']) && $datos['foto']['name']) {
            $imagen = $datos['foto'];
            $extensionesPermitidas = array("jpeg", "jpg", "png");

            $nombreImagen = basename($imagen['name']);
            $extension = pathinfo($nombreImagen, PATHINFO_EXTENSION);

            if (in_array($extension, $extensionesPermitidas)) {
                $imagenPath = "./public/fotos-de-perfil/" . $nombreImagen;
                if (move_uploaded_file($imagen['tmp_name'], $imagenPath)) {
                    return $nombreImagen;
                } 
            } 
        }return false;

    }

    public function generarCodigoDeValidacion(){
        $codigo = rand(100000, 999999);
        return $codigo;
    }

    public function validarFechaDeNacimiento($datos){
        return true;
    }

    public function ejecutarValidaciones($datos){

        $errores = [];

        if(!$this->validarQueNoHayaCamposVacios($datos)){
            $errores['camposVacios'] = true;
        }

        if(!$this->validarMail($datos['mail'])){
            $errores['mailInvalido'] = true;
        }

        if(!$this->validarQueNoExistaMail($datos['mail'])){
            $errores['mailExistente'] = true;
        }

        if(!$this->validarFechaDeNacimiento($datos)){
            $errores['menorDeEdad'] = true;
        }

        if(!$this->validarContraseña($datos)){
            $errores['contraseniaInvalida'] = true;
        }
        if(isset($datos['foto']['name']) && $datos['foto']['name']){
            if(!$this->subirFotoDePerfil($datos)){
                $errores['imagenInvalida'] = true;
            }
        }
        $datos['codigo'] = $this->generarCodigoDeValidacion();

        $datos['contrasenia'] = md5($datos['contrasenia']);

        if(empty($errores)){
            $this->registrarUsuario($datos);
        }

        return $errores;
    }

}