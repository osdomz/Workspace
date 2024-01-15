<?php
// models/UserModel.php

class UserModel
{
    private $pdo;

    public function __construct()
    {
        $dbConfig = require_once('../config/database.php');
        $this->pdo = new PDO(
            "mysql:host={$dbConfig['host']};dbname={$dbConfig['dbname']}",
            $dbConfig['user'],
            $dbConfig['password']
        );
    }

    public function getUserByEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE Email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
