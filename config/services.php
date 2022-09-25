<?php

/** Add services to DI */

use DB\MysqlAdapter;
use Request\Request;

$di->setService('config', $config);

$di->setService('db', function() use ($config) {
    return MysqlAdapter::getInstance($config['db']);
});

$di->setService('request', function() {
    return Request::getInstance();
});