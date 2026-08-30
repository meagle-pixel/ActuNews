<?php

namespace App\Core;

/**
 * Rendu très simple d'une vue PHP.
 * Chaque vue garde sa structure HTML complète (elle inclut elle-même
 * les partials header/footer), on ne fait ici qu'extraire les données
 * et inclure le bon fichier.
 */
class View
{
    public static function render(string $view, array $data = []): void
    {
        extract($data);
        $path = APP_PATH . '/Views/' . $view . '.php';
        require $path;
    }
}
