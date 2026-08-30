<?php

namespace App\Core;

/**
 * Centralise la validation + le déplacement des images uploadées,
 * utilisé par la création ET la modification d'article (avant, le même
 * code était dupliqué dans les deux fichiers).
 */
class ImageUploader
{
    private const ALLOWED_TYPES = ['image/jpeg', 'image/png', 'image/webp'];
    private const UPLOAD_DIR = '/images/articles/'; // relatif à PUBLIC_PATH

    /**
     * @param array $file Un élément de $_FILES (ex: $_FILES['image'])
     * @param bool $required Si true, l'absence de fichier est une erreur
     * @param string|null $existingPath Chemin déjà en base (utile en édition si pas de nouveau fichier)
     * @return array{path: ?string, error: ?string}
     */
    public static function handle(array $file, bool $required, ?string $existingPath = null): array
    {
        if (!isset($file['error']) || $file['error'] === UPLOAD_ERR_NO_FILE) {
            if ($required) {
                return ['path' => null, 'error' => 'Une image est requise'];
            }
            return ['path' => $existingPath, 'error' => null];
        }

        if ($file['error'] !== UPLOAD_ERR_OK) {
            return ['path' => null, 'error' => "Erreur lors de l'upload de l'image"];
        }

        if (!in_array($file['type'], self::ALLOWED_TYPES, true)) {
            return ['path' => null, 'error' => "Format d'image non autorisé (JPG, PNG, WEBP uniquement)"];
        }

        $destinationDir = PUBLIC_PATH . self::UPLOAD_DIR;
        if (!is_dir($destinationDir)) {
            mkdir($destinationDir, 0755, true);
        }

        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = uniqid('article_') . '.' . $extension;
        $destination = $destinationDir . $filename;

        if (!move_uploaded_file($file['tmp_name'], $destination)) {
            return ['path' => null, 'error' => "Erreur lors de l'upload de l'image"];
        }

        // Chemin tel qu'utilisé côté HTML (relatif à la racine du site), inchangé par rapport à l'ancien code
        return ['path' => 'images/articles/' . $filename, 'error' => null];
    }
}
