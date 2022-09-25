<?php

namespace DB;

/**
 * Interface for the DB Adapters
 */

interface DBAdapterInterface {

    public static function getInstance(array $config): DBAdapterInterface;

}