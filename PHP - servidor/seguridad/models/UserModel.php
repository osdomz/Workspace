<?php
// models/UserModel.php

class UserModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getUserByEmail($email) {
        $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE Email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

