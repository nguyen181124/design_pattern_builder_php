<?php

use PHPUnit\Framework\TestCase;
use Nguyen\DesignPatterns\Database;

final class DatabaseTest extends TestCase
{
    public function testConnect()
    {
        $pdo = Database::connect('localhost', 'root', 'abc1234', 'BT');
        $this->assertInstanceOf(\PDO::class, $pdo);
    }
}