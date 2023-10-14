<?php

require 'third-party/PHPMailer/src/PHPMailer.php';
require 'third-party/PHPMailer/src/SMTP.php';
require 'third-party/PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class MailModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function enviarMailVerificacion($email)
    {

        //Validaciones del servidor
        // $mail->SMTPDebug = 2;
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'quuiz.party@gmail.com';
        $mail->Password = 'korpippnvcgvxweb';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        //Configuraciones del mail
        $mail->setFrom('quuiz.party@gmail.com', 'Party Quiz');
        $mail->addAddress($email);

        $codigo = $this->obtenerCodigoUsuario($email);

        //Contenido del mail
        $mail->isHTML(true);
        $asunto = "Bienvenido/a a Party Quiz, valida tu cuenta";
        $link = 'http://localhost/login/validarCuenta?codigo=' . $codigo;
        $buttonHtml = '<a href="' . $link . '"><button style="padding: 10px; background-color: #337ab7; color: white; border: none; cursor: pointer;">Haz clic aquí para validar tu cuenta</button></a>';

        $mail->Subject = $asunto;
        $mail->Body = $buttonHtml;

        if($mail->send()){
            $result = true;
        }
        else{
            $result = false;
        }

        return $result;
    }


    private function obtenerCodigoUsuario($email)
    {
        $sql = "SELECT codigo FROM `usuarios` WHERE mail='{$email}';";

        $result = $this->database->execute($sql);

        return $result['codigo'];
    }
}

