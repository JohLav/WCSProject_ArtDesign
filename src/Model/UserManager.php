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
}
