<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$route = isset($_GET['route']) ? $_GET['route'] : 'login';

// Require Controllers
require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/PostController.php';
require_once __DIR__ . '/../app/controllers/ProfileController.php';
require_once __DIR__ . '/../app/controllers/SearchController.php';
require_once __DIR__ . '/../app/controllers/CommentController.php';
require_once __DIR__ . '/../app/controllers/LikeController.php';

$authController = new AuthController();
$postController = new PostController();
$profileController = new ProfileController();
$searchController = new SearchController();
$commentController = new CommentController();
$likeController = new LikeController();

switch ($route) {
    case 'login':
        $authController->login();
        break;
    case 'register':
        $authController->register();
        break;
    case 'logout':
        $authController->logout();
        break;
    case 'dashboard':
    case 'newsfeed':
        $postController->newsfeed();
        break;
    case 'create_post':
        $postController->create();
        break;
    case 'edit_post':
        $postController->edit();
        break;
    case 'delete_post':
        $postController->delete();
        break;
    case 'profile':
        $profileController->index();
        break;
    case 'update_profile':
        $profileController->update();
        break;
    case 'search':
        $searchController->search();
        break;
    case 'add_comment':
        $commentController->create();
        break;
    case 'toggle_like':
        $likeController->toggle();
        break;
    default:
        http_response_code(404);
        echo "404 - Page Not Found";
        break;
}
?>