<?php
class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function fetchByEmail($email) {
        $sql = sprintf("SELECT * FROM Users WHERE email = '%s'", $this->db->mysqli->real_escape_string($email));
        $query = mysqli_query($this->db->mysqli, $sql);
        return $query->fetch_assoc();
    }

    public function createUser($name, $email, $password) {
        $pass_hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO Users (name, email, pass_hash) VALUES ('$name', '$email', '$pass_hash')";
        return mysqli_query($this->db->mysqli, $sql);
    }
}