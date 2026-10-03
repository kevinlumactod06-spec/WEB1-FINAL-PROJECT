<?php
require_once __DIR__ . '/../../config/database.php';

class CommentModel {
    public static function getByPostId($post_id) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT comments.*, users.username, users.full_name, users.profile_image 
                              FROM comments 
                              JOIN users ON comments.user_id = users.id 
                              WHERE post_id = ? 
                              ORDER BY created_at ASC");
        $stmt->execute([$post_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create($post_id, $user_id, $content) {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO comments (post_id, user_id, content) VALUES (?, ?, ?)");
        return $stmt->execute([$post_id, $user_id, $content]);
    }
}
?>