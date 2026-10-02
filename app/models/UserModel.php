<?php

class UserModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }


    public function usernameExists($username)
    {
        $sql = "SELECT id FROM users WHERE username = ?";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([$username]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function createUser($username, $password, $full_name)
    {
        $sql = "INSERT INTO users
                (username, password, full_name)
                VALUES (?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            $username,
            $password,
            $full_name
        ]);
    }

    public function getUserByUsername($username)
{
    $sql = "SELECT * FROM users WHERE username = ?";

    $stmt = $this->conn->prepare($sql);

    $stmt->execute([$username]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

}

?>