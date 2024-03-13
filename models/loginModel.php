<?php

class loginModel extends Model
{
    public function existsUser($pseudo, $password)
    {
        $sql = $this->connection->query(
            "SELECT id FROM users WHERE user_name = '$pseudo' AND user_password = '$password'"
        );

        if (is_array($row = $sql->fetch())) {
            return $row['id'];
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

	public function retrievePassword($email, $pass)
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
