<?php
require_once __DIR__ . '/../../config/database.php';

class SearchModel {
    public static function searchUsers($query) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT id, username, full_name, profile_image FROM users WHERE full_name LIKE ? OR username LIKE ?");
        $searchTerm = "%$query%";
        $stmt->execute([$searchTerm, $searchTerm]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>