<?php

namespace core;

use PDO;

/**
 * Class for executing queries to db.
 */
class DB
{
    protected $pdo;
    public function __construct($hostname, $login, $password, $database) {
        $this->pdo = new PDO("mysql: host={$hostname}; dbname={$database}", $login, $password);
    }

    /**
     * Execution of a request to RECEIVE data from the specified database table
     * @param string $tableName Name of DB table
     * @param string|array $fieldsList List of rows
     * @param array|null $conditionArray Conditions to find the rows
     * @return array|false
     */
    public function select($tableName, $fieldsList = '*', $conditionArray = null) {
        if (is_string($fieldsList))
            $fieldsListString = $fieldsList;
        if (is_array($fieldsList))
            $fieldsListString = implode(', ', $fieldsList);
        $wherePart = "";
        if (is_array($conditionArray)) {
            $parts = [];
            foreach ($conditionArray as $key => $value) {
                $parts [] = "{$key} = :{$key}";
            }
            $wherePartString = "WHERE ".implode(' AND ', $parts);
        }
        $res = $this->pdo->prepare("SELECT {$fieldsListString} FROM {$tableName} {$wherePartString}");
        $res->execute($conditionArray);
        return $res->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Execution of a request to UPDATE data in the database table
     * @param $tableName
     * @param $newValuesArray
     * @param $conditionArray
     * @return void
     */
    public function update($tableName, $newValuesArray, $conditionArray) {
        $setParts = [];
        $paramsArray = [];
        foreach ($newValuesArray as $key => $value) {
            $setParts [] = "{$key} = :set{$key}";
            $paramsArray['set'.$key] = $value;
        }
        $setPartString = implode(', ', $setParts);

        $whereParts = [];
        foreach ($conditionArray as $key => $value) {
            $whereParts [] = "{$key} = :{$key}";
            $paramsArray[$key] = $value;
        }
        $wherePartString = "WHERE ".implode(', ', $whereParts);

        $res = $this->pdo->prepare("UPDATE {$tableName} SET {$setPartString} {$wherePartString}");
        $res->execute($paramsArray);
    }

    /**
     * Execution of a request to INSERT data to the database table
     * @param $tableName
     * @param $newRowArray
     * @return void
     */
    public function insert($tableName, $newRowArray) {
        $fieldsArray = array_keys($newRowArray);
        $fieldsListString = implode(', ', $fieldsArray);
        $paramsArray = [];
        foreach ($newRowArray as $key => $value) {
            $paramsArray [] = ':'.$key;
        }
        $valuesListString = implode(', ', $paramsArray);
        $res = $this->pdo->prepare("INSERT INTO {$tableName} ({$fieldsListString}) VALUES ({$valuesListString})");
        $res->execute($newRowArray);
    }

    /**
     * Execution of a request to DELETE data from the database table
     * @param $tableName
     * @param $conditionArray
     * @return void
     */
    public function delete($tableName, $conditionArray) {
        $whereParts = [];
        foreach ($conditionArray as $key => $value) {
            $whereParts [] = "{$key} = :{$key}";
            $paramsArray[$key] = $value;
        }
        $wherePartString = "WHERE ".implode(', ', $whereParts);
        $res = $this->pdo->prepare("DELETE FROM {$tableName} {$wherePartString}");
        $res->execute($conditionArray);
    }
}