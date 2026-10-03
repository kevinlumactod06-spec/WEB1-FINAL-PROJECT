<?php
require_once __DIR__ . '/../models/PostModel.php';

class PostController {
    public function newsfeed() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?route=login');
            exit;
        }

        $posts = PostModel::getAllPosts();
        require_once __DIR__ . '/../views/newsfeed.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            $content = trim($_POST['content'] ?? '');
            $imageName = null;

            if (!empty($_FILES['image']['name'])) {
                $targetDir = __DIR__ . '/../../public/assets/images/';
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }
                $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $imageName = 'post_' . time() . '_' . mt_rand(1000, 9999) . '.' . $ext;
                move_uploaded_file($_FILES['image']['tmp_name'], $targetDir . $imageName);
            }

            if (!empty($content) || $imageName) {
                PostModel::create($user_id, $content, $imageName);
            }

            header('Location: index.php?route=newsfeed');
            exit;
        }
    }

    public function edit() {
        if (!isset($_SESSION['user_id']) || !isset($_GET['id'])) {
            header('Location: index.php?route=profile');
            exit;
        }

        $postId = $_GET['id'];
        $userId = $_SESSION['user_id'];
        $post = PostModel::findById($postId, $userId);

        if (!$post) {
            header('Location: index.php?route=profile');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $content = trim($_POST['content'] ?? '');
            $imageName = null;

            if (!empty($_FILES['image']['name'])) {
                $targetDir = __DIR__ . '/../../public/assets/images/';
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }
                $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $imageName = 'post_' . time() . '_' . mt_rand(1000, 9999) . '.' . $ext;
                move_uploaded_file($_FILES['image']['tmp_name'], $targetDir . $imageName);
            }

            PostModel::update($postId, $userId, $content, $imageName);
            header('Location: index.php?route=profile');
            exit;
        }

        require_once __DIR__ . '/../views/edit_post.php';
    }

    public function delete() {
        if (isset($_SESSION['user_id']) && isset($_GET['id'])) {
            $postId = $_GET['id'];
            $userId = $_SESSION['user_id'];
            
            PostModel::delete($postId, $userId);
        }
        header('Location: index.php?route=profile');
        exit;
    }
}
?>