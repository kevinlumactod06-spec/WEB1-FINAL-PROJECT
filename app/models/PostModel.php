<?php
require_once __DIR__ . '/../../config/database.php';

class PostModel {
    public static function create($user_id, $content, $image) {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO posts (user_id, content, image) VALUES (?, ?, ?)");
        return $stmt->execute([$user_id, $content, $image]);
    }

    public static function getAllPosts() {
        $db = Database::connect();
        $stmt = $db->query("SELECT posts.*, users.username, users.full_name, users.profile_image 
                            FROM posts 
                            JOIN users ON posts.user_id = users.id 
                            ORDER BY posts.created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getPostsByUser($user_id) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT posts.*, users.username, users.full_name, users.profile_image 
                              FROM posts 
                              JOIN users ON posts.user_id = users.id 
                              WHERE posts.user_id = ? 
                              ORDER BY posts.created_at DESC");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function findById($postId, $userId) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM posts WHERE id = ? AND user_id = ?");
        $stmt->execute([$postId, $userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function update($postId, $userId, $content, $image) {
        $db = Database::connect();
        if ($image) {
            // Kunin ang lumang image para burahin sa folder kung meron man
            $stmt = $db->prepare("SELECT image FROM posts WHERE id = ? AND user_id = ?");
            $stmt->execute([$postId, $userId]);
            $oldPost = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($oldPost && !empty($oldPost['image'])) {
                $oldImagePath = __DIR__ . '/../../public/assets/images/' . $oldPost['image'];
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $stmt = $db->prepare("UPDATE posts SET content = ?, image = ? WHERE id = ? AND user_id = ?");
            return $stmt->execute([$content, $image, $postId, $userId]);
        } else {
            $stmt = $db->prepare("UPDATE posts SET content = ? WHERE id = ? AND user_id = ?");
            return $stmt->execute([$content, $postId, $userId]);
        }
    }

    public static function delete($postId, $userId) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT image FROM posts WHERE id = ? AND user_id = ?");
        $stmt->execute([$postId, $userId]);
        $post = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($post) {
            if (!empty($post['image'])) {
                $imagePath = __DIR__ . '/../../public/assets/images/' . $post['image'];
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            $stmt = $db->prepare("DELETE FROM posts WHERE id = ? AND user_id = ?");
            return $stmt->execute([$postId, $userId]);
        }
        return false;
    }
}
?>