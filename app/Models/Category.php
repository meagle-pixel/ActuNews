<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Category
{
    public static function all(): array
    {
        $stmt = Database::getConnection()->query('SELECT * FROM categories ORDER BY category_name');

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
