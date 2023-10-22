<?php
//Global
include_once('helpers/MySqlDatabase.php');
include_once("helpers/MustacheRender.php");
include_once('helpers/Router.php');
include_once('helpers/Logger.php');

//Models
include_once('model/UsuariosModel.php');
include_once('model/LoginModel.php');
include_once('model/MailModel.php');
include_once('model/LobbyModel.php');
include_once('model/PartidaModel.php');
include_once('model/RankingModel.php');

//Controllers
include_once('controller/UsuariosController.php');
include_once('controller/LoginController.php');
include_once('controller/MailController.php');
include_once('controller/LobbyController.php');
include_once('controller/PartidaController.php');
include_once('controller/RankingController.php');

//Third-party
include_once('third-party/mustache/src/Mustache/Autoloader.php');
include_once('third-party/mustache/src/Mustache/Parser.php');


class Configuration {

    private $configFile = 'config/config.ini';

    public function __construct() {
    }

    public function getUsuariosController(){
        return new UsuariosController(
            new UsuariosModel($this->getDatabase()),
            $this->getRenderer()
        );
    }

       public function getLoginController() {
        return new LoginController(
            new LoginModel($this->getDatabase()),
            $this->getRenderer());
    }

    public function getLobbyController(){
        return new LobbyController(
            new LobbyModel($this->getDatabase()),
            $this->getRenderer()
        );
    }

    public function getPartidaController(){
        return new PartidaController(
            new PartidaModel($this->getDatabase()),
            $this->getRenderer()
        );
    }

    public function getRankingController(){
        return new RankingController(
            new RankingModel($this->getDatabase()),
            $this->getRenderer()
        );
    }

    public function getMailController(){
        return new MailController(
            new MailModel($this->getDatabase()),
        );
    }

    private function getArrayConfig() {
        return parse_ini_file($this->configFile);
    }

    private function getRenderer() {
        return new MustacheRender('view/partial');
    }

    public function getDatabase() {
        $config = $this->getArrayConfig();
        return new MySqlDatabase(
            $config['servername'],
            $config['username'],
            $config['password'],
            $config['database']);
    }

    public function getRouter() {
        return new Router(
            $this,
            "getLoginController",
            "list");
    }
}