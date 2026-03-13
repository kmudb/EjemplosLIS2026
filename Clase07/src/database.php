<?php
// src/Database.php
class Database
{
    private static ?PDO $pdo = null;

    public static function getConnection(): PDO
    {
        if (self::$pdo === null) {
            $config = require __DIR__ . '/../config/config.php';
            $db = $config['db'];
            self::$pdo = new PDO($db['dsn'], $db['user'], $db['pass'], $db['options']);
        }
        return self::$pdo;
    }

    // Helper para transacciones si necesitas
    public static function transaction(callable $fn)
    {
        $pdo = self::getConnection();
        try {
            $pdo->beginTransaction();
            $result = $fn($pdo);
            $pdo->commit();
            return $result;
        } catch (Throwable $e) {
            $pdo->rollBack();
            throw $e;
        }
    }
}