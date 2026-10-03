<?php
require_once __DIR__ . '/../models/LikeModel.php';

class LikeController {
    public function toggle() {
        if (isset($_SESSION['user_id']) && isset($_GET['post_id'])) {
            $post_id = $_GET['post_id'];
            $user_id = $_SESSION['user_id'];

            if (LikeModel::hasLiked($post_id, $user_id)) {
                LikeModel::remove($post_id, $user_id);
            } else {
                LikeModel::add($post_id, $user_id);
            }

            header('Location: index.php?route=newsfeed');
            exit;
        }
    }
}
?>