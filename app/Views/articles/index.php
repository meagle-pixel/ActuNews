<!doctype html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Nos articles</title>
  <link rel="stylesheet" href="./css/style.css?v=<?= time() ?>" />
</head>

<body class="accueil">
  <?php App\Core\View::render('partials/header'); ?>

  <main class="main-articles">

    <div id="titre_filtre">
      <form method="GET" action="">
        <select name="categorie" id="filtre-articles" onchange="this.form.submit()">
          <option value="all">Toutes</option>
          <?php foreach ($categories as $cat): ?>
            <option value="<?= htmlspecialchars($cat['category_name']) ?>"
              <?= $filtre === $cat['category_name'] ? 'selected' : '' ?>>
              <?= htmlspecialchars($cat['category_name']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </form>
    </div>

    <div id="grille-articles" class="articles-grid">
      <?php if (empty($articles)): ?>
        <p style="color: white;">Aucun article pour le moment.</p>
      <?php else: ?>
        <?php foreach ($articles as $article): ?>
          <div class="card">
            <img src="<?= htmlspecialchars($article['article_image_path']) ?>"
              alt="<?= htmlspecialchars($article['article_title']) ?>">
            <div class="card-infos">
              <small><?= htmlspecialchars($article['categories'] ?? 'Non classé') ?></small>
              <h3><?= htmlspecialchars($article['article_title']) ?></h3>
              <p><?= htmlspecialchars($article['article_resume']) ?></p>
              <a href="details.php?id=<?= $article['article_id'] ?>" class="btn">Lire l'article</a>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>

  </main>


  <?php App\Core\View::render('partials/footer'); ?>

</body>

</html>
