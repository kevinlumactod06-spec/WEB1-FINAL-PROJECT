<?php

require_once "../config/database.php";
require_once "../app/models/PostModel.php";

$postModel = new PostModel($conn);

$posts = $postModel->getAllPosts();

echo "<h2>PostModel Test</h2>";

echo "<pre>";
print_r($posts);
echo "</pre>";

?>