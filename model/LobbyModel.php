<?php

class LobbyModel {

    private $database;

    public function __construct($database) {
        $this->database = $database;
    }


    public function buscarUsuarioPorMail($mail){
        $sql = "SELECT * FROM usuarios where mail='{$mail}'";
        $usuario = $this->database->queryUnSoloRegistro($sql);
        return $usuario;
    }

    public function obtenerPosicion(){
        $sql = "SELECT * FROM usuarios ORDER BY puntajeTotal DESC";
        $usuarios = $this->database->query($sql);
        $posicion = 1;
        foreach ($usuarios as $usuario) {
            if($usuario['mail'] == $_SESSION['usuario']){
                return $posicion;
            }
            $posicion++;
        }
    }

    public function generarQR($id)
    {
        $dir = 'public/qrs/';

        if (!file_exists($dir)) {
            mkdir($dir);
        }
        
        $filename = $dir . $id . '.png';

        if (!file_exists($filename)) {
            $size = 9;
            $level = 'M';
            $frameSize = 1;
            $content = "localhost/ranking/verUsuario&id=" . $id;
            QRcode::png($content, $filename, $level, $size, $frameSize);
        }
    }

    
    public function obtenerDatosDelUsuarioPorID($id){
        $sql = "SELECT * FROM usuarios WHERE id = '{$id}'";
        $resultado['usuario'] = $this->database->queryUnSoloRegistro($sql);
        $resultado['partidas'] = $this->obtenerPartidasDelUsuario($id);
        return $resultado;
    }
    private function obtenerPartidasDelUsuario($id){
        $sql = "SELECT * FROM partida WHERE idUsuario = '{$id}' ORDER BY puntaje DESC LIMIT 5 ";
        $partidas = $this->database->query($sql);
        return $partidas;
    }

    public function modificarUsuario($datos){
        $idUsuarioModificada = $_SESSION['usuarioId'];
        $nuevoNombre = $datos['nombre'];
        $nuevaFecha = $datos['anio'];
        $nuevaContrasenia = $datos['contrasenia'];
        $nuevaCiudad = $datos['ciudad'];
        $nuevoNombreUsuario = $datos['nombreUsuario'];
        $nuevaFoto = $datos['foto'];
        //if(!empty($nuevoNombre) || !empty($nuevaFecha) || !empty($nuevaContrasenia) || !empty($nuevaCiudad) || !empty($nuevoNombreUsuario)){
            $sql = "UPDATE `usuarios` SET `nombre` = '$nuevoNombre', `anio` = '$nuevaFecha', `ciudad` = '$nuevaCiudad' ,`contrasenia` = '$nuevaContrasenia',  `nombreUsuario` = '$nuevoNombreUsuario'
            ,  `foto` = '$nuevaFoto' WHERE `id` = $idUsuarioModificada";
       // }
        $this->database->execute($sql);
        header('location: /lobby/verMiPerfil?usuarioModificado=true');

    }
    
    public function validarFechaDeNacimiento($datos){
        return true;
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

    public function ejecutarValidaciones($datos){

        $errores = [];
        $datos['foto'] = $_FILES['foto'];

        if(!$this->validarFechaDeNacimiento($datos)){
            $errores['menorDeEdad'] = true;
        }

        if(!$this->validarContraseña($datos)){
            $errores['contraseniaInvalida'] = true;
        }
        $urlFoto = $this->subirFotoDePerfil($datos['foto']);

        $datos['foto'] = $urlFoto;

        $datos['contrasenia'] = md5($datos['contrasenia']);

        if(empty($errores)){
            $this->modificarUsuario($datos);
        }

        return $errores;
    }
}
