<header class="site-header">
  <div class="site-header__bar">
    <a href="<?= BASE_URL ?>/index.php" class="site-header__brand">
      <img src="<?= BASE_URL ?>/images/logo_actunews.png" alt="ActuNews" id="logo" />
    </a>

    <button type="button" class="burger-btn" id="burger-toggle" aria-label="Ouvrir le menu" aria-expanded="false" aria-controls="site-menu">
      <span></span>
      <span></span>
      <span></span>
    </button>

    <div class="site-header__menu" id="site-menu">
      <nav class="site-nav">
        <ul>
          <li><a href="<?= BASE_URL ?>/index.php">Accueil</a></li>
          <li><a href="<?= BASE_URL ?>/articles.php">Nos articles</a></li>
          <li><a href="<?= BASE_URL ?>/ssolaire.php">Planétarium</a></li>
          <li><a href="<?= BASE_URL ?>/inscription.php">Rejoignez-nous !</a></li>
        </ul>
      </nav>

      <div class="site-header__account">
        <?php if (isset($_SESSION['user_id'])): ?>
          <span class="account-greeting">Bonjour <?= htmlspecialchars($_SESSION['user_first_name']) ?></span>

          <?php if ($_SESSION['user_role'] === 'admin'): ?>
            <a href="<?= BASE_URL ?>/admin/articlesAdmin.php" class="btn-nav btn-admin">Admin</a>
            <a href="<?= BASE_URL ?>/admin/usersAdmin.php" class="btn-nav btn-roles">Rôles</a>
          <?php elseif ($_SESSION['user_role'] === 'autor'): ?>
            <a href="<?= BASE_URL ?>/admin/articlesAdmin.php" class="btn-nav btn-autor">Mes articles</a>
          <?php endif; ?>

          <a href="<?= BASE_URL ?>/deconnexion.php" class="btn-nav btn-deconnexion">Déconnexion</a>
        <?php else: ?>
          <a href="<?= BASE_URL ?>/connexion.php" class="btn-nav btn-connexion">Se connecter</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</header>
