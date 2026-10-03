<?php
require_once __DIR__ . '/../../config/database.php';

class UserModel {
    public static function create($username, $hashed_password, $full_name) {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO users (username, password, full_name) VALUES (?, ?, ?)");
        return $stmt->execute([$username, $hashed_password, $full_name]);
    }

    public static function findByUsername($username) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function findById($id) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function updateProfile($id, $bio, $profile_image) {
        $db = Database::connect();
        if ($profile_image) {
            $stmt = $db->prepare("UPDATE users SET bio = ?, profile_image = ? WHERE id = ?");
            return $stmt->execute([$bio, $profile_image, $id]);
        } else {
            $stmt = $db->prepare("UPDATE users SET bio = ? WHERE id = ?");
            return $stmt->execute([$bio, $id]);
        }
    }
}
?>