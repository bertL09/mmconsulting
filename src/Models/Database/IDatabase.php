<?php

namespace Models\Database;

use PDOStatement;

interface IDatabase
{
    public function connect(): void;
    public function query(string $query): PDOStatement;
    public function fetchAll(string $query): array;
    public function fetchOne(string $query): ?array;
    public function execute(string $query): int;
    public function closeConnection(): void;
    public function escapeString(string $value):string;
}
