<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($article['article_title']) ?></title>
    <link rel="stylesheet" href="css/style.css?v=<?= time() ?>">
</head>

<body class="accueil">
    <?php App\Core\View::render('partials/header'); ?>

    <main class="main-page">
        <section class="article">
            <img src="<?= htmlspecialchars($article['article_image_path']) ?>"
                alt="<?= htmlspecialchars($article['article_title']) ?>" id="<?= $article['article_id'] ?>">
            <article class="article-details">
                <div class="tittle_cat">
                    <h1 class="int"><?= htmlspecialchars($article['article_title']) ?></h1>
                </div>

                <p class="cat"><strong>Date : </strong><?= date('d/m/Y', strtotime($article['article_published_date'])) ?>
                    <strong>Auteur : </strong><?= htmlspecialchars($article['user_first_name'] . ' ' . $article['user_last_name']) ?>
                </p>
                <div class="article_content">
                    <p><?= nl2br(htmlspecialchars($article['article_content'])) ?></p>
                </div>

                <a href="articles.php" class="btn">Retour aux articles</a>
            </article>
        </section>
    </main>

    <?php App\Core\View::render('partials/footer'); ?>

</body>

</html>
