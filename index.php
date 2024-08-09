<?php
require './vendor/autoload.php';
use Nguyen\DesignPatterns\MysqlQueryBuilder;
use Nguyen\DesignPatterns\Database;

$result = MysqlQueryBuilder::table("city")->select(["id"])->executeQuery();
print_r($result);