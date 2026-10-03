<?php
require_once __DIR__ . '/../models/SearchModel.php';

class SearchController {
    public function search() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?route=login');
            exit;
        }

        $query = isset($_GET['q']) ? trim($_GET['q']) : '';
        $users = [];

        if (!empty($query)) {
            $users = SearchModel::searchUsers($query);
        }

        require_once __DIR__ . '/../views/search.php';
    }
}
?>