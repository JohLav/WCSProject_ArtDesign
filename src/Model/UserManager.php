<?php

    namespace App\Model;

    use PDO;

class UserManager extends AbstractManager
{
    public const TABLE = 'admin';


    public function selectOneByEmail(string $email)
    {
        $query = 'SELECT * FROM ' . static::TABLE . ' WHERE email=:email';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('email', $email, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch();
    }

    public function insert(array $admin): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`email`,`password`,`role`) VALUES (:email,:password,:role)");
        $statement->bindValue('email', $admin['email'], PDO::PARAM_STR);
        $statement->bindValue('password', password_hash($admin['password'], PASSWORD_DEFAULT));
        $statement->bindValue('role', 'admin', PDO::PARAM_STR);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }
}
