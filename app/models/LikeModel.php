<?php

class LikeModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }


    public function likePost($post_id, $user_id)
    {
        $sql = "INSERT IGNORE INTO likes
                (post_id, user_id)
                VALUES (?, ?)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            $post_id,
            $user_id
        ]);
    }


    public function unlikePost($post_id, $user_id)
    {
        $sql = "DELETE FROM likes
                WHERE post_id = ? AND user_id = ?";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            $post_id,
            $user_id
        ]);
    }


    public function getLikeCount($post_id)
    {
        $sql = "SELECT COUNT(*) AS total
                FROM likes
                WHERE post_id = ?";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            $post_id
        ]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result["total"];
    }


    public function userLikedPost($post_id, $user_id)
    {
        $sql = "SELECT id
                FROM likes
                WHERE post_id = ? AND user_id = ?";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            $post_id,
            $user_id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

?>