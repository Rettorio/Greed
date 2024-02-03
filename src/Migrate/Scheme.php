<?php

namespace Core\Migrate;

use Config\Database;
use PDO;
use PDOException;

Class Scheme {
    static private function DB() :PDO
    {
        $pre = Database::DB_MS.':host='.Database::DB_HOST.';dbname='.Database::DB_NAME;
        $con = new PDO($pre, Database::DB_USER, Database::DB_PASSWORD);

        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $con;
    }

    static public function create(string $tableName, callable $addChanges) :void
    {
        $table = new SchemeBuilder($tableName);
        $table->tableName = $tableName;
        $addChanges($table);
        $query = $table->build();
        
        if(self::DB()->exec($query) === false) {
            throw new PDOException("Something off... [$query]");
        }
    }
}