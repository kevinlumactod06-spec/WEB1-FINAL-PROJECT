<?php
require_once __DIR__ . '/../models/UserModel.php';

class AuthController {
    public function login() {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $password = $_POST['password'];

            $user = UserModel::findByUsername($username);
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['full_name'] = $user['full_name'];
                header('Location: index.php?route=newsfeed');
                exit;
            } else {
                $error = "Invalid username or password.";
            }
        }
        require_once __DIR__ . '/../views/login.php';
    }

    public function register() {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $full_name = trim($_POST['full_name']);
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

            if (UserModel::create($username, $password, $full_name)) {
                header('Location: index.php?route=login');
                exit;
            } else {
                $error = "Registration failed. Username may already be taken.";
            }
        }
        require_once __DIR__ . '/../views/register.php';
    }

    public function logout() {
        session_destroy();
        header('Location: index.php?route=login');
        exit;
    }
}
?>