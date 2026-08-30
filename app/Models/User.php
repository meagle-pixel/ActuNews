<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class User
{
    public const ROLES = ['admin', 'autor', 'user'];

    public static function findByEmail(string $email): ?array
    {
        $stmt = Database::getConnection()->prepare('SELECT * FROM users WHERE user_email = :email');
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user ?: null;
    }

    public static function create(string $nom, string $prenom, string $email, string $mobile, string $passwordHash): void
    {
        $stmt = Database::getConnection()->prepare(
            "INSERT INTO users (user_last_name, user_first_name, user_email, user_mobile, user_password)
             VALUES (:nom, :prenom, :email, :mobile, :password)"
        );
        $stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':email' => $email,
            ':mobile' => $mobile,
            ':password' => $passwordHash,
        ]);
    }

    public static function all(): array
    {
        $stmt = Database::getConnection()->query(
            "SELECT user_id, user_first_name, user_last_name, user_email, user_role
             FROM users ORDER BY user_id ASC"
        );

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function updateRole(int $userId, string $role): void
    {
        $stmt = Database::getConnection()->prepare('UPDATE users SET user_role = :role WHERE user_id = :user_id');
        $stmt->execute([':role' => $role, ':user_id' => $userId]);
    }

    public static function isValidRole(string $role): bool
    {
        return in_array($role, self::ROLES, true);
    }
}
