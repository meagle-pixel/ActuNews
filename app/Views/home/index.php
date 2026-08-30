<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ActuNews - Accueil</title>
  <link rel="stylesheet" href="./css/style.css?v=<?= time() ?>">
</head>

<body class="accueil">
  <?php App\Core\View::render('partials/header'); ?>

  <main class="main-accueil">

    <!-- Titre et barre de recherche -->
    <section class="tittle_search">
      <div class="tittle">
        <h1>À la UNE aujourd'hui</h1>
        <p class="tittle_subtitle">Actualités, découvertes et exploration du système solaire</p>
      </div>
      <div class="search">
        <input type="search" name="q" id="site-search" placeholder="Rechercher un article...">
        <button><img src="./images/search.jpg" alt="logo search"></button>
      </div>
    </section>

    <!-- Planètes telluriques -->
    <section class="container">
      <div class="h2">
        <h2>Les planètes telluriques</h2>
      </div>
      <div class="articles-grid articles-grid--accueil">
        <div class="card">
          <img src="./images/earth.jpg" alt="La Terre">
          <div class="card-infos">
            <small>Planètes</small>
            <h3>La Terre</h3>
            <p>La Terre est une planète tellurique, la seule connue à ce jour à abriter la vie.</p>
            <a href="./page.php" class="btn">En savoir plus</a>
          </div>
        </div>

        <div class="card">
          <img src="./images/mars.jpg" alt="Mars">
          <div class="card-infos">
            <small>Planètes</small>
            <h3>Mars</h3>
            <p>Mars est une planète tellurique surnommée la « planète rouge ».</p>
            <a href="https://fr.wikipedia.org/wiki/Mars_(plan%C3%A8te)" class="btn">En savoir plus</a>
          </div>
        </div>
      </div>
    </section>

    <!-- Satellites -->
    <section class="container">
      <div class="h2">
        <h2>Les satellites</h2>
      </div>
      <div class="articles-grid articles-grid--accueil">
        <div class="card">
          <img src="./images/mooon.jpg" alt="La Lune">
          <div class="card-infos">
            <small>Satellites</small>
            <h3>Lune</h3>
            <p>La Lune est l'unique satellite naturel de la Terre.</p>
            <a href="https://fr.wikipedia.org/wiki/Lune" class="btn">En savoir plus</a>
          </div>
        </div>

        <div class="card">
          <img src="./images/europe.jpg" alt="Europe">
          <div class="card-infos">
            <small>Satellites</small>
            <h3>Europe</h3>
            <p>Europe est l'un des principaux satellites naturels de Jupiter.</p>
            <a href="https://fr.wikipedia.org/wiki/Europe_(lune)" class="btn">En savoir plus</a>
          </div>
        </div>
      </div>
    </section>

    <!-- Localisation -->
    <section class="container">
      <div class="h2">
        <h2>Où nous trouver ?</h2>
      </div>
      <div class="embed-google-map">
        <iframe
          title="Carte Google Maps de Fuveau"
          style="width:100%; height:400px; border:0;"
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
          src="https://maps.google.com/maps?q=13710+Fuveau,+France&t=&z=15&ie=UTF8&iwloc=&output=embed"></iframe>
      </div>
    </section>

  </main>

  <?php App\Core\View::render('partials/footer'); ?>

  <script src="./js/index.js?v=<?= time() ?>"></script>

</body>

</html>
