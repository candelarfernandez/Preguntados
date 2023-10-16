<?php

class MailController

{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function sendMail()
    {
       $usuario = $_GET['usuario'];

         $this->model->enviarMailVerificacion($usuario);
         header('Location: /login/list');
         exit();
    }
}