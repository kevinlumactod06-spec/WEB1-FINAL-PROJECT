<?php

class SearchModel
{
    private $conn;


    public function __construct($conn)
    {
        $this->conn = $conn;
    }


    public function searchUsers($keyword)
    {
        $sql = "SELECT
                    id,
                    username,
                    full_name,
                    bio,
                    profile_image
                FROM users
                WHERE username LIKE ?
                   OR full_name LIKE ?
                ORDER BY full_name ASC";

        $stmt = $this->conn->prepare($sql);

        $search = "%" . $keyword . "%";

        $stmt->execute([
            $search,
            $search
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function searchPosts($keyword)
    {
        $sql = "SELECT
                    posts.id,
                    posts.user_id,
                    posts.content,
                    posts.created_at,
                    users.username,
                    users.full_name
                FROM posts
                INNER JOIN users
                    ON posts.user_id = users.id
                WHERE posts.content LIKE ?
                   OR users.username LIKE ?
                   OR users.full_name LIKE ?
                ORDER BY posts.created_at DESC";

        $stmt = $this->conn->prepare($sql);

        $search = "%" . $keyword . "%";

        $stmt->execute([
            $search,
            $search,
            $search
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>