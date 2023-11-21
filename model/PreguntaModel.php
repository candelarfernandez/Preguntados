<?php
class PreguntaModel {

    private $database;
    
    public function __construct($database) {
        $this->database = $database;
    }

    public function agregarPreguntaSugerida($datos){
        $sql = "INSERT INTO `preguntassugeridas` (`descripcion`) VALUES ('{$datos['nuevaPreguntaSugerida']}')";
        $this->database->execute($sql);
        $idPreguntaSugerida = $this->database->lastInsertId();
        $rtaCorrecta = "INSERT INTO `respuestassugeridas` (`idPreguntaSugerida`, `respuesta`, `esCorrecta`) VALUES ('{$idPreguntaSugerida}', '{$datos['rta1']}', 'true')";
        $this->database->execute($rtaCorrecta);
        $rta2 = "INSERT INTO `respuestassugeridas` (`idPreguntaSugerida`, `respuesta`, `esCorrecta`) VALUES ('{$idPreguntaSugerida}', '{$datos['rta2']}', 'false')";
        $this->database->execute($rta2);
        if(!empty($datos['rta3'])){
            $rta3 = "INSERT INTO `respuestassugeridas` (`idPreguntaSugerida`, `respuesta`, `esCorrecta`) VALUES ('{$idPreguntaSugerida}', '{$datos['rta3']}', 'false')";
            $this->database->execute($rta3);
        }
        if(!empty($datos['rta4'])){
            $rta4 = "INSERT INTO `respuestassugeridas` (`idPreguntaSugerida`, `respuesta`, `esCorrecta`) VALUES ('{$idPreguntaSugerida}', '{$datos['rta4']}', 'false')";
            $this->database->execute($rta4);
        }
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
    public function traerRespuestasDePreguntaSugerida($idPregunta){
        $sql3 = "SELECT * FROM `respuestassugeridas` WHERE idPreguntaSugerida = {$idPregunta}";
        return $this->database->query($sql3);
    }

    public function traerCategorias(){
        $sql = "SELECT * FROM `categorias`";
        return $this->database->query($sql);
    }

    public function darDeAltaPreguntaSugerida($idPregunta, $idCategoria, $respuestas){
        $sql = "SELECT * FROM `preguntassugeridas` WHERE id = {$idPregunta}";
        $datos = $this->database->queryUnSoloRegistro($sql);
        $pregunta = $datos['descripcion'];
        $sql2 = "INSERT INTO `preguntas`(`pregunta`, `id_categoria`) VALUES ('{$pregunta}', {$idCategoria})";
        $this->database->execute($sql2);
        $idPreguntaNueva = $this->database->lastInsertId();

        $rtaCorrecta = "INSERT INTO `respuestas` (`idPregunta`, `respuesta`, `esCorrecta`) VALUES ('{$idPreguntaNueva}', '{$respuestas[0]['respuesta']}', 'true')";
        $this->database->execute($rtaCorrecta);
        $rta2 = "INSERT INTO `respuestas` (`idPregunta`, `respuesta`, `esCorrecta`) VALUES ('{$idPreguntaNueva}', '{$respuestas[1]['respuesta']}', 'false')";
        $this->database->execute($rta2);
        if(!empty($respuestas[2])){
            $rta3 = "INSERT INTO `respuestas` (`idPregunta`, `respuesta`, `esCorrecta`) VALUES ('{$idPreguntaNueva}', '{$respuestas[2]['respuesta']}', 'false')";
            $this->database->execute($rta3);
        }
        if(!empty($respuestas[3])){
            $rta4 = "INSERT INTO `respuestas` (`idPregunta`, `respuesta`, `esCorrecta`) VALUES ('{$idPreguntaNueva}', '{$respuestas[3]['respuesta']}', 'false')";
            $this->database->execute($rta4);
        }
        $this->eliminarPreguntaSugeridaAprobada($idPregunta);
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
    public function eliminarPreguntaSugeridaAprobada($idPregunta){
        $sql2 = "DELETE FROM `respuestassugeridas` WHERE idPreguntaSugerida = {$idPregunta}";
        $this->database->execute($sql2);
        $sql = "DELETE FROM `preguntassugeridas` WHERE id = {$idPregunta}";
        $this->database->execute($sql);
      
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
        if(!empty($nuevaDescripcion)){
            $sql = "UPDATE `preguntas` SET `pregunta` = '$nuevaDescripcion', `id_categoria` = $idCategoriaModificada WHERE `id` = $idPreguntaModificada";
        }else{
            $sql = "UPDATE `preguntas` SET `id_categoria` = $idCategoriaModificada WHERE `id` = $idPreguntaModificada";
        }
      
        $this->database->execute($sql);
        header('location: /pregunta/editorList?preguntaModificada=true');
    }
    
    public function agregarCategoria($datos){
        $datos['foto'] = $_FILES['foto'];
        $nombre = $datos["datos"]["nombre"];

        $urlFoto = $this->subirFotoCategoria($datos['foto']);

        $datos['foto'] = $urlFoto;

        if($urlFoto !== false){
    
            $sql = "INSERT INTO `categorias` (`nombre_categoria`, `urlImagen`) VALUES ('{$nombre}', '{$datos['foto']}')";
            $this->database->execute($sql);
    
            header('location: /pregunta/editorList?categoriaAgregada=true');
        }
        else{
            header('location: /pregunta/editorList?errorAlAgregarCategoria=true');
        }

    }

    public function eliminarCategoria($idCategoria){
        $sqlCheck = "SELECT COUNT(*) FROM preguntas WHERE id_categoria = {$idCategoria}";
        $result = $this->database->query($sqlCheck);
        
        if ($result == 0) {
            $sqlDelete = "DELETE FROM `categorias` WHERE id_categoria = {$idCategoria}";
            $this->database->execute($sqlDelete);
            header('location: /pregunta/editorList?categoriaEliminada=true');
        } else {
            header('location: /pregunta/editorList?errorAlEliminar=true');
        }
    }

    public function modificarCategoria($datos){
        $idCategoriaModificada = $datos['idCategoria'];
        $nuevoNombre = $datos['nombre'];
        $sql = "UPDATE `categorias` SET `nombre_categoria` = '$nuevoNombre' WHERE `id_categoria` = $idCategoriaModificada";
        $this->database->execute($sql);
        header('location: /pregunta/editorList?categoriaModificada=true');
    }
    
    private function subirFotoCategoria($foto){
        $archivo_temporal = $foto['tmp_name'];
        $nombre = $foto['name'];
        $carpeta_destino = "/public/img/";
 
        if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $carpeta_destino)) {
            mkdir($_SERVER['DOCUMENT_ROOT'] . $carpeta_destino, 0777, true);
        }
   
        if(move_uploaded_file($archivo_temporal, $_SERVER['DOCUMENT_ROOT'] . $carpeta_destino . $nombre)){
            return $carpeta_destino . $nombre;
        } else {
            return false;
        }
    }
}