<?php

require_once "../config/database.php";
require_once "../app/models/UserModel.php";

class AuthController
{

    public function showLogin()
    {
        require_once "../app/views/login.php";
    }


    public function showRegister()
    {
        require_once "../app/views/register.php";
    }


    public function login()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            $this->showLogin();
            return;
        }

        $username = trim($_POST["username"] ?? "");
        $password = $_POST["password"] ?? "";

        if (empty($username) || empty($password)) {

            $error = "Please enter your username and password.";

            require "../app/views/login.php";

            return;
        }

        $userModel = new UserModel($GLOBALS["conn"]);

        $user = $userModel->getUserByUsername($username);

        if (!$user || !password_verify($password, $user["password"])) {

            $error = "Invalid username or password.";

            require "../app/views/login.php";

            return;
        }

        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $user["username"];
        $_SESSION["full_name"] = $user["full_name"];

        header("Location: index.php?page=dashboard");

        exit;
    }


    public function register()
    {

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {

            $this->showRegister();

            return;
        }


        $full_name = trim($_POST["full_name"] ?? "");

        $username = trim($_POST["username"] ?? "");

        $password = $_POST["password"] ?? "";

        $confirm_password = $_POST["confirm_password"] ?? "";


        // Check empty fields

        if (
            empty($full_name) ||
            empty($username) ||
            empty($password) ||
            empty($confirm_password)
        ) {

            $error = "Please fill in all fields.";

            require "../app/views/register.php";

            return;
        }


        // Check password match

        if ($password !== $confirm_password) {

            $error = "Passwords do not match.";

            require "../app/views/register.php";

            return;
        }


        // Create User Model

        $userModel = new UserModel($GLOBALS["conn"]);


        // Check if username already exists

        if ($userModel->usernameExists($username)) {

            $error = "Username already exists.";

            require "../app/views/register.php";

            return;
        }


        // Hash password

        $hashedPassword = password_hash(
            $password,
            PASSWORD_DEFAULT
        );


        // Insert user

        $result = $userModel->createUser(
            $username,
            $hashedPassword,
            $full_name
        );


        if ($result) {

            header("Location: index.php?page=login&registered=1");

            exit;

        } else {

            $error = "Registration failed.";

            require "../app/views/register.php";

            return;
        }

    }


    // Logout user

    public function logout()
    {
        session_unset();

        session_destroy();

        header("Location: index.php?page=login");

        exit;
    }

}

?>