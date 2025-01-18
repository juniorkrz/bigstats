<?php

namespace App\util;

use PDO;
use PDOException;

require_once "../config.php";

class Database
{
    private static ?PDO $pdo = null;

    private function __construct() {}

    /**
     * Cria a conexão com o banco de dados.
     */
    private static function connect(): void
    {
        try {
            $dsn = sprintf('mysql:host=%s;dbname=%s', $_ENV['DB_HOST'], $_ENV['DB_NAME']);
            self::$pdo = new PDO($dsn, $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new PDOException('Erro de conexão com o banco de dados: ' . $e->getMessage(), (int)$e->getCode());
        }
    }

    /**
     * Retorna a conexão com o banco de dados.
     *
     * @return PDO
     * @throws PDOException
     */
    public static function getConnection(): PDO
    {
        if (is_null(self::$pdo)) {
            self::connect();
        }

        return self::$pdo;
    }
}
