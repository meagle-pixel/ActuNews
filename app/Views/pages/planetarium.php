<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Notre système solaire</title>
  <meta name="description" content="lorem" />
  <link rel="stylesheet" href="./css/style.css?v=<?= time() ?>" />
</head>

<body class="body-solaire">
  <canvas id="starfield"></canvas>

  <?php App\Core\View::render('partials/header'); ?>

  <main id="main-solaire">
    <div class="planetarium-hero">
      <div id="titre_filtre">
        <h1 id="h1_solaire">Planètes du système solaire</h1>
        <select id="filtre-planetes">
          <option value="all">Toutes</option>
          <option value="tellurique">Telluriques</option>
          <option value="gazeuse">Gazeuses</option>
          <option value="glace">Géantes de glace</option>
          <option value="lunes">Avec lunes</option>
        </select>
      </div>
    </div>

    <div class="planetes-track-wrap">
      <button type="button" class="scroll-arrow scroll-arrow--left" id="scroll-left" aria-label="Défiler vers la gauche">&#8249;</button>
      <div id="planetes-system"></div>
      <button type="button" class="scroll-arrow scroll-arrow--right" id="scroll-right" aria-label="Défiler vers la droite">&#8250;</button>
    </div>

    <section class="solar-scale" aria-label="Échelle des distances au Soleil">
      <h2>Distances au Soleil</h2>
      <div class="solar-scale-track" id="solar-scale-track">
        <div class="solar-scale-sun" title="Le Soleil">&#9737;</div>
        <div class="solar-scale-line"></div>
      </div>
    </section>

    <section class="fun-facts" aria-label="Le saviez-vous ?">
      <h2>Le saviez-vous ?</h2>
      <div class="fun-facts-grid" id="fun-facts-grid"></div>
    </section>

    <div id="info-planete"></div>
  </main>

  <script src="./js/starfield.js?v=<?= time() ?>"></script>
  <script src="./js/index.js?v=<?= time() ?>"></script>

</body>

</html>
