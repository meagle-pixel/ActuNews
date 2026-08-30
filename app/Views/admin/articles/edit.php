<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css?v=<?= time() ?>">
</head>

<body class="accueil">

    <?php App\Core\View::render('partials/header'); ?>

    <main class="main-admin">
        <div class="admin_container">

            <h1 style="color: yellow;">Modifier un article</h1>

            <?php if (!empty($erreurs)): ?>
                <ul style="color: red;">
                    <?php foreach ($erreurs as $erreur): ?>
                        <li><?= htmlspecialchars($erreur) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <form action="" method="POST" enctype="multipart/form-data" id="create_article">

                <label>Titre :</label>
                <input type="text" name="title" value="<?= htmlspecialchars($article['article_title']) ?>">

                <label>Résumé :</label>
                <textarea name="resume"><?= htmlspecialchars($article['article_resume']) ?></textarea>

                <label>Contenu :</label>
                <textarea name="content"><?= htmlspecialchars($article['article_content']) ?></textarea>

                <label>Image actuelle :</label>
                <img src="../<?= htmlspecialchars($article['article_image_path']) ?>" width="200">

                <label>Nouvelle image (optionnel) :</label>
                <input type="file" name="image">

                <label>Date :</label>
                <input type="date" name="date" value="<?= htmlspecialchars($article['article_published_date']) ?>">

                <label>Statut :</label>
                <select name="statut">
                    <option value="draft" <?= $article['article_status'] === 'draft' ? 'selected' : '' ?>>Brouillon</option>
                    <option value="published" <?= $article['article_status'] === 'published' ? 'selected' : '' ?>>Publié</option>
                </select>

                <label>Catégories :</label>
                <div>
                    <?php foreach ($categories as $cat): ?>
                        <label>
                            <input type="checkbox" name="categories[]" value="<?= $cat['category_id'] ?>"
                                <?= in_array($cat['category_id'], $article_categories) ? 'checked' : '' ?>>
                            <?= htmlspecialchars($cat['category_name']) ?>
                        </label>
                    <?php endforeach; ?>
                </div>

                <button type="submit" id="btn_create">Modifier l'article</button>
            </form>


        </div>


    </main>

     <script src="../js/index.js?v=<?= time() ?>"></script>

    <?php App\Core\View::render('partials/footer'); ?>


</body>

</html>
