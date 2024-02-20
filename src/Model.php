<?php

namespace Core;

use PDO;
use PDOException;

class Model
{
    protected $table;
    protected $primaryKey;
    protected $foreignKey;
    protected $fillable;
    protected $fill;
    //pdo instance
    static $db = null;
    private $query = "";
    private $host;
    private $database;


    public function __construct()
    {
        $this->host = $_ENV['DB_HOST'];
        $this->database = $_ENV['DB_NAME'];
        $dbms = $_ENV['DB_DRIVER'];
        $user = $_ENV['DB_USERNAME'];
        $pass = $_ENV['DB_PASSWORD'];
        if (is_null(static::$db)) {
            $conf = $dbms . ':host=' . $this->host . ';dbname=' . $this->database;
            $db = new PDO($conf, $user, $pass);

            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            static::$db = $db;
        }
    }

    public static function __callStatic($name, $arguments)
    {
        $obj = new self;
        $actualName = $name[0] . substr($name, 1);
        var_dump($actualName);
        if (method_exists($obj, $actualName)) {
            call_user_func_array("$obj->$actualName", $arguments);
        }
    }

    public function __set($name, $value)
    {
        if (array_search($name, $this->fillable) !== false) {
            $this->fill[$name] = $value;
        }
    }

    protected function getTableName(): string
    {
        return $this->table;
    }

    protected function getPrimaryKey(): string
    {
        return $this->primaryKey;
    }

    public function Save()
    {
        if (!empty($this->fill)) {
            $this->Insert($this->fill);
            return true;
        }
        return false;
    }

    public function getAll(string $additional = ""): iterable
    {
        $base = "SELECT * FROM $this->table $additional";
        try {
            $result = $this->DB()->prepare($base);
            $result->execute();
            return $result->fetchAll();
        } catch (PDOException $e) {
            throw $e;
        }
    }
    public function first($id)
    {
        try {
            $result = $this->DB()->prepare("SELECT * FROM $this->table WHERE $this->primaryKey = $id");
            $result->execute();
            return $result->fetch();
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function insert(array $data)
    {
        $columns = implode(',', array_keys($data));
        $values = '';
        foreach (array_values($data) as $value) {
            if (gettype($value) === "string") {
                $values .= "'{$value}',";
            } else {
                $values .= "$value,";
            }
        }
        $values = rtrim($values, ',');
        try {
            $sql = "INSERT INTO $this->table ($columns) VALUES ($values)";
            $insert = $this->DB()->prepare($sql);
            $insert->execute();
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function update(array $data, int $id)
    {
        $set = "";
        foreach ($data as $key => $val) {
            $set .= "$key = '$val',";
        }
        $set = rtrim($set, ",");
        try {
            $query = "UPDATE $this->table SET $set WHERE $this->primaryKey = $id";
            $update = $this->DB()->prepare($query);
            $update->execute();
        } catch (\PDOException  $e) {
            throw $e;
        }
    }

    public function delete(int $id)
    {
        try {
            $sql = "DELETE FROM $this->table WHERE $this->primaryKey = $id";
            $hapus = $this->DB()->prepare($sql);
            $hapus->execute();
        } catch (PDOException $e) {
            throw $e;
        }
    }

    //static method

    public function select($columns = [])
    {
        if (empty($columns)) {
            $cols = "*";
        } else {
            $cols = implode(",", $columns);
        }
        $this->query .= "SELECT $cols FROM  $this->table ";
        return $this;
    }

    public function where($column, $operator, $value)
    {
        $operators = [
            '=', '!=', '>', '<', '>=', '<=', '<>',
            'BETWEEN',
            'LIKE',
            'IN'
        ];
        if (in_array($operator, $operators)) {
            $this->query .= strpos($this->query, "WHERE") ? "AND $column $operator '$value'" : "WHERE $column $operator '$value'";
        }
        return $this;
    }

    public function get()
    {
        try {
            $result = $this->DB()->prepare($this->query);
            $result->execute();
            return $result->fetchAll();
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function getFirst()
    {
        try {
            $result = $this->DB()->prepare($this->query);
            $result->execute();
            return $result->fetch();
        } catch (PDOException $e) {
            throw $e;
        }
    }

    //relation
    protected function hasOne($rClass)
    {
        $rClass =  new $rClass;
        $rtable = $rClass->getTableName();
        $rPrimarykey = $rClass->getPrimaryKey();
        $ntable = $this->table;
        $nforeignKey = $this->foreignKey;
        $this->query .= "INNER JOIN $rtable ON $ntable.$nforeignKey = $rtable.$rPrimarykey ";
        return $this;
    }

    public function DB(): PDO
    {
        return static::$db;
    }
}