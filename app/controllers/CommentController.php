<?php

require_once "../config/database.php";
require_once "../app/models/CommentModel.php";

class CommentController
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

        $post_id = $_POST["post_id"] ?? "";
        $content = trim($_POST["content"] ?? "");

        if (empty($post_id) || empty($content)) {
            header("Location: index.php?page=newsfeed&error=comment_empty");
            exit;
        }

        $commentModel = new CommentModel($GLOBALS["conn"]);

        $result = $commentModel->createComment(
            $post_id,
            $_SESSION["user_id"],
            $content
        );

        if ($result) {
            header("Location: index.php?page=newsfeed");
            exit;
        }

        header("Location: index.php?page=newsfeed&error=comment_failed");
        exit;
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

        $comment_id = $_POST["comment_id"] ?? "";
        $content = trim($_POST["content"] ?? "");

        if (empty($comment_id) || empty($content)) {
            header("Location: index.php?page=newsfeed&error=comment_empty");
            exit;
        }

        $commentModel = new CommentModel($GLOBALS["conn"]);

        $commentModel->updateComment(
            $comment_id,
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

        $comment_id = $_POST["comment_id"] ?? "";

        if (empty($comment_id)) {
            header("Location: index.php?page=newsfeed");
            exit;
        }

        $commentModel = new CommentModel($GLOBALS["conn"]);

        $commentModel->deleteComment(
            $comment_id,
            $_SESSION["user_id"]
        );

        header("Location: index.php?page=newsfeed");

        exit;
    }

}

?>