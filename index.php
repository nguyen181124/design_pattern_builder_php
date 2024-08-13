<?php
require './vendor/autoload.php';
use Nguyen\DesignPatterns\MysqlQueryBuilder;
use Nguyen\DesignPatterns\Database;

$result = MysqlQueryBuilder::exists("city", "country", ["city_name" => "nguyen"])->executeExistsQuery();
print_r($result);