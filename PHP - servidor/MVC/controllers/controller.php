<?php

class Controller {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function insertData($name, $email) {
        return $this->model->insertData($name, $email);
    }
}






