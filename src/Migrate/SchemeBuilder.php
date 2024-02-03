<?php

namespace Core\Migrate;

use BadMethodCallException;
use InvalidArgumentException;

Class SchemeBuilder {
    public $tableName;
    private $columns = [];
    private $relationColumns = [];
    private $foreignOptions = [
        "RESTRICT",
        "CASCADE",
        "NO ACTION",
        "SET NULL"
    ];

    private $latestColName = null;

    public function __construct(string $tableName)
    {
        $this->tableName = $tableName;
    }

    public function build() :string
    {
        $stringifyColumn = implode(",", [...$this->columns, ...$this->relationColumns]);
        $stringifyColumn = rtrim($stringifyColumn, ",");
        $query = sprintf("CREATE TABLE %s(%s);", $this->tableName, $stringifyColumn);
        return $query;
    }

    public function id(string $columnName = 'id') :void
    {
        $proc = "$columnName INT UNSIGNED AUTO_INCREMENT PRIMARY KEY";
        array_push($this->columns, $proc);
    }

    public function string(string $columnName, int $length = 255) :self
    {
        $proc = "$columnName VARCHAR($length)";
        array_push($this->columns, $proc);
        return $this;
    }

    public function text(string $columnName) :self
    {
        $proc = "$columnName TEXT";
        array_push($this->columns, $proc);
        return $this;
    }

    public function enum(string $columnName, array $values) :self
    {
        $pre = implode(", ", array_map(function($element) {
            return "'" . $element . "'";
        }, $values));

        $proc = "$columnName ENUM($pre)";
        array_push($this->columns, $proc);
        return $this;
    } 

    public function int(string $columnName, int $length) :self
    {
        $proc = "$columnName INT($length)";
        array_push($this->columns, $proc);
        return $this;
    }

    public function bigInt(string $columnName) :self
    {
        $proc = "$columnName BIGINT";
        array_push($this->columns, $proc);
        return $this;
    }

    public function float(string $columnName, int $m,$d) :self
    {
        $proc = "$columnName FLOAT($m,$d)";
        array_push($this->columns, $proc);
        return $this;
    }

    public function double(string $columnName, int $m,$d) :self
    {
        $proc = "$columnName DOUBLE($m, $d)";
        array_push($this->columns, $proc);
        return $this;
    }

    
    public function year(string $columnName) :self
    {        
        $proc = "$columnName YEAR";
        array_push($this->columns, $proc);
        return $this;
    } 

    public function date(string $columnName) :self
    {
        $proc = "$columnName DATE";
        array_push($this->columns, $proc);
        return $this;
    }

    public function dateTime(string $columnName) :self
    {        
        $proc = "$columnName DATETIME";
        array_push($this->columns, $proc);
        return $this;
    } 

    public function timestamp(string $columnName) :self
    {        
        $proc = "$columnName TIMESTAMP";
        array_push($this->columns, $proc);
        return $this;
    } 

    public function unique()
    {
        $proc = "UNIQUE";
        $latestColumn = array_pop($this->columns);
        $latestColumn .= " $proc";
        array_push($this->columns, $latestColumn); 

        return $this;
    }    

    public function foreignKey(string $columnName) :self
    {
        $proc = sprintf("CONSTRAINT %s_%s FOREIGN KEY(%s)", $this->tableName, $columnName, $columnName);
        array_push($this->relationColumns, $proc);

        return $this;
    }

    public function references(string $refColumn, $refTable) :self
    {
        $proc = " REFERENCES $refTable ($refColumn)";
        $latestColumn = array_pop($this->columns);
        $latestColumn .= " $proc";

        array_push($this->relationColumns, $latestColumn);
        return $this;
    }

    public function onUpdate(string $option) :self
    {
        $option = strtoupper($option);
        if(in_array($option, $this->foreignOptions)) {
            $proc = "ON UPDATE $option";
            $latestColumn = array_pop($this->relationColumns);
            $latestColumn .= " $proc";
            array_push($this->relationColumns, $latestColumn);
            return $this;
        }
        throw new InvalidArgumentException("Unknown Option");
    }

    public function onDelete(string $option) :self
    {
        $option = strtoupper($option);
        if(in_array($option, $this->foreignOptions)) {
            $proc = "ON DELETE $option";
            $latestColumn = array_pop($this->relationColumns);
            $latestColumn .= " $proc";
            array_push($this->relationColumns, $latestColumn);
            return $this; 
        }
        throw new InvalidArgumentException("Unknown Option");
    }

    //chain foreignId()->constrained()->onUpdate() ---etc
    public function foreignId(string $columnName) :self
    {
        $proc = sprintf("%s INT UNSIGNED", $columnName);
        $this->latestColName = $columnName;
        array_push($this->columns, $proc);
        return $this;
    }

    public function constrained(string $refTable, $indexName = '') :self
    {
        if(empty($indexName)) { $indexName = sprintf("%s_%s_id", $this->tableName, $refTable); }
        if(is_null($this->latestColName)) {throw new BadMethodCallException("constrained must be call after foreignId."); }

        $proc = sprintf("CONSTRAINT %s FOREIGN KEY (%s) REFERENCES %s(id)", $indexName,$this->latestColName,$refTable);

        array_push($this->relationColumns, $proc);
        return $this;
    }

    //modifier, modifier should place at the end of chain method

    public function nullable(bool $value = true) :void
    {
        $proc = "NOT NULL";
        if($value === false) {
            $latestColumn = array_pop($this->columns);
            $latestColumn .= " $proc";
            array_push($this->columns, $latestColumn);
        } 
    }

    public function unsigned() :void
    {
        $proc = "UNSIGNED";
        $latestColumn = array_pop($this->columns);
        $latestColumn .= " $proc";

        array_push($this->columns, $latestColumn);
    }
}