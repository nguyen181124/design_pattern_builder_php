<?php
require './vendor/autoload.php';
use Nguyen\DesignPatterns\MysqlQueryBuilder;
use Nguyen\DesignPatterns\Database;

$db = Database::connect('localhost', 'root', 'abc1234', 'BT');
$result = (new MysqlQueryBuilder($db))->exists("city", "country", ["city_name" => "nguyen"])->executeQuery();
print_r($result);