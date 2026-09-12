<?php

declare(strict_types=1);

namespace App\Database;

use PDO;
use PDOStatement;
use InvalidArgumentException;

class Database
{
    public function __construct(
        private readonly PDO $pdo
    ) {}

    public function getPdo(): PDO
    {
        return $this->pdo;
    }

    /**
     * Eksekusi query dengan prepared statement dan kembalikan seluruh baris (assoc).
     *
     * @param string $sql
     * @param array<string|int, mixed> $params
     * @return array<int, array<string, mixed>>
     */
    public function query(string $sql, array $params = []): array
    {
        $stmt = $this->execute($sql, $params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Eksekusi query dan kembalikan 1 baris pertama (assoc) atau null jika tidak ditemukan.
     *
     * @param string $sql
     * @param array<string|int, mixed> $params
     * @return array<string, mixed>|null
     */
    public function queryOne(string $sql, array $params = []): ?array
    {
        $stmt = $this->execute($sql, $params);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result !== false ? $result : null;
    }

    /**
     * Eksekusi INSERT/UPDATE/DELETE statement dengan parameter terikat.
     *
     * @param string $sql
     * @param array<string|int, mixed> $params
     * @return int Jumlah baris yang terpengaruh (affected rows)
     */
    public function executeStatement(string $sql, array $params = []): int
    {
        $stmt = $this->execute($sql, $params);
        return $stmt->rowCount();
    }

    /**
     * Mendapatkan ID terakhir yang di-insert.
     */
    public function getLastInsertId(): int
    {
        return (int)$this->pdo->lastInsertId();
    }

    private function execute(string $sql, array $params = []): PDOStatement
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
}
