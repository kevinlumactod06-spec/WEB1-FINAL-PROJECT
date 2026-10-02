<?php

require_once "../config/database.php";
require_once "../app/models/PostModel.php";

class PostController
{

    public function create()
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location: index.php?page=login");
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: index.php?page=newsfeed");
            exit;
        }

        $content = trim($_POST["content"] ?? "");

        if (empty($content)) {
            header("Location: index.php?page=newsfeed&error=empty");
            exit;
        }

        $postModel = new PostModel($GLOBALS["conn"]);

        $result = $postModel->createPost(
            $_SESSION["user_id"],
            $content
        );

        if ($result) {
            header("Location: index.php?page=newsfeed");
            exit;
        }

        header("Location: index.php?page=newsfeed&error=failed");
        exit;
    }


    public function newsfeed()
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location: index.php?page=login");
            exit;
        }

        $postModel = new PostModel($GLOBALS["conn"]);

        $posts = $postModel->getAllPosts();

        require_once "../app/views/newsfeed.php";
    }


    public function edit()
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location: index.php?page=login");
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: index.php?page=newsfeed");
            exit;
        }

        $post_id = $_POST["post_id"] ?? "";
        $content = trim($_POST["content"] ?? "");

        if (empty($post_id) || empty($content)) {
            header("Location: index.php?page=newsfeed&error=empty");
            exit;
        }

        $postModel = new PostModel($GLOBALS["conn"]);

        $result = $postModel->updatePost(
            $post_id,
            $_SESSION["user_id"],
            $content
        );

        header("Location: index.php?page=newsfeed");

        exit;
    }


    public function delete()
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location: index.php?page=login");
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: index.php?page=newsfeed");
            exit;
        }

        $post_id = $_POST["post_id"] ?? "";

        if (empty($post_id)) {
            header("Location: index.php?page=newsfeed");
            exit;
        }

        $postModel = new PostModel($GLOBALS["conn"]);

        $result = $postModel->deletePost(
            $post_id,
            $_SESSION["user_id"]
        );

        header("Location: index.php?page=newsfeed");

        exit;
    }

}

?>