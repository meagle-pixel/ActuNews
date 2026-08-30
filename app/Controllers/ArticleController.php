<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\Article;
use App\Models\Category;

class ArticleController
{
    public function index(): void
    {
        $filtre = $_GET['categorie'] ?? 'all';

        $articles = $filtre === 'all'
            ? Article::publishedAll()
            : Article::publishedByCategory($filtre);

        $categories = Category::all();

        View::render('articles/index', [
            'filtre' => $filtre,
            'articles' => $articles,
            'categories' => $categories,
        ]);
    }

    public function show(): void
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            header('Location: ' . BASE_URL . '/articles.php');
            exit;
        }

        $article = Article::findWithAuthor((int) $id);

        if (!$article) {
            header('Location: ' . BASE_URL . '/articles.php');
            exit;
        }

        View::render('articles/details', ['article' => $article]);
    }
}
