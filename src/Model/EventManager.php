<?php

namespace App\Model;

use PDO;

class EventManager extends AbstractManager
{
    public const TABLE = 'event';

    /**
     * Insert new item in database
     */
    public function insert(array $item): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE .
            " (`name_event`,`date`,`place_id`)
            VALUES (:name_event ,:date, :place_id)");
        $statement->bindValue('name_event', $item['name_event'], PDO::PARAM_STR);
        $statement->bindValue('date', $item['date'], PDO::PARAM_STR);
        $statement->bindValue('place_id', $item['place_id'], PDO::PARAM_INT);


        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }
}
