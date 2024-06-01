<?php

namespace App\Traits;

use App\Core\Database;
use InvalidArgumentException;

trait Model
{
    protected static array $whereParams = [];
    protected static array $joinParams = [];
    protected static string $whereClause = '';
    protected static string $joinClause = '';
    protected static string $orderByClause = '';
    protected static string $limitClause = '';
    protected static string $offsetClause = '';
    protected static string $groupClause = '';
    protected static string $havingClause = '';
    protected static string $selectClause = '';
    protected static string $lastQuery = '';
    protected static ?Database $database = null;

    /**
     * Initialize the database connection.
     */
    public static function init(): void
    {
        if (self::$database === null) {
            self::$database = Database::getInstance();
        }
    }

    /**
     * Get the table fields from the Model class.
     *
     * @return array The table fields.
     */
    public static function fields(): array
    {
        return static::$fields ?? ['*'];
    }

    /**
     * Save the model data to the database.
     *
     * @return object|array|null The saved record as an array, or null if not saved.
     */
    public function save(): object|array|null
    {
        $data = get_object_vars($this);
        $id = $data['id'] ?? null;
        unset($data['id']);

        // Dynamically sanitize each value in the $data array
        foreach ($data as $key => $value) {
            switch (gettype($value)) {
                case 'string':
                    $data[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
                    break;
                case 'integer':
                case 'double':
                    $data[$key] = filter_var($value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    break;
                case 'boolean':
                    $data[$key] = (int)$value;
                    break;
                case 'array':
                    $data[$key] = json_encode($value);
                    break;
                default:
                    throw new InvalidArgumentException("Invalid data type for field '$key': " . gettype($value));
            }
        }

        $table = $this->getTableName();
        $params = array_values($data);

        if ($id) {
            $updateColumns = implode(' = ?, ', array_keys($data)) . ' = ?';
            array_push($params, $id);
            $sql = "UPDATE $table SET $updateColumns WHERE id = ?";
        } else {
            $columns = implode(', ', array_keys($data));
            $placeholders = implode(', ', array_fill(0, count($data), '?'));
            $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        }

        self::init();
        self::$database->query($sql, $params);

        return self::findById(self::$database->lastInsertId($table));
    }


    /**
     * Select all records from the database.
     *
     * @return string The SQL query to select all records.
     */
    public static function select(array $columns = null): string
    {
        $table = static::getTableName();
        $fields = $columns ? implode(', ', array_map(fn ($col) => "$table.$col", $columns)) : implode(',', array_map(fn ($col) => "$table.$col", self::fields()));
        return "SELECT $fields FROM $table";
    }

    /**
     * Delete a record from the database.
     *
     * @param int|string $id The ID of the record to delete.
     * @return void
     */
    public static function delete(string|int $id): void
    {
        self::init();
        self::$database->query("DELETE FROM " . static::getTableName() . " WHERE id = ?", [$id]);
    }

    /**
     * Find a record by ID.
     *
     * @param string|int $id The ID of the record to find.
     * @param array|null $columns The columns to select.
     * @return object|array|null The found record, or null if not found.
     */
    public static function findById(string|int $id, array $columns = null): object|array|null
    {
        $query = $columns ? self::select($columns) : self::select();
        $query .= ' WHERE id = ?';
        self::init();
        $result = self::$database->query($query, [$id])->findOrFail();

        return $result ?: null;
    }

    /**
     * Get a record from the database by its slug.
     *
     * @param string $slug The slug of the record to retrieve.
     * @return object|null The retrieved record as an array, or null if not found.
     */
    public static function findBySlug(string $slug): ?object
    {
        $query = self::select();
        $query .= ' WHERE slug = ?';
        self::init();
        return self::$database->query($query, [$slug])->findOrFail();
    }

    /**
     * Get all records.
     *
     * @param array|null $fields The fields to select.
     * @return array|object|bool The found records.
     */
    public static function all(?array $fields = []): array|object|bool
    {
        self::init();
        return !empty($fields) ? self::$database->query(self::select($fields))->findAll()
            : self::$database->query(self::select())->findAll();
    }

    /**
     * Find a record by a specific key-value pair.
     *
     * @param string $key The key to search for.
     * @param string $value The value to match.
     * @param array|null $columns The columns to select.
     * @return object|null The found record, or null if not found.
     */
    public static function find(string $key, string $value, array $columns = null): ?object
    {
        self::init();
        $sql = $columns ? self::select(array_merge([$key], $columns)) : self::select([$key]);
        $sql .= " WHERE $key = ?";
        $result = self::$database->query($sql, [$value])->find();

        return $result ?: null;
    }

    /**
     * Select distinct records from the database.
     *
     * @param array|null $fields The fields to select. If null, select all fields.
     * @return array|object|bool The found records.
     */
    public static function distinct(?array $fields = null): array|object|bool
    {
        $table = static::getTableName();
        $fieldsStr = $fields ? implode(', ', $fields) : implode(', ', self::fields());
        $query = "SELECT DISTINCT $fieldsStr FROM $table";
        self::init();
        return self::$database->query($query)->findAll();
    }

    /**
     * Count the total number of records in the table.
     *
     * @return int The total number of records.
     */
    public static function count(): int
    {
        $table = static::getTableName();
        $query = "SELECT COUNT(*) AS count FROM $table";
        self::$lastQuery = $query;
        self::init();
        return (int)self::$database->query($query)->find();
    }

    /**
     * Get records from the database based on conditions and select specific fields.
     *
     * @param array|null $fields The fields to select.
     * @return array|object|bool The found records.
     */
    public function get(?array $fields = null): array|object|bool
    {
        $query = $this->buildQuery($fields);
        return $this->executeQuery($query, true);
    }

    /**
     * Get the first record matching the conditions.
     *
     * @param array|null $fields The fields to select.
     * @return array|object|bool The first matching record.
     */
    public function first(?array $fields = null): array|object|bool
    {
        $query = $this->buildQuery($fields);
        $query .= ' LIMIT 1';
        return $this->executeQuery($query, false);
    }

    /**
     * Get the last record matching the conditions.
     *
     * @param array|null $fields The fields to select.
     * @return array|object|bool The last matching record.
     */
    public function last(?array $fields = null): array|object|bool
    {
        $query = $this->buildQuery($fields);
        $query .= ' ORDER BY id DESC LIMIT 1';
        return $this->executeQuery($query, false);
    }

    /**
     * Build the query string based on provided fields and existing conditions.
     *
     * @param array|null $fields The fields to select.
     * @return string The built query string.
     */
    private function buildQuery(?array $fields = null): string
    {
        $query = $fields ? self::select($fields) : self::select();

        if (self::$whereClause) {
            $query .= ' WHERE ' . self::$whereClause;
        }

        if (self::$orderByClause) {
            $query .= ' ORDER BY ' . self::$orderByClause;
        }

        if (self::$limitClause) {
            $query .= ' LIMIT ' . self::$limitClause;
        }

        if (self::$offsetClause) {
            $query .= ' OFFSET ' . self::$offsetClause;
        }
        return $query;
    }

    /**
     * Execute the built query and return the result.
     *
     * @param string $query The query to execute.
     * @param bool $findAll Whether to find all records or just one.
     * @return array|object|bool The query result.
     */
    private function executeQuery(string $query, bool $findAll = true): array|object|bool
    {
        self::init();
        if (self::$whereParams) {
            $params = self::$whereParams;
            return $findAll
                ? self::$database->query($query, $params)->findAll()
                : self::$database->query($query, $params)->find();
        } else {
            return $findAll
                ? self::$database->query($query)->findAll()
                : self::$database->query($query)->find();
        }
    }

    /**
     * Add a where clause to the query.
     *
     * @param string $column The column name.
     * @param mixed $value The value to match.
     * @param string $operator The comparison operator.
     * @return static
     */
    public static function where(string $column, $value, string $operator = '='): static
    {
        $condition = "$column $operator :$column";
        self::$whereClause = self::$whereClause ? self::$whereClause . " AND $condition" : $condition;
        self::$whereParams[":$column"] = $value;
        return new static();
    }

    /**
     * Add orWhere clause to the query
     *
     * @param string $column The Column name.
     * @param mixed $value The value match.
     * @param string $operator The Comparison Operator
     * @return static
     */
    public function orWhere(string $column, $value, string $operator = '='): static
    {
        $condition = "$column $operator :$column";
        self::$whereClause = self::$whereClause ? self::$whereClause . "OR $condition" : $condition;
        self::$whereParams[":$column"] = $value;
        return new static();
    }

    /**
     * Add a join clause to the query
     *
     * @param string $first The first column name
     * @param string $second The second column name
     * @param string $type The join type
     * @return static
     */

    public function join(string $first, string $second, string $type = 'INNER'): static
    {
        $joinClause = "$type JOIN $first ON $second";
        self::$joinClause = self::$joinClause ? self::$joinClause . " $joinClause" : $joinClause;
        return new static();
    }

    /**
     * Add leftJoin clause to query
     *
     * @param string $table The name of the table
     * @param string $first The first Column Name
     * @param string $operator The Comparison Operator
     * @param string $second The Second Column Name
     * @return static
     */
    public function leftJoin(string $first, string $second): static
    {
        return $this->join($first, $second, 'LEFT');
    }

    /**
     * Execute a raw query
     *
     * @param string $sql The SQL statement to run
     * @param ?array $param The optional Param of the SQL statement
     * @return array
     */
    public static function raw(string $sql, ?array $param = null)
    {
        self::init();
        return self::$database->query($sql, $param)->findAll();
    }

    /**
     * Magic method to handle dynamic method calls.
     *
     * @param string $method The called method name.
     * @param array $args The arguments passed to the method.
     * @return mixed The result of the dynamic method call.
     * @throws InvalidArgumentException If the method is not supported.
     */
    public static function __callStatic(string $method, array $args): mixed
    {
        if (str_starts_with($method, 'findBy')) {
            $property = lcfirst(str_replace('findBy', '', $method));
            return self::find($property, ...$args);
        }

        if (str_starts_with($method, 'orderBy')) {
            $field = lcfirst(str_replace('orderBy', '', $method));
            self::$orderByClause = "$field $args[0]";
            return new static();
        }

        throw new InvalidArgumentException("Method $method not supported.");
    }
}
