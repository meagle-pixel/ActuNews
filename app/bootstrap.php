<?php

// --- Session ---
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// --- Chemins de base ---
define('ROOT_PATH', dirname(__DIR__));      // dossier racine du projet (contient app/, vendor/, .env...)
define('APP_PATH', __DIR__);                // dossier app/
define('PUBLIC_PATH', ROOT_PATH . '/public'); // racine web (index.php, css/, js/, images/...)

// --- Autoload "maison" pour le namespace App\ (pas besoin de composer dump-autoload) ---
spl_autoload_register(function (string $class) {
    $prefix = 'App\\';
    if (strncmp($prefix, $class, strlen($prefix)) !== 0) {
        return;
    }
    $relative = substr($class, strlen($prefix));
    $path = APP_PATH . '/' . str_replace('\\', '/', $relative) . '.php';
    if (is_file($path)) {
        require $path;
    }
});

// --- Composer (uniquement pour vlucas/phpdotenv) ---
require_once ROOT_PATH . '/vendor/autoload.php';

// Charge les variables d'environnement depuis .env en local.

$dotenv = Dotenv\Dotenv::createImmutable(ROOT_PATH);
$dotenv->safeLoad();

// --- Détection automatique de l'environnement (local vs production) ---
if ($_SERVER['HTTP_HOST'] === 'localhost') {
    define('BASE_URL', '/ActuNews');
} else {
    define('BASE_URL', '');
}
