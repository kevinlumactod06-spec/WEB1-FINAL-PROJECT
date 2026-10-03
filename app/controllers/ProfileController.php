<?php
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../models/PostModel.php';

class ProfileController {
    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?route=login');
            exit;
        }

        $user = UserModel::findById($_SESSION['user_id']);
        $posts = PostModel::getPostsByUser($_SESSION['user_id']);
        
        require_once __DIR__ . '/../views/profile.php';
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            $bio = trim($_POST['bio'] ?? '');
            $imageName = null;

            if (!empty($_FILES['profile_image']['name'])) {
                $targetDir = __DIR__ . '/../../public/assets/images/';
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }
                $imageName = time() . '_' . basename($_FILES['profile_image']['name']);
                move_uploaded_file($_FILES['profile_image']['tmp_name'], $targetDir . $imageName);
            }

            UserModel::updateProfile($user_id, $bio, $imageName);
            
            header('Location: index.php?route=profile');
            exit;
        }
    }
}
?>