<?php

namespace Core\Migrate;

use PDO;
use PDOException;

class Scheme
{
    static private function DB(): PDO
    {
        $pre = $_ENV['DB_DRIVER'] . ':host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'];
        $con = new PDO($pre, $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);

        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $con;
    }

    static public function create(string $tableName, callable $addChanges): void
    {
        $table = new SchemeBuilder($tableName);
        $table->tableName = $tableName;
        $addChanges($table);
        $query = $table->build();

        if (self::DB()->exec($query) === false) {
            throw new PDOException("Something off... [$query]");
        }
    }
}