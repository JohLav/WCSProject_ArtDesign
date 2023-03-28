<?php

namespace App\Model;

use PDO;

class PlaceManager extends AbstractManager
{
    public const TABLE = 'place';
    public function search(array $search): array
    {
//        $query = 'SELECT * FROM ' . static::TABLE;
        $query = 'SELECT * FROM ' . static::TABLE . ' where type =:type AND city_code =:city_code';

        $statement = $this->pdo->prepare($query);
        $statement->bindValue('type', $search["event"]);
        $statement->bindValue('city_code', $search["place"]);
        $statement->execute();
        return $statement->fetchAll();
    }
}
