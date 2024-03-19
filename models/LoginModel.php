<?php

class LoginModel extends Model
{
    public function existsUser($pseudo, $password): ?array
    {
        $sql = $this->connection->query(
            "SELECT u.id, user_name, msg_color FROM users u LEFT JOIN messages m ON m.msg_user_id = u.id WHERE user_name = '$pseudo' AND user_password = '$password'"
        );

        if (is_array($row = $sql->fetch())) {
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

        $query->execute() or die(false);

        if ($this->connection->lastInsertId() != NULL) {
            return $this->connection->lastInsertId();
        } else {
            return null;
        }
	}

	public function retrievePassword($email, $pass): bool
    {
        $query = $this->connection->query("SELECT id FROM users WHERE user_email = '$email'")->fetch();

        if ($query != '') {
            $query = $this->connection->query("UPDATE users SET user_password = '$pass' WHERE user_email = '$email'");
            return true;
        } else {
            return false;
        }
    }
}
