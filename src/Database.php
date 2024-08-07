<?php
namespace Nguyen\DesignPatterns ;
class Database
{
    const HOST = 'localhost';
    const USERNAME = 'root';
    const PASSWORD = 'abc1234';
    const DB_NAME = 'BT';
    public function connect()
    {
        try {
            $connect = "mysql:host=" . self::HOST . ";dbname=" . self::DB_NAME . ";charset=utf8";
            $pdo = new \PDO($connect, self::USERNAME, self::PASSWORD);
            $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
            return $pdo;
        } catch (\PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}