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
}
