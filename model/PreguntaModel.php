<?php
class PreguntaModel {

    private $database;
    
    public function __construct($database) {
        $this->database = $database;
    }

    public function agregarPreguntaSugerida($preguntaSugerida){
        $sql = "INSERT INTO `preguntassugeridas`(`descripcion`) VALUES ('{$preguntaSugerida}')";
        $this->database->execute($sql);
    }
    public function traerPreguntasSugeridas(){
        $sql = "SELECT * FROM `preguntassugeridas`";
        return $this->database->query($sql);
    }
    public function traerPreguntasReportadas(){
        $sql = "SELECT * FROM `preguntas` WHERE reportada = 1";
        return $this->database->query($sql);
    }

    public function traerPreguntas(){
        $sql = "SELECT * FROM `preguntas`";
        return $this->database->query($sql);
    }

    public function darDeAltaPreguntaSugerida($idPregunta, $idCategoria){
        $sql = "SELECT * FROM `preguntassugeridas` WHERE id = {$idPregunta}";
        $datos = $this->database->queryUnSoloRegistro($sql);
        var_dump($datos);
        $pregunta = $datos['descripcion'];
        $sql2 = "INSERT INTO `preguntas`(`pregunta`, `id_categoria`) VALUES ('{$pregunta}', {$idCategoria})";
        $this->database->execute($sql2);
        header('location: /pregunta/editorList?preguntaSugeridaAprobada=true');
    }

    public function aprobarPreguntaReportada($idPregunta){
        $sql = "UPDATE `preguntas` SET `reportada`= 0 WHERE id = {$idPregunta}";
        $this->database->execute($sql);
        header('location: /pregunta/editorList?preguntaReportada=true');
    }

    public function eliminarPreguntaReportada($idPregunta){
        $sql = "DELETE FROM `preguntas` WHERE id = {$idPregunta}";
        $this->database->execute($sql);
        $sql2 = "DELETE FROM `respuestas` WHERE id_pregunta = {$idPregunta}";
        $this->database->execute($sql2);
        header('location: /pregunta/editorList?preguntaReportadaEliminada=true');
    }

    public function eliminarPregunta($idPregunta){
        $sql = "DELETE FROM `preguntas` WHERE id = {$idPregunta}";
        $this->database->execute($sql);
        $sql2 = "DELETE FROM `respuestas` WHERE idPregunta = {$idPregunta}";
        $this->database->execute($sql2);
        header('location: /pregunta/editorList?preguntaEliminada=true');
    }

    public function agregarPregunta($datos){
        $sql = "INSERT INTO `preguntas` (`pregunta`, `id_categoria`) VALUES ('{$datos['nuevaPregunta']}', '{$datos['idCategoria']}')";
        $this->database->execute($sql);
        $idPregunta = $this->database->lastInsertId();
        $rtaCorrecta = "INSERT INTO `respuestas` (`idPregunta`, `respuesta`, `esCorrecta`) VALUES ('{$idPregunta}', '{$datos['rta1']}', 'true')";
        $this->database->execute($rtaCorrecta);
        $rta2 = "INSERT INTO `respuestas` (`idPregunta`, `respuesta`, `esCorrecta`) VALUES ('{$idPregunta}', '{$datos['rta2']}', 'false')";
        $this->database->execute($rta2);
        if(!empty($datos['rta3'])){
            $rta3 = "INSERT INTO `respuestas` (`idPregunta`, `respuesta`, `esCorrecta`) VALUES ('{$idPregunta}', '{$datos['rta3']}', 'false')";
            $this->database->execute($rta3);
        }
        if(!empty($datos['rta4'])){
            $rta4 = "INSERT INTO `respuestas` (`idPregunta`, `respuesta`, `esCorrecta`) VALUES ('{$idPregunta}', '{$datos['rta4']}', 'false')";
            $this->database->execute($rta4);
        }
        header('location: /pregunta/editorList?preguntaAgregada=true');
    }

    public function modificarPregunta($datos){
        $idPreguntaModificada = $datos['idPregunta'];
        $nuevaDescripcion = $datos['descripcion'];
        $idCategoriaModificada = $datos['idCategoria'];
        $sql = "UPDATE `preguntas` SET `pregunta` = '$nuevaDescripcion', `id_categoria` = $idCategoriaModificada WHERE `id` = $idPreguntaModificada";
        $this->database->execute($sql);
        header('location: /pregunta/editorList?preguntaModificada=true');
    }
    
    
}