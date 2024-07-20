<?php
require_once 'config/database.php';

class UserModel {
    private $conn;
    private $table_name = "users";

    public function __construct() {
        global $conn; 
        $this->conn = $conn;
    }

    public function register($email, $password) {
        $query = "INSERT INTO " . $this->table_name . " (email, password) VALUES (:email, :password)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', password_hash($password, PASSWORD_BCRYPT));

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function login($email, $password) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = :email";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return false;
    }
}
?>
