<?php

class PostModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function createPost($user_id, $content)
    {
        $sql = "INSERT INTO posts (user_id, content)
                VALUES (?, ?)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            $user_id,
            $content
        ]);
    }

    public function getAllPosts()
    {
        $sql = "SELECT
                    posts.id,
                    posts.user_id,
                    posts.content,
                    posts.image,
                    posts.created_at,
                    users.username,
                    users.full_name,
                    users.profile_image
                FROM posts
                INNER JOIN users
                    ON posts.user_id = users.id
                ORDER BY posts.created_at DESC";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function updatePost($post_id, $user_id, $content)
    {
        $sql = "UPDATE posts
                SET content = ?
                WHERE id = ? AND user_id = ?";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            $content,
            $post_id,
            $user_id
        ]);
    }


    public function deletePost($post_id, $user_id)
    {
        $sql = "DELETE FROM posts
                WHERE id = ? AND user_id = ?";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            $post_id,
            $user_id
        ]);
    }
}

?>