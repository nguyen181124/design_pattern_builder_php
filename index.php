<?php
require './vendor/autoload.php';
use Nguyen\DesignPatterns\MysqlQueryBuilder;
use Nguyen\DesignPatterns\Database;

$result = MysqlQueryBuilder::table("employee")->where("job", "Nhân viên")->take(2)->executeQuery();
print_r($result);