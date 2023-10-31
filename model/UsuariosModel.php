<?php

class UsuariosModel {

    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function registrarUsuario($datos) {
        $sql = "INSERT INTO `usuarios`( `nombre`, `anio`, `sexo`, `pais`, `ciudad`, `mail`, `contrasenia`, `nombreUsuario`, `foto`, `codigo`, `latitud`, `longitud` ) 
                VALUES ( '{$datos['nombre']}',
                '{$datos['anio']}',
                '{$datos['sexo']}',
                '{$datos['pais']}',
                '{$datos['ciudad']}',
                '{$datos['mail']}',
                '{$datos['contrasenia']}',
                '{$datos['nombreUsuario']}',
                '{$datos['foto']}',
                '{$datos['codigo']}',
                '{$datos['lat']}',
                '{$datos['lng']}')";

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


    public function subirFotoDePerfil($foto){

        $archivo_temporal = $foto['tmp_name'];
        $nombre = $foto['name'];
        $carpeta_destino = "./public/img/";

        if(move_uploaded_file($archivo_temporal, $carpeta_destino.$nombre)){
            return $carpeta_destino . $nombre;
        }
        else{
            return false;
        }

    }

    public function generarCodigoDeValidacion(){
        $codigo = rand(100000, 999999);
        return $codigo;
    }

    public function validarFechaDeNacimiento($datos){
        return true;
    }

    public function ejecutarValidaciones($datos){
        var_dump($datos);

        $errores = [];
        $datos['foto'] = $_FILES['foto'];

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

        $urlFoto = $this->subirFotoDePerfil($datos['foto']);

        $datos['foto'] = $urlFoto;

        $datos['codigo'] = $this->generarCodigoDeValidacion();

        $datos['contrasenia'] = md5($datos['contrasenia']);

        if(empty($errores)){
            $this->registrarUsuario($datos);
        }

        return $errores;
    }

}