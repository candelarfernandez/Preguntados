<?php

class SongsModel {

    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function getSongs() {
        return $this->database->query('SELECT * FROM usuarios');
    }
}