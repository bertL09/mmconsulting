<?php
namespace Models\Database;

use PDO;
use PDOException;
use PDOStatement;

class MySQLDatabase implements IDatabase
{
    private string $host = 'localhost';
    private string $db_name = 'invoice_reports';
    private string $username = 'root';
    private string $password = '';
    private ?PDO $conn = null;

    public function __construct()
    {
        $this->connect();
    }

    public function connect(): void
    {
        try {
            $dsn = "mysql:host=$this->host;dbname=$this->db_name;charset=utf8";
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function escapeString(string $value): string
    {
        return $this->conn->quote($value);
    }

    public function query(string $query): PDOStatement
    {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            echo "Query failed: " . $e->getMessage();
            return new PDOStatement();
        }
    }

    public function fetchAll(string $query, array $params = []): array
    {
        try {
            $stmt = $this->conn->prepare($query);
            foreach ($params as $key => $value) {
                $stmt->bindValue($key, $value);
            }
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Fetch failed: " . $e->getMessage();
            return [];
        }
    }

    public function fetchOne(string $query): ?array
    {
        try {
            $stmt = $this->query($query);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Fetch failed: " . $e->getMessage();
            return null;
        }
    }

    public function execute(string $query): int
    {
        try {
            $stmt = $this->query($query);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            echo "Execution failed: " . $e->getMessage();
            return 0;
        }
    }

    public function closeConnection(): void
    {
        $this->conn = null;
    }
}
