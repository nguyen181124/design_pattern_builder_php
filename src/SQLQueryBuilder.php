<?php
namespace Nguyen\DesignPatterns;

interface SQLQueryBuilder
{

    public function execinsert(string $table, array $data): SQLQueryBuilder;

    public function execwhere(string $column, string $value): SQLQueryBuilder;

    public function execorwhere(string $column, string $value, string $operator = '='): SQLQueryBuilder;

    public function execnotwhere(string $column, string $value, string $operator = '='): SQLQueryBuilder;

    public function execorderby(array $data): SQLQueryBuilder;

    public function execfind(string $table, int $id): SQLQueryBuilder;
    
    public function execupdate(string $table, array $data): SQLQueryBuilder;

    public function execdelete(string $table, string $column, string $value): SQLQueryBuilder;

    public function execlimit(int $start, int $offset): SQLQueryBuilder;

    public function execin(string $column, array $data): SQLQueryBuilder;

    public function execjoins(string $table, string $join, string $column1, string $column2): SQLQueryBuilder;

    public function execfirst(): SQLQueryBuilder;

    public function exec_alteradd(string $table, string $column, string $data_type): SQLQueryBuilder;

    public function exec_alterdrop(string $table, string $column): SQLQueryBuilder;

    public function exec_altermodify(string $table, string $column, string $data_type): SQLQueryBuilder;

    public function exec_rename(string $table, string $newname): SQLQueryBuilder;

    public function execgetSQL(): string;

    public function executeQuery(): array;

    public function executeAlterQuery(): bool;
}

