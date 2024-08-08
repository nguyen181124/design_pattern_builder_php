<?php
require './vendor/autoload.php';
use Nguyen\DesignPatterns\MysqlQueryBuilder;
use Nguyen\DesignPatterns\Database;

$result = MysqlQueryBuilder::select(["id", "city_name", "country_id", "population"])->executeQuery();
print_r($result);