<?php

use Nguyen\DesignPatterns\SQLQueryBuilder;
use PHPUnit\Framework\TestCase;
use Nguyen\DesignPatterns\MysqlQueryBuilder;
use Nguyen\DesignPatterns\Database;

final class MysqlQueryBuilderTest extends TestCase
{
    protected $query;

    private $db;

    protected function setUp(): void
    {
        $this->db = new Database();
        $this->db->connect('localhost', 'root', 'abc1234', 'BT');
        $this->table = 'city';
    }

    // public function testExeccount()
    // {
    //     $queryBuilder = new MysqlQueryBuilder($this->db);
    //     $count = $queryBuilder->execcount('id');
    //     $this->assertIsInt($count); 
    // }


    public function testExecinsert()
    {
        $queryBuilder = new MysqlQueryBuilder($this->db);
        $sql = $queryBuilder->execinsert('city', ['"6", "nguyen", "2", "453534"']);
        $this->assertIsString($sql);
    }
}