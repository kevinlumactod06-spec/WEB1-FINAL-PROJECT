<?php

class CommentModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }


    public function createComment($post_id, $user_id, $content)
    {
        $sql = "INSERT INTO comments
                (post_id, user_id, content)
                VALUES (?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            $post_id,
            $user_id,
            $content
        ]);
    }


    public function getCommentsByPost($post_id)
    {
        $sql = "SELECT
                    comments.id,
                    comments.post_id,
                    comments.user_id,
                    comments.content,
                    comments.created_at,
                    users.username,
                    users.full_name
                FROM comments
                INNER JOIN users
                    ON comments.user_id = users.id
                WHERE comments.post_id = ?
                ORDER BY comments.created_at ASC";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            $post_id
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function updateComment($comment_id, $user_id, $content)
    {
        $sql = "UPDATE comments
                SET content = ?
                WHERE id = ? AND user_id = ?";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            $content,
            $comment_id,
            $user_id
        ]);
    }


    public function deleteComment($comment_id, $user_id)
    {
        $sql = "DELETE FROM comments
                WHERE id = ? AND user_id = ?";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            $comment_id,
            $user_id
        ]);
    }
}

?>