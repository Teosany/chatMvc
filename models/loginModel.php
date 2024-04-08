<?php

class loginModel extends Model
{
    public function existsUser($pseudo, $password): ?array
    {
        $sql = "SELECT u.id, user_name, msg_color 
                FROM users u 
                LEFT JOIN messages m ON m.msg_user_id = u.id 
                WHERE user_name = :pseudo 
                AND user_password = :password";

        $query = $this->connection->prepare($sql);
        $query->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();

        $row = $query->fetch(PDO::FETCH_ASSOC);

        if ($row !== false) {
            return [$row['id'], $row['user_name'], $row['msg_color']];
        } else {
            return null;
        }
    }

	public function createUser($name, $pass, $email)
	{
        $sql = "INSERT INTO users (user_name, user_password, user_email) 
                VALUES (:name, :pass, :email)";

        $query = $this->connection->prepare($sql);
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':pass', $pass, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);

        if ($query->execute()) {
            $lastInsertId = $this->connection->lastInsertId();
            if ($lastInsertId != null) {
                return [$lastInsertId, $name];
            }
        }

        return null;
	}

	public function retrievePassword($email, $pass): bool
    {
        $sql = "SELECT id FROM users WHERE user_email = :email";
        $query = $this->connection->prepare($sql);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();
        $row = $query->fetch(PDO::FETCH_ASSOC);

        if ($row !== false) {
            $sql = "UPDATE users SET user_password = :pass WHERE user_email = :email";
            $query = $this->connection->prepare($sql);
            $query->bindParam(':pass', $pass, PDO::PARAM_STR);
            $query->bindParam(':email', $email, PDO::PARAM_STR);
            $query->execute();
            return true;
        } else {
            return false;
        }
    }
}
