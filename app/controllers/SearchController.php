<?php

require_once "../config/database.php";
require_once "../app/models/SearchModel.php";

class SearchController
{

    public function search()
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location: index.php?page=login");
            exit;
        }

        $keyword = trim($_GET["keyword"] ?? "");

        $users = [];
        $posts = [];

        if (!empty($keyword)) {

            $searchModel = new SearchModel(
                $GLOBALS["conn"]
            );

            $users = $searchModel->searchUsers(
                $keyword
            );

            $posts = $searchModel->searchPosts(
                $keyword
            );
        }

        require_once "../app/views/search.php";
    }

}

?>