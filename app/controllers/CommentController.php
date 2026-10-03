<?php
require_once __DIR__ . '/../models/CommentModel.php';

class CommentController {
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
            $post_id = $_POST['post_id'] ?? null;
            $content = trim($_POST['content'] ?? '');

            if ($post_id && !empty($content)) {
                CommentModel::create($post_id, $_SESSION['user_id'], $content);
            }
            header('Location: index.php?route=newsfeed');
            exit;
        }
    }
}
?>