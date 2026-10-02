<?php

require_once "../config/database.php";
require_once "../app/models/UserModel.php";

class ProfileController
{

    public function profile()
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location: index.php?page=login");
            exit;
        }

        $userModel = new UserModel($GLOBALS["conn"]);

        $user = $userModel->getUserById(
            $_SESSION["user_id"]
        );

        if (!$user) {
            header("Location: index.php?page=dashboard");
            exit;
        }

        require_once "../app/views/profile.php";
    }


    public function update()
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location: index.php?page=login");
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: index.php?page=profile");
            exit;
        }

        $full_name = trim(
            $_POST["full_name"] ?? ""
        );

        $bio = trim(
            $_POST["bio"] ?? ""
        );


        if (empty($full_name)) {
            header(
                "Location: index.php?page=profile&error=empty"
            );

            exit;
        }


        $userModel = new UserModel($GLOBALS["conn"]);

        $result = $userModel->updateProfile(
            $_SESSION["user_id"],
            $full_name,
            $bio
        );


        if ($result) {

            $_SESSION["full_name"] = $full_name;

            header(
                "Location: index.php?page=profile&updated=1"
            );

            exit;

        }


        header(
            "Location: index.php?page=profile&error=failed"
        );

        exit;
    }

}

?>