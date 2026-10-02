<?php

session_start();

$page = $_GET['page'] ?? 'login';

switch ($page) {

    case 'login':

        require_once "../app/controllers/AuthController.php";

        $controller = new AuthController();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $controller->login();

        } else {

            $controller->showLogin();

        }

        break;


    case 'register':

        require_once "../app/controllers/AuthController.php";

        $controller = new AuthController();

        $controller->showRegister();

        break;


    case 'register_process':

        require_once "../app/controllers/AuthController.php";

        $controller = new AuthController();

        $controller->register();

        break;


    case 'dashboard':

        require_once "../app/views/dashboard.php";

        break;


    case 'newsfeed':

        require_once "../app/controllers/PostController.php";

        $controller = new PostController();

        $controller->newsfeed();

        break;


    case 'create_post':

        require_once "../app/controllers/PostController.php";

        $controller = new PostController();

        $controller->create();

        break;


    case 'edit_post':

        require_once "../app/controllers/PostController.php";

        $controller = new PostController();

        $controller->edit();

        break;


    case 'delete_post':

        require_once "../app/controllers/PostController.php";

        $controller = new PostController();

        $controller->delete();

        break;


    case 'create_comment':

        require_once "../app/controllers/CommentController.php";

        $controller = new CommentController();

        $controller->create();

        break;


    case 'edit_comment':

        require_once "../app/controllers/CommentController.php";

        $controller = new CommentController();

        $controller->edit();

        break;


    case 'delete_comment':

        require_once "../app/controllers/CommentController.php";

        $controller = new CommentController();

        $controller->delete();

        break;


    case 'logout':

        require_once "../app/controllers/AuthController.php";

        $controller = new AuthController();

        $controller->logout();

        break;


    default:

        require_once "../app/controllers/AuthController.php";

        $controller = new AuthController();

        $controller->showLogin();

        break;
}

?>