<?php

namespace Model;

class Database
{
    protected $database = null;
    protected $connected = false;
    protected $host;
    protected $user;
    protected $password;
    protected $databaseName;

    public function __construct($host, $user, $password, $databaseName)
    {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->databaseName = $databaseName;

        $this->connect();
    }

    public function connect(): bool
    {
        if ($this->database == null || $this->connected == false) {
            $this->database = new \mysqli($this->host, $this->user, $this->password, $this->databaseName);

            if ($this->database)
                return $this->connected = true;
        }

        return false;
    }

    public function close(): bool
    {
        if ($this->database == null)
            return false;

        return $this->database->close();
    }

    private function checkConnection(): void
    {
        if (!$this->connected)
            $this->connect();
    }

    private function sanitize($toSanitize, $isIdRequired = false): array
    {
        $result = [];

        foreach ($toSanitize as $key => $value) {
            if ($key === "id" && !$isIdRequired)
                continue;

            if ($key === "confirmPassword")
                continue;

            $result[$key] = trim($this->database->real_escape_string($value));
        }

        return $result;
    }

    public function makeQuery($query) {
        $this->checkConnection();

        $result = $this->database->query($query);

        return $result ? $result : [];
    }

    public function get($tableName, $id)
    {
        $this->checkConnection();

        // To do:
        //  - Get information of a specific object in the database.
        //  - If the result is ok, we'll return the object as an array. If not,
        //    we'll return an empty array.

        // Just to avoid any type of injection.
        $id = $this->database->real_escape_string($id);

        $query = "SELECT * FROM $tableName WHERE id = '$id' LIMIT 1;";

        $result = $this->database->query($query);

        return $result ? $result : [];
    }

    public function getAll($tableName, $limit = -1)
    {
        $this->checkConnection();

        // To do:
        //  - Get all the information from a specific table in the
        //    database using the parameters $tableName and $limit. The parameter
        //    limit will establish a limit of rows that can be returned.
        //    If the value of limit is 0 or -1, we're going to ignore it.
        //  - If the result is ok, we are going to return an array with
        //    the information. Otherwise, we'll return an empty array.

        $query = "SELECT * FROM $tableName";
        $query .= $limit > 0 ? " LIMIT $limit;" : ";";

        $result = $this->database->query($query);

        return $result ? $result : [];
    }

    public function where($tableName, $column, $value)
    {
        $this->checkConnection();

        $column = $this->database->real_escape_string($column);
        $value = $this->database->real_escape_string($value);

        $query = "SELECT * FROM $tableName WHERE $column = '$value' LIMIT 1000;";

        $result = $this->database->query($query);

        return $result ? $result : [];
    }

    public function insert($tableName, $toInsert): array
    {
        $this->checkConnection();

        $toInsert = $this->sanitize($toInsert->toArray());

        $keysToString = join(", ", array_keys($toInsert));
        $valuesToString = join("', '", array_values($toInsert));

        $query = "INSERT INTO $tableName (";
        $query .= $keysToString;
        $query .= ") VALUES ('";
        $query .= $valuesToString . "');";

        $result = $this->database->query($query);

        return [
            "result" => $result,
            "id" => $this->database->insert_id
        ];
    }

    public function update($tableName, $toUpdate): bool
    {
        $this->checkConnection();

        // To check: would I need the parameter id or not?

        // To do:
        //  - Like the function insert(), we have to sanitize the
        //    info and execute a query where we update the objective using
        //    the parameters $tableName and $toUpdate.
        //  - If the result is ok, we are going to return true. Otherwise,
        //    we'll return false.

        $toUpdate = $this->sanitize($toUpdate, true);

        // Mi método.
        // $argsToString = "";
        // $lastKey = array_key_last($toUpdate);

        // foreach ($toUpdate as $key => $value) {
        //     if ($key != $lastKey) 
        //         $argsToString .= "$key = '$value', ";
        //     else if ($key == $lastKey)
        //         $argsToString .= "$key = '$value' ";
        // }

        // Método del profesor. Mucho mejor lol.

        $values = [];

        foreach ($toUpdate as $key => $value) {
            $values[] = "$key = '$value'";
        }

        $query = "UPDATE $tableName SET ";
        $query .= join(", ", $values);
        $query .= " WHERE id = " . $toUpdate["id"];
        $query .= " LIMIT 1;";

        $result = $this->database->query($query);

        return $result;
    }

    public function delete($tableName, $id): bool
    {
        $this->checkConnection();

        // To do:
        //  - Get the info from the database and fetch it as an associate array using the id.
        //  - Checking if there is any image and delete it.
        //  - Delete the item.

        // Just to avoid any type of injection.
        $id = $this->database->real_escape_string($id);

        $item = $this->get($tableName, $id)->fetch_assoc();

        if ($item == null)
            return false;

        $query = "DELETE FROM $tableName WHERE id = " . $item["id"] . " LIMIT 1;";

        $result = $this->database->query($query);

        return $result;
    }

    public function isConnected(): bool
    {
        return $this->connected;
    }

    public function escapeString($toEscape) {
        return $this->database->real_escape_string($toEscape);
    }
}