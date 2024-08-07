<?php
require './vendor/autoload.php';
use Nguyen\DesignPatterns\MysqlQueryBuilder;
use Nguyen\DesignPatterns\Database;

$result = MysqlQueryBuilder::_rename("CITY", "city");
print_r($result);