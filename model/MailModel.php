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
        $Html = '<body>
        <div style="background-color: #007BFF; color: #fff; text-align: center; padding: 20px;">
            <h1>Bienvenido a Party Quiz</h1>
        </div>
        <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
            <p>Hola!</p>
            <p>Gracias por unirte a Party Quiz. Estamos emocionados de tenerte como parte de nuestra comunidad.</p>
            <p>Para activar tu cuenta, haz clic en el enlace de abajo:</p>
            <p><a href="' . $link . '">Activar mi cuenta</a></p>
            <p>Una vez que actives tu cuenta, podrás acceder a todos los beneficios de Party Quiz.</p>
            <p>Si tienes alguna pregunta o necesitas ayuda, no dudes en ponerte en contacto con nuestro equipo de soporte: quuiz.party@gmail.com</p>
            <p>¡Gracias de nuevo por unirte a nosotros!</p>
        </div>
        <div style="background-color: #f5f5f5; text-align: center; padding: 20px;">
            <p>Party Quiz</p>
        </div>
    </body>';

        $mail->Subject = $asunto;
        $mail->Body = $Html;

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

