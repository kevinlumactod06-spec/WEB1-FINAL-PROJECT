<?php

require_once "../config/database.php";
require_once "../app/models/LikeModel.php";

class LikeController
{

    public function toggle()
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

        $likeModel = new LikeModel($GLOBALS["conn"]);

        $user_id = $_SESSION["user_id"];

        $existingLike = $likeModel->userLikedPost(
            $post_id,
            $user_id
        );


        if ($existingLike) {

            $likeModel->unlikePost(
                $post_id,
                $user_id
            );

        } else {

            $likeModel->likePost(
                $post_id,
                $user_id
            );

        }


        header("Location: index.php?page=newsfeed");

        exit;
    }

}

?>