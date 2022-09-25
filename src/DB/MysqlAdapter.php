<?php

namespace DB;

use DB\MysqlAdapter as DBMysqlAdapter;
use DB\DBAdapterInterface;
use PDO;

/**
 * DB Adapter for Mysql
 */

class MysqlAdapter implements DBAdapterInterface
{
    public ?PDO $connection = null;
    protected static ?DBMysqlAdapter $instance = null;

    /**
     * @param array $config
     * 
     * $config = ['host' => '', 'port' => '', 'db' => '', 'user' => '', 'pass' =>]
     */
    public function __construct(array $config)
    {
        try {
            $dsn = "mysql:host={$config['host']};dbname={$config['db']};charset={$config['charset']};port={$config['port']};";
            $this->connection = new PDO($dsn, $config['user'], $config['pass']);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch(\Exception $e) {
            die($e->getMessage());
        }
    
    }

    /**
     * @param array $config
     * 
     * check __constructur
     */
    public static function getInstance(array $config): DBMysqlAdapter
    {
        if (is_null(self::$instance)) {
            self::$instance = new DBMysqlAdapter($config);
        }

        return self::$instance;
    }

}