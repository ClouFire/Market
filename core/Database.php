<?php

namespace PHPFramework;

class Database
{
    private static $instance = null;

    private $connection = null;

    private $statement;

    protected function __construct()
    {
        try{
            $this->connection = new \PDO(
                "mysql:host=" . DB_SETTINGS["host"] . ";dbname=" . DB_SETTINGS["name"] . ";charset=utf8",
                DB_SETTINGS["login"],
                DB_SETTINGS["pass"],
                DB_SETTINGS["options"],
                );
        }
        catch (\PDOException $e){
            error_log("[" . date("Y-m-d H:i:s") . "] DB connetion error: {$e->getMessage()}" . PHP_EOL, 3, ERROR_LOGS);
            abort('DB connection error', 500);
        }
        
    }

    protected function __clone(){        
    }
    public function __wakeup() 
    {
        throw new \BadMethodCallException('Unable to deserialize database connection');
    }

    public static function getInstance(): Database
    {
        if(null == self::$instance)
        {
            return self::$instance = new static();
        }
        return self::$instance;
    }

    public static function connection(): \PDO
    {
        return static::getInstance()->connection;
    }

    public static function prepare(string $statement): \PDOStatement
    {
        return static::connection()->prepare($statement);
    }

    public function execute(string $statement, array $params = []): Database
    {
        $this->statement = static::connection()->prepare($statement);
        $this->statement->execute($params);
        return $this;
    }

    public function get(): array|false
    {
        return $this->statement->fetchAll();
    }

    public function getStatement(): bool|\PDOStatement
    {
        return $this->statement;
    }

    public function getAssoc($key = 'id'): array
    {
        $data = [];
        while($row = $this->statement->fetch())
        {
            $data[$row[$key]] = $row;
        }
        return $data;
    }

    public function getOne()
    {
        return $this->statement->fetch();
    }

    public function getColumn()
    {
        return $this->statement->fetchColumn();
    }

    public function findAll($table): array|false
    {
        $this->execute("SELECT * FROM {$table}");
        return $this->statement->fetchAll();
    }

    public function findOne($table, $value, $key = 'id')
    {
        $this->execute("SELECT * FROM {$table} WHERE {$key} = ? LIMIT 1", [$value]);
        return $this->statement->fetch();
    }

    public function findOrFail($table, $value, $key = 'id')
    {
        $result = $this->findOne($table, $value, $key);
        if(!$result)
        {
            abort();
        }
        return $result;
    }

    public function getInsertId(): false|string
    {
        return $this->connection->lastInsertId();
    }

    public function rowCount(): int
    {
        return $this->statement->rowCount();
    }

    public function beginTransaction(): bool
    {
        return $this->connection->beginTransaction();
    }

    public function commit(): bool
    {
        return $this->connection->commit();
    }

    public function rollBack(): bool
    {
        return $this->connection->rollBack();
    }

    public function insertCache($key, $data, $created_at ,$expires_at)
    {
        $this->execute("INSERT INTO cache (`cache_key`,`data`,`created_at`,`expires_at`) VALUES (?, ?, ?, ?)", ["{$key}", "{$data}", "{$created_at}", "{$expires_at}"]);
    }

    public function deleteCache($key)
    {
        $this->execute("DELETE FROM cache WHERE `cache_key` = '{$key}'");
    }

    public function insert(string $table, array $keys = ['id',], array $values = ['null',]): bool|string
    {
        foreach($keys as $k => $v)
        {
            $keys[$k] = "`{$v}`";
        }
        $keys = join(',' ,$keys);
            
        foreach($values as $k => $v)
        {
            $values[$k] = "\"{$v}\"";
        }
        $values = join(', ', $values);

        $this->execute("INSERT INTO {$table} ({$keys}) VALUES ({$values})");
        return $this->getInsertId();
    }

    public function delete(string $table, string $value, string $key = 'id')
    {
       
        $key = "`{$key}`";


        $this->execute("DELETE FROM {$table} WHERE ({$key}) = ({$value})");
    }    

    public function countAll($table)
    {
        return $this->execute("SELECT count(*) FROM {$table}")->getColumn();
    }

    public function findRange($table, $limit, $offset)
    {
        $this->execute("SELECT * FROM {$table} LIMIT {$limit} OFFSET {$offset}");
        return $this->statement->fetchAll();
    }

    public function createCart($user_id)
    {
        db()->insert('cart', ['user_id'], [$user_id]);
    }

    public function insertCartItem($cart_id, $good_id, $amount, $user_id, $size)
    {
        if(db()->insert('cart_item', ['cart_id', 'good_id', 'quantity', 'size'], [$cart_id, $good_id, $amount, $size]))
        {
            db()->execute("UPDATE cart SET total = total + 1 WHERE user_id = ?", [$user_id]);
        }
        return db()->getInsertId();
    }

}