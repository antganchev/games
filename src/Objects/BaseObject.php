<?php

namespace Objects;

use DI\DependencyInjection;

/**
 * Base class for DB objects
 */

abstract class BaseObject 
{
    abstract public static function getTable(): string;

    abstract public static function getPKColumn(): string;

    /**
     * Get all rows based on provided conditions
     * 
     * @param string $condition
     * @param array $bind
     * 
     * @return array
     */
    public static function findAll(string $condition = "", array $bind = []): array
    {
        $query = "SELECT * FROM `". static::getTable()."`"; 
        if (!empty($condition)) {
            $query .= " WHERE {$condition}";
        }
        $stmt = DependencyInjection::getDI()->getService('db')->connection->prepare($query);
        $stmt->execute($bind);

        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $models = [];
        foreach ($results as $result) {
            $models[] = static::bindDataToModel($result);
        }
        return $models;
    }

    /**
     * Get single row based on provided conditions
     * 
     * @param string $condition
     * @param array $bind
     * 
     * @return array
     */
    public static function findFirst(string $condition = "", array $bind = []): BaseObject
    {
        $query = "SELECT * FROM `". static::getTable()."`"; 
        if (!empty($condition)) {
            $query .= " WHERE {$condition}";
        }
        $stmt = DependencyInjection::getDI()->getService('db')->connection->prepare($query);
        $stmt->execute($bind);

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!empty($result)) {
            return static::bindDataToModel($result);
        } else {
            return new static();
        }
    }

    /**
     * Bind array to Object model
     * 
     * @param array $data
     * 
     * @return BaseObject
     */
    public static function bindDataToModel(array $data): BaseObject
    {
        $model = new static();
        foreach($data as $field => $value) {
            $model->{$field} = $value;
        }

        return $model;
    }

    /**
     * Create a DB row
     */
    public function create()
    {
        if (method_exists($this, 'beforeCreate')) {
            $this->beforeCreate();
        }

        $columnValues = get_object_vars($this);
        $query = "INSERT INTO `". static::getTable()."` (`".implode("`,`", array_keys($columnValues))."`) VALUES (".implode(',', array_fill(0, count($columnValues), '?')).")";
        $stmt = DependencyInjection::getDI()->getService('db')->connection->prepare($query);
        $stmt->execute(array_values($columnValues));
    }
}