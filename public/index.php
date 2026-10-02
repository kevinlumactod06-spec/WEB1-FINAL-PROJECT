<?php

session_start();

$page = $_GET['page'] ?? 'login';

switch ($page) {


    // =========================
    // LOGIN
    // =========================

    case 'login':

        require_once "../app/controllers/AuthController.php";

        $controller = new AuthController();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $controller->login();

        } else {

            $controller->showLogin();

        }

        break;


    // =========================
    // REGISTER
    // =========================

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


    // =========================
    // DASHBOARD
    // =========================

    case 'dashboard':

        require_once "../app/views/dashboard.php";

        break;


    // =========================
    // PROFILE
    // =========================

    case 'profile':

        require_once "../app/controllers/ProfileController.php";

        $controller = new ProfileController();

        $controller->profile();

        break;


    case 'update_profile':

        require_once "../app/controllers/ProfileController.php";

        $controller = new ProfileController();

        $controller->update();

        break;


    // =========================
    // NEWSFEED
    // =========================

    case 'newsfeed':

        require_once "../app/controllers/PostController.php";

        $controller = new PostController();

        $controller->newsfeed();

        break;


    // =========================
    // CREATE POST
    // =========================

    case 'create_post':

        require_once "../app/controllers/PostController.php";

        $controller = new PostController();

        $controller->create();

        break;


    // =========================
    // EDIT POST
    // =========================

    case 'edit_post':

        require_once "../app/controllers/PostController.php";

        $controller = new PostController();

        $controller->edit();

        break;


    // =========================
    // DELETE POST
    // =========================

    case 'delete_post':

        require_once "../app/controllers/PostController.php";

        $controller = new PostController();

        $controller->delete();

        break;


    // =========================
    // CREATE COMMENT
    // =========================

    case 'create_comment':

        require_once "../app/controllers/CommentController.php";

        $controller = new CommentController();

        $controller->create();

        break;


    // =========================
    // EDIT COMMENT
    // =========================

    case 'edit_comment':

        require_once "../app/controllers/CommentController.php";

        $controller = new CommentController();

        $controller->edit();

        break;


    // =========================
    // DELETE COMMENT
    // =========================

    case 'delete_comment':

        require_once "../app/controllers/CommentController.php";

        $controller = new CommentController();

        $controller->delete();

        break;


    // =========================
    // LIKE / UNLIKE
    // =========================

    case 'toggle_like':

        require_once "../app/controllers/LikeController.php";

        $controller = new LikeController();

        $controller->toggle();

        break;


    // =========================
    // SEARCH
    // =========================

    case 'search':

        require_once "../app/controllers/SearchController.php";

        $controller = new SearchController();

        $controller->search();

        break;


    // =========================
    // LOGOUT
    // =========================

    case 'logout':

        require_once "../app/controllers/AuthController.php";

        $controller = new AuthController();

        $controller->logout();

        break;


    // =========================
    // DEFAULT
    // =========================

    default:

        require_once "../app/controllers/AuthController.php";

        $controller = new AuthController();

        $controller->showLogin();

        break;

}

?>