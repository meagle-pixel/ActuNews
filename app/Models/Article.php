<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Article
{
    /**
     * Articles publiés, tous, avec leurs catégories concaténées (page "Nos articles", filtre "Toutes").
     */
    public static function publishedAll(): array
    {
        $stmt = Database::getConnection()->query("
            SELECT a.*,
            GROUP_CONCAT(c.category_name SEPARATOR ', ') AS categories
            FROM articles a
            LEFT JOIN article_categories ac ON a.article_id = ac.article_id
            LEFT JOIN categories c ON ac.category_id = c.category_id
            WHERE a.article_status = 'published'
            GROUP BY a.article_id
            ORDER BY a.article_published_date DESC
        ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Articles publiés filtrés par nom de catégorie (page "Nos articles", filtre spécifique).
     */
    public static function publishedByCategory(string $categorie): array
    {
        $stmt = Database::getConnection()->prepare("
            SELECT a.*, c.category_name AS categories
            FROM articles a
            LEFT JOIN article_categories ac ON a.article_id = ac.article_id
            LEFT JOIN categories c ON ac.category_id = c.category_id
            WHERE a.article_status = 'published' AND c.category_name = :categorie
            ORDER BY a.article_published_date DESC
        ");
        $stmt->execute([':categorie' => $categorie]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Un article + son auteur (page détail).
     */
    public static function findWithAuthor(int $id): ?array
    {
        $stmt = Database::getConnection()->prepare(
            'SELECT * FROM articles a JOIN users u ON a.article_user_id = u.user_id WHERE a.article_id = :id'
        );
        $stmt->execute([':id' => $id]);
        $article = $stmt->fetch(PDO::FETCH_ASSOC);

        return $article ?: null;
    }

    /**
     * Un article seul, sans jointure (formulaire d'édition).
     */
    public static function find(int $id): ?array
    {
        $stmt = Database::getConnection()->prepare('SELECT * FROM articles WHERE article_id = :id');
        $stmt->execute([':id' => $id]);
        $article = $stmt->fetch(PDO::FETCH_ASSOC);

        return $article ?: null;
    }

    /**
     * Tous les articles avec auteur + catégories, pour le back-office.
     */
    public static function allWithAuthor(): array
    {
        $stmt = Database::getConnection()->query("
            SELECT a.*, u.user_first_name, u.user_last_name,
            GROUP_CONCAT(c.category_name SEPARATOR ', ') AS categories
            FROM articles a
            JOIN users u ON a.article_user_id = u.user_id
            LEFT JOIN article_categories ac ON a.article_id = ac.article_id
            LEFT JOIN categories c ON ac.category_id = c.category_id
            GROUP BY a.article_id
            ORDER BY a.article_created_at DESC
        ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create(array $data): int
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("
            INSERT INTO articles (article_title, article_resume, article_content, article_image_path, article_status, article_published_date, article_user_id)
            VALUES (:title, :resume, :content, :image, :status, :date, :user_id)
        ");
        $stmt->execute([
            ':title' => $data['title'],
            ':resume' => $data['resume'],
            ':content' => $data['content'],
            ':image' => $data['image'],
            ':status' => $data['status'],
            ':date' => $data['date'],
            ':user_id' => $data['user_id'],
        ]);

        return (int) $pdo->lastInsertId();
    }

    public static function update(int $id, array $data): void
    {
        $stmt = Database::getConnection()->prepare(
            "UPDATE articles SET article_title = :title, article_resume = :resume, article_content = :content,
             article_image_path = :image, article_status = :status, article_published_date = :date
             WHERE article_id = :id"
        );
        $stmt->execute([
            ':title' => $data['title'],
            ':resume' => $data['resume'],
            ':content' => $data['content'],
            ':image' => $data['image'],
            ':status' => $data['status'],
            ':date' => $data['date'],
            ':id' => $id,
        ]);
    }

    public static function delete(int $id): void
    {
        $stmt = Database::getConnection()->prepare('DELETE FROM articles WHERE article_id = :id');
        $stmt->execute([':id' => $id]);
    }

    /**
     * @return int[] Les id de catégories liées à cet article.
     */
    public static function categoryIdsFor(int $id): array
    {
        $stmt = Database::getConnection()->prepare('SELECT category_id FROM article_categories WHERE article_id = :id');
        $stmt->execute([':id' => $id]);

        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    /**
     * Remplace les catégories d'un article par la nouvelle sélection
     * (utilisé à la fois pour la création et pour la modification).
     *
     * @param int[]|string[] $categoryIds
     */
    public static function syncCategories(int $articleId, array $categoryIds): void
    {
        $pdo = Database::getConnection();

        $stmt = $pdo->prepare('DELETE FROM article_categories WHERE article_id = :id');
        $stmt->execute([':id' => $articleId]);

        if (empty($categoryIds)) {
            return;
        }

        $stmt = $pdo->prepare('INSERT INTO article_categories (article_id, category_id) VALUES (:article_id, :category_id)');
        foreach ($categoryIds as $categoryId) {
            $stmt->execute([
                ':article_id' => $articleId,
                ':category_id' => (int) $categoryId,
            ]);
        }
    }
}
