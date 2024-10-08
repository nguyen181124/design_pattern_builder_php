<?php

namespace Nguyen\DesignPatterns;

class MysqlQueryBuilder implements SQLQueryBuilder
{
    protected $query;

    protected $table;

    private $db;

    public function __construct($db)
    {
        $this->db = $db;
        $this->query = new \stdClass();
        $this->query->select = "*";
    }

    public function __call(string $name, array $arguments)
    {
        return $this->{"exec" . $name}(...$arguments);

    }

    public static function __callStatic(string $name, array $arguments)
    {
        return (new static)->{"exec" . $name}(...$arguments);
    }

    public function execselect(array $columns): SQLQueryBuilder
    {
        $this->query->type = 'select';
        $this->query->select = empty($columns) ? "*" : implode(", ", $columns);

        return $this;
    }

    public function execcount(string $column): SQLQueryBuilder
    {
        $this->query->type = 'select';
        $this->query->select = "COUNT" . "(" . $column . ")";

        return $this;
    }

    public function exectake(int $limit): SQLQueryBuilder
    {
        $this->query->limit = " LIMIT " . $limit;

        return $this;
    }

    public function execinsert(string $table, array $data): SQLQueryBuilder
    {

        $this->query->type = 'insert';
        $values = implode(", ", array_map(function ($value) {
            return "'" . $value . "'";
        }, array_values($data)));

        $this->query->insert = "INSERT INTO " . $table . " VALUES ($values)";

        return $this;
    }

    public function exectable(string $table): self
    {
        $this->query->table = $table;
        $this->query->type = 'select';

        return $this;
    }


    public function execwhere(string $column, string $value, string $operator = '='): SQLQueryBuilder
    {

        if (!isset($this->query->where)) {
            $this->query->where = [];
        }

        $this->query->where[] = " $column $operator '$value'";

        return $this;
    }

    public function execorwhere(string $column, string $value, string $operator = '='): SQLQueryBuilder
    {

        if (!isset($this->query->orwhere)) {
            $this->query->orwhere = [];
        }

        $this->query->orwhere[] = " $column $operator '$value'";

        return $this;
    }

    public function execnotwhere(string $column, string $value, string $operator = '='): SQLQueryBuilder
    {

        if (!isset($this->query->notwhere)) {
            $this->query->notwhere = [];
        }

        $this->query->notwhere[] = " $column $operator '$value'";

        return $this;
    }

    public function execorderby(array $columns): SQLQueryBuilder
    {
        $this->query->type = 'select';
        $setColumns = [];
        foreach ($columns as $column => $value) {
            $setColumns[] = "$column " . $value;
        }

        $this->query->order = " ORDER BY " . implode(", ", $setColumns);

        return $this;
    }

    public function execfind(string $table, int $id): SQLQueryBuilder
    {
        $this->query->base = "SELECT * FROM " . $table;
        $this->query->type = 'select';
        $this->execwhere('id', $id);

        return $this;
    }

    public function execdelete(string $table, string $column, string $value, string $operator = '='): SQLQueryBuilder
    {
        $this->query->delete = "DELETE FROM " . $table . " WHERE " . $column . " " . $operator . " '" . $value . "'";
        $this->query->type = 'delete';

        return $this;
    }

    public function execupdate(string $table, array $data): SQLQueryBuilder
    {
        $setClauses = [];

        foreach ($data as $column => $value) {
            $setClauses[] = "$column = '" . $value . "'";
        }

        $this->query->update = "UPDATE " . $table . " SET " . implode(", ", $setClauses);
        $this->query->type = 'update';

        return $this;
    }

    public function execlimit(int $start, int $offset): SQLQueryBuilder
    {
        $this->query->type = ['select'];
        $this->query->limit = " LIMIT " . $start . ", " . $offset;

        return $this;
    }

    public function execin(string $column, array $data): SQLQueryBuilder
    {
        $this->query->type = ['select'];
        $this->query->limit = " WHERE $column IN (";

        $values = [];
        foreach ($data as $value) {
            $values[] = "'" . $value . "'";
        }

        $this->query->limit .= implode(', ', $values) . ')';

        return $this;
    }


    public function execjoins(string $table, string $join, string $column1, string $column2): SQLQueryBuilder
    {
        $this->query->type = ['select'];
        $this->query->join = $join . " JOIN " . $table . " ON " . $table . "." . $column1 . " = " . $table . "." . $column2;

        return $this;
    }

    public function execfirst(): SQLQueryBuilder
    {
        $this->query->type = ['select'];
        $this->query->limit = " LIMIT 1";

        return $this;
    }

    public function execalteradd(string $table, string $column, string $data_type): SQLQueryBuilder
    {
        $this->query->alter = "ALTER TABLE " . $table . " ADD COLUMN " . $column . " " . $data_type;
        $this->query->type = 'alter';

        return $this;
    }

    public function execalterdrop(string $table, string $column): SQLQueryBuilder
    {
        $this->query->alter = "ALTER TABLE " . $table . " DROP COLUMN " . $column;
        $this->query->type = 'alter';

        return $this;
    }

    public function execaltermodify(string $table, string $column, string $data_type): SQLQueryBuilder
    {
        $this->query->alter = "ALTER TABLE " . $table . " MODIFY COLUMN " . $column . " " . $data_type;
        $this->query->type = 'alter';

        return $this;
    }

    public function execrename(string $table, string $newname): SQLQueryBuilder
    {
        $this->query->alter = "ALTER TABLE " . $table . " RENAME TO " . $newname;
        $this->query->type = 'alter';

        return $this;
    }

    public function execexists(string $table1, string $table2, array $data): SQLQueryBuilder
    {
        $setClauses = [];

        foreach ($data as $column => $value) {
            $setClauses[] = "$column = '" . $value . "'";
        }

        $this->query->exists = "SELECT * FROM " . $table1 . " WHERE EXISTS " . "(SELECT * FROM " . $table2 . " WHERE " . implode('AND ', $setClauses) . ")";
        $this->query->type = 'exists';

        return $this;
    }

    public function execgetSQL(): string
    {
        $query = $this->query;
        $sql = "SELECT " . $this->query->select . " FROM " . $this->query->table;
        if (!empty($query->where)) {
            $sql .= " WHERE " . implode(' AND ', $query->where);
        }
        if (!empty($query->orwhere)) {
            $sql .= " OR " . implode(' OR ', $query->orwhere);
        }
        if (!empty($query->notwhere)) {
            $sql .= " WHERE NOT" . implode(' AND NOT', $query->notwhere);
        }
        if (isset($query->limit)) {
            $sql .= $query->limit;
        }
        if (isset($query->order)) {
            $sql .= $query->order;
        }
        $sql .= ";";

        return $sql;
    }

    public function executeSelectQuery(): array
    {
        $sql = $this->execgetSQL();
        print_r($sql);
        $db = new Database();
        try {
            $qr = $this->db->query($sql);
        } catch (\PDOException $e) {
            echo "Error executing query: " . $e->getMessage();
            return [];
        }
        $ar = [];
        while ($row = $qr->fetch(\PDO::FETCH_ASSOC)) {
            $ar[] = $row;
        }

        return $ar;
    }

    public function executeAlterQuery(): bool
    {
        $sql = $this->query->alter;
        print_r($sql);
        $db = new Database();
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return true;
        } catch (\PDOException $e) {
            echo "Error executing ALTER query: " . $e->getMessage();
            return false;
        }
    }

    public function executeQuery(): bool
    {
        $sql = $this->query->insert ?? $this->query->delete ?? $this->query->update ?? $sql = $this->query->exists;
    
        if (empty($sql)) {
            // Handle case where neither insert nor delete is present
            return false; // or throw an exception
        }
    
        $db = new Database();
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return true;
        } catch (\PDOException $e) {
            echo "Error executing query: " . $e->getMessage();
            return false;
        }
    }
    
}

