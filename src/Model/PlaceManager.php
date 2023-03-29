<?php

    namespace App\Model;

    use PDO;

class PlaceManager extends AbstractManager
{
    public const TABLE = 'place';

    /**
     * Insert new item in database
     */
    public function insert(array $item): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE .
            " (`kind`,`address`,`city_code`,`city`,`phone`, `type`)
        VALUES (:kind ,:address, :city_code, :city, :phone, :type )");
        $statement->bindValue('kind', $item['kind'], PDO::PARAM_STR);
        $statement->bindValue('address', $item['address'], PDO::PARAM_STR);
        $statement->bindValue('city_code', $item['city_code'], PDO::PARAM_STR);
        $statement->bindValue('city', $item['city'], PDO::PARAM_STR);
        $statement->bindValue('phone', $item['phone'], PDO::PARAM_STR);
        $statement->bindValue('type', $item['type'], PDO::PARAM_STR);


        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    /**
     * Update item in database
     */
    public function update(array $item): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . "
        SET (`kind`,`address`,`city_code`,`city`,`phone`) = :title WHERE id=:id");
        $statement->bindValue('id', $item['id'], PDO::PARAM_INT);
        $statement->bindValue('kind', $item['kind'], PDO::PARAM_STR);
        $statement->bindValue('adress', $item['address'], PDO::PARAM_STR);
        $statement->bindValue('kind', $item['city_code'], PDO::PARAM_STR);
        $statement->bindValue('kind', $item['city'], PDO::PARAM_STR);
        $statement->bindValue('kind', $item['phone'], PDO::PARAM_STR);

        return $statement->execute();
    }
}
