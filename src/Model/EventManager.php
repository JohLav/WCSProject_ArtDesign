<?php

namespace App\Model;

use PDO;

class EventManager extends AbstractManager
{
    public const TABLE = 'event';

    /**
     * Insert new event in database
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

//    public function selectAll(string $orderBy = '', string $direction = ''): array
//    {
//        $query = 'SELECT event.name_event, event.date, event.place_id ' . self::TABLE .
//            ' JOIN place as p ON p.id=event.place_id';
//
//        $statement = $this->pdo->prepare($query);
//        $statement->execute();
//
//        return $this->pdo->query($query)->fetchAll();
//    }
}
