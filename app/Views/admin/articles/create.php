<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire create article</title>
    <link rel="stylesheet" href="../css/style.css?v=<?= time() ?>">
</head>

<body class="accueil">
    <?php App\Core\View::render('partials/header'); ?>


    <main class="main-admin">
        <div class="admin_container">
            <h1 style="color: yellow;">Créer un article</h1>
            <?php if (!empty($erreurs)): ?>
                <ul style="color: red;">
                    <?php foreach ($erreurs as $erreur): ?>
                        <li><?= htmlspecialchars($erreur) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <form action="" method="POST" enctype="multipart/form-data" id="create_article">

                <label>Titre :</label>
                <input type="text" name="title" value="<?= htmlspecialchars($title ?? '') ?>">

                <label>Résumé :</label>
                <textarea name="resume"><?= htmlspecialchars($resume ?? '') ?></textarea>

                <label>Contenu :</label>
                <textarea name="content"><?= htmlspecialchars($content ?? '') ?></textarea>

                <label>Image :</label>
                <input type="file" name="image">

                <label>Date :</label>
                <input type="date" name="date" value="<?= htmlspecialchars($date ?? date('Y-m-d')) ?>">

                <label>Statut :</label>
                <select name="statut">
                    <option value="draft" <?= ($statut ?? '') === 'draft' ? 'selected' : '' ?>>Brouillon</option>
                    <option value="published" <?= ($statut ?? '') === 'published' ? 'selected' : '' ?>>Publié</option>
                </select>

                <label>Catégories :</label>
                <div>
                    <?php foreach ($categories as $cat): ?>
                        <label>
                            <input type="checkbox" name="categories[]" value="<?= $cat['category_id'] ?>"
                                <?= in_array($cat['category_id'], $selected_categories ?? []) ? 'checked' : '' ?>>
                            <?= htmlspecialchars($cat['category_name']) ?>
                        </label>
                    <?php endforeach; ?>
                </div>

                <button type="submit" id="btn_create">Créer l'article</button>
            </form>
        </div>

    </main>

    <script src="../js/index.js?v=<?= time() ?>"></script>

    <?php App\Core\View::render('partials/footer'); ?>

</body>

</html>
