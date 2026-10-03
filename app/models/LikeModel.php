<?php
require_once __DIR__ . '/../../config/database.php';

class LikeModel {
    public static function add($post_id, $user_id) {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT IGNORE INTO likes (post_id, user_id) VALUES (?, ?)");
        return $stmt->execute([$post_id, $user_id]);
    }

    public static function remove($post_id, $user_id) {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM likes WHERE post_id = ? AND user_id = ?");
        return $stmt->execute([$post_id, $user_id]);
    }

    public static function hasLiked($post_id, $user_id) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM likes WHERE post_id = ? AND user_id = ?");
        $stmt->execute([$post_id, $user_id]);
        return $stmt->fetch() !== false;
    }

    public static function getCountByPostId($post_id) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT COUNT(*) FROM likes WHERE post_id = ?");
        $stmt->execute([$post_id]);
        return $stmt->fetchColumn();
    }
}
?>
