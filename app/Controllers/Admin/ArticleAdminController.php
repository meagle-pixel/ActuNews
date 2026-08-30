<?php

namespace App\Controllers\Admin;

use App\Core\Auth;
use App\Core\ImageUploader;
use App\Core\View;
use App\Models\Article;
use App\Models\Category;
use PDOException;

class ArticleAdminController
{
    public function index(): void
    {
        Auth::requireRole(['admin', 'autor']);

        $articles = Article::allWithAuthor();

        View::render('admin/articles/index', ['articles' => $articles]);
    }

    public function create(): void
    {
        Auth::requireRole(['admin', 'autor']);

        $erreurs = [];
        $categories = Category::all();
        $selected_categories = [];
        $title = $resume = $content = '';
        $date = date('Y-m-d');
        $statut = 'draft';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title'] ?? '');
            $resume = trim($_POST['resume'] ?? '');
            $content = trim($_POST['content'] ?? '');
            $date = $_POST['date'] ?? date('Y-m-d');
            $statut = $_POST['statut'] ?? 'draft';
            $selected_categories = $_POST['categories'] ?? [];

            if (empty($title)) {
                $erreurs[] = "Veuillez entrer un titre";
            }

            if (empty($resume)) {
                $erreurs[] = "Veuillez entrer un résumé";
            }

            if (empty($content)) {
                $erreurs[] = "Veuillez entrer du contenu pour l'article";
            }

            $upload = ImageUploader::handle($_FILES['image'] ?? [], required: true);
            if ($upload['error']) {
                $erreurs[] = $upload['error'];
            }
            $image_path = $upload['path'];

            if (empty($erreurs)) {
                try {
                    $pdo = \App\Core\Database::getConnection();
                    $pdo->beginTransaction();

                    $articleId = Article::create([
                        'title' => $title,
                        'resume' => $resume,
                        'content' => $content,
                        'image' => $image_path,
                        'status' => $statut,
                        'date' => $date,
                        'user_id' => $_SESSION['user_id'],
                    ]);

                    Article::syncCategories($articleId, $selected_categories);

                    $pdo->commit();

                    $_SESSION['success'] = 'created';
                    header('Location: articlesAdmin.php');
                    exit;
                } catch (PDOException $e) {
                    $pdo->rollBack();
                    $erreurs[] = "Erreur : " . $e->getMessage();
                }
            }
        }

        View::render('admin/articles/create', [
            'erreurs' => $erreurs,
            'categories' => $categories,
            'selected_categories' => $selected_categories,
            'title' => $title,
            'resume' => $resume,
            'content' => $content,
            'date' => $date,
            'statut' => $statut,
        ]);
    }

    public function edit(): void
    {
        Auth::requireRole(['admin', 'autor']);

        $id = $_GET['id'] ?? null;
        $erreurs = [];

        if (!$id) {
            header('Location: articlesAdmin.php');
            exit;
        }

        try {
            $article = Article::find((int) $id);

            if (!$article) {
                header('Location: articlesAdmin.php');
                exit;
            }

            if ($_SESSION['user_role'] !== 'admin' && $article['article_user_id'] !== $_SESSION['user_id']) {
                header('Location: articlesAdmin.php');
                exit;
            }

            $categories = Category::all();
            $article_categories = Article::categoryIdsFor((int) $id);

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $title = trim($_POST['title'] ?? '');
                $resume = trim($_POST['resume'] ?? '');
                $content = trim($_POST['content'] ?? '');
                $date = $_POST['date'] ?? date('Y-m-d');
                $statut = $_POST['statut'] ?? 'draft';
                $selected_categories = $_POST['categories'] ?? [];

                if (empty($title)) {
                    $erreurs[] = "Veuillez entrer un titre";
                }

                if (empty($resume)) {
                    $erreurs[] = "Veuillez entrer un résumé";
                }

                if (empty($content)) {
                    $erreurs[] = "Veuillez entrer du contenu";
                }

                $upload = ImageUploader::handle(
                    $_FILES['image'] ?? [],
                    required: false,
                    existingPath: $article['article_image_path']
                );
                if ($upload['error']) {
                    $erreurs[] = $upload['error'];
                }
                $image_path = $upload['path'];

                if (empty($erreurs)) {
                    Article::update((int) $id, [
                        'title' => $title,
                        'resume' => $resume,
                        'content' => $content,
                        'image' => $image_path,
                        'status' => $statut,
                        'date' => $date,
                    ]);

                    Article::syncCategories((int) $id, $selected_categories);

                    $_SESSION['success'] = 'updated';
                    header('Location: articlesAdmin.php');
                    exit;
                }

                // On garde en mémoire les valeurs saisies + la sélection de catégories
                // pour les réafficher dans le formulaire en cas d'erreur.
                $article['article_title'] = $title;
                $article['article_resume'] = $resume;
                $article['article_content'] = $content;
                $article['article_published_date'] = $date;
                $article['article_status'] = $statut;
                $article_categories = $selected_categories;
            }
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return;
        }

        View::render('admin/articles/edit', [
            'erreurs' => $erreurs,
            'article' => $article,
            'categories' => $categories,
            'article_categories' => $article_categories,
        ]);
    }

    public function destroy(): void
    {
        Auth::requireRole(['admin']);

        $id = $_GET['id'] ?? null;

        if (!$id) {
            header('Location: articlesAdmin.php');
            exit;
        }

        try {
            $article = Article::find((int) $id);

            if (!$article) {
                header('Location: articlesAdmin.php');
                exit;
            }

            Article::delete((int) $id);

            $_SESSION['success'] = 'deleted';
            header('Location: articlesAdmin.php');
            exit;
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
}
