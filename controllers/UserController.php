<?php
require_once 'models/UserModel.php';

class UserController {
    private $model;

    public function __construct() {
        $this->model = new UserModel();
    }

    public function signup() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            if ($this->model->register($email, $password)) {
                header('Location: index.php?action=login');
            } else {
                echo "Registration failed.";
            }
        } else {
            require 'views/signup.php';
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            if ($user = $this->model->login($email, $password)) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                header('Location: index.php?action=search');
            } else {
                echo "Login failed.";
            }
        } else {
            require 'views/login.php';
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: index.php?action=login');
    }
}
?>
