<?php
namespace Nguyen\DesignPatterns;

interface SQLQueryBuilder
{
    public function execselect(array $columns): SQLQueryBuilder;

    public function execcount(string $column): SQLQueryBuilder;

    public function exectake(int $limit): SQLQueryBuilder;

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

    public function execalteradd(string $table, string $column, string $data_type): SQLQueryBuilder;

    public function execalterdrop(string $table, string $column): SQLQueryBuilder;

    public function execaltermodify(string $table, string $column, string $data_type): SQLQueryBuilder;

    public function execrename(string $table, string $newname): SQLQueryBuilder;

    public function execgetSQL(): string;

    public function execexists(string $table1, string $table2, array $data): SQLQueryBuilder;

    public function executeSelectQuery(): array;

    public function executeAlterQuery(): bool;
    
    public function executeQuery(): bool;
}

