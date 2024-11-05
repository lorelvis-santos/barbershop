<?php 

namespace Model;

class ActiveRecord {
    protected static $database = null;
    protected static $tableName = "";
    protected static $columns = [];
    protected $alerts = [];
    public $id = null;

    public static function setDatabase($database) {
        self::$database = $database;
        
        //self::$database->charset("utf8");

        if (!self::$database->isConnected()) {
            self::$database->connect();
        }
    }

    public function getAlerts() : array {
        return $this->alerts;
    }

    public function validate() : bool{
        $this->alerts = [];

        return empty($this->alerts);
    }

    public function save() {
        if (!$this->validate()) 
            return false;

        if ($this->id) {
            return $this->update();
        } else {
            return self::$database->insert(static::$tableName, $this);
        }
    }

    public function update($args = []) : bool {
        if (!empty($args))
            $this->sync($args);

        if (!$this->validate())
            return false;

        if (!self::$database->update(static::$tableName, $this))
            return false;

        return true;
    }

    public function delete() : bool {
        $result = self::$database->delete(static::getTableName(), $this->id);

        return $result;
    }

    public function sync($args = []) { 
        foreach($args as $key => $value) {
            if(property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }

    public function clear() {
        foreach (static::$columns as $column) {
            $this->$column = "";
        }
    }

    public function toArray() : array {
        $result = [];

        foreach (static::$columns as $column) {
            $result[$column] = $this->$column;
        }

        return $result;
    }

    protected static function createFromArray($args) {
        $object = new static;

        foreach ($args as $key => $value) {
            if (property_exists($object, $key)) {
                $object->$key = $value;
            }
        }

        return $object;
    }

    public static function find($id) {
        return static::createFromArray(self::$database->get(static::$tableName, $id)->fetch_assoc());
    }

    public static function all($limit = -1) {
        // Obtaining all properties from database.
        $result = self::$database->getAll(static::$tableName, $limit);
        $objects = [];

        // Converting all those associative arrays into objects of our class.
        while ($args = $result->fetch_assoc()) {
            $objects[] = static::createFromArray($args);
        }

        // Freeing memory.
        $result->free();

        // Returning an array with each one of the database's objects.
        return $objects;
    }

    public static function where($column, $value, $onlyOne = false) {
        $result = self::$database->where(static::$tableName, $column, $value);
        $objects = [];

        // Converting all those associative arrays into objects of our class.
        while ($args = $result->fetch_assoc()) {
            $objects[] = static::createFromArray($args);
        }

        // Freeing memory.
        $result->free();

        // Returning an array with each one of the database's objects.
        return $onlyOne ? array_shift($objects) : $objects;
    }

    public static function getTableName() : string {
        return static::$tableName;
    }

    public static function makeQueryArray($query) {
        $result = self::$database->makeQuery($query);

        if (!$result)
            return [];
        
        $array = [];

        while ($args = $result->fetch_assoc()) {
            $array[] = $args;
        }

        return $array;
    }

    public static function makeQueryObject($query) {
        $items = self::makeQueryArray($query);

        $objects = [];

        // Converting all those associative arrays into objects of our class.
        foreach($items as $item) {
            $objects[] = static::createFromArray($item);
        }

        // Returning an array with each one of the database's objects.
        return $objects;
    }

    public static function escapeString($toEscape) {
        return self::$database->escapeString($toEscape);
    }
}