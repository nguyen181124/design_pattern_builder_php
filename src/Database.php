<?php
namespace Nguyen\DesignPatterns;

class Database
{
    public static function connect(string $hostname, string $username, string $password, string $dbname): ?\PDO
    {
        try {
            $dsn = "mysql:host=$hostname;dbname=$dbname;charset=utf8";
            $pdo = new \PDO($dsn, $username, $password);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
            return $pdo;
        } catch (\PDOException $e) {
            error_log($e->getMessage());
            return null;
        }
    }
}
