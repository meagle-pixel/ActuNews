<?php

namespace App\Core;

use PDO;
use PDOException;

/**
 * Connexion PDO unique (Singleton), créée seulement au premier besoin.
 */
class Database
{
    private static ?PDO $connection = null;

    public static function getConnection(): PDO
    {
        if (self::$connection === null) {
            try {
                self::$connection = new PDO(
                    "mysql:host={$_ENV['AD_HOST']};dbname={$_ENV['AD_NAME']};charset=utf8mb4",
                    $_ENV['AD_USER'],
                    $_ENV['AD_PASS']
                );
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erreur de connexion : " . $e->getMessage());
            }
        }

        return self::$connection;
    }
}
