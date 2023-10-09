<?php
include_once('helpers/MySqlDatabase.php');
include_once("helpers/MustacheRender.php");
include_once('helpers/Router.php');
include_once('helpers/Logger.php');

include_once ("model/ToursModel.php");
include_once('model/SongsModel.php');
include_once('model/IntegrantesModel.php');
include_once('model/UsuariosModel.php');
include_once('model/LoginModel.php');

include_once('controller/IntegrantesController.php');
include_once('controller/UsuariosController.php');
include_once('controller/LoginController.php');

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

    public function getIntegrantesController(){
        return new IntegrantesController(
            new IntegrantesModel($this->getDatabase()),
            $this->getRenderer()
        );
    }

    public function getToursController() {
        return new ToursController(
            new ToursModel($this->getDatabase()),
            $this->getRenderer());
    }

    public function getSongsController() {
        return new SongsController(
            new SongsModel($this->getDatabase()),
            $this->getRenderer());
    }

    public function getLoginController() {
        return new LoginController(
            new LoginModel($this->getDatabase()),
            $this->getRenderer());
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