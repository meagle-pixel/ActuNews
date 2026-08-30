<?php

namespace App\Core;

/**
 * Regroupe tout ce qui touche à l'authentification / aux autorisations.
 * Remplace l'ancien admin/auth-check.php (qui devinait la page via le nom
 * de fichier) par des appels explicites dans chaque contrôleur.
 */
class Auth
{
    public static function check(): bool
    {
        return isset($_SESSION['user_id']);
    }

    public static function user(): ?array
    {
        if (!self::check()) {
            return null;
        }

        return [
            'id' => $_SESSION['user_id'],
            'email' => $_SESSION['user_email'],
            'first_name' => $_SESSION['user_first_name'],
            'role' => $_SESSION['user_role'],
        ];
    }

    public static function login(array $user): void
    {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_email'] = $user['user_email'];
        $_SESSION['user_first_name'] = $user['user_first_name'];
        $_SESSION['user_role'] = $user['user_role'];
    }

    public static function logout(): void
    {
        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }

        session_destroy();
    }

    public static function requireLogin(string $redirectTo = '/connexion.php'): void
    {
        if (!self::check()) {
            header('Location: ' . BASE_URL . $redirectTo);
            exit;
        }
    }

    /**
     * @param string[] $roles Rôles autorisés, ex: ['admin', 'autor']
     */
    public static function requireRole(array $roles, string $redirectTo = '/index.php'): void
    {
        self::requireLogin();

        if (!in_array($_SESSION['user_role'], $roles, true)) {
            header('Location: ' . BASE_URL . $redirectTo);
            exit;
        }
    }
}
