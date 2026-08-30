<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact</title>
  <link rel="stylesheet" href="./css/style.css?v=<?= time() ?>" />
</head>

<body class="body-contact">


  <?php App\Core\View::render('partials/header'); ?>


  <main class="main-contact">
    <div class="container_contact">
      <form action="" method="POST">
        <h1 class="h1-contact">Inscrivez-vous maintenant !</h1>
        <input type="text" name="lastName" id="lastName" value="<?= htmlspecialchars($nom) ?>" placeholder="Entrez votre nom" />
        <input type="text" name="firstName" id="firstName" value="<?= htmlspecialchars($prenom) ?>" placeholder="Entrez votre prénom" />
        <input type="email" name="email" id="email" value="<?= htmlspecialchars($email) ?>" placeholder="email" />
        <input type="text" name="mobile" id="mobile" value="<?= htmlspecialchars($mobile) ?>" placeholder="Téléphone" />
        <input type="password" name="password" id="password" placeholder="Choisissez votre mot de passe" />
        <input type="password" name="password2" id="password2" placeholder="Validez votre mot de passe">
        <h2>Ajoutez des informations (optionnel)</h2>
        <textarea id="textarea"></textarea>
        <input type="submit" value="Inscription" id="button" />
      </form>
    </div>

    <div id="form-message">
      <img id="form-icon" src="images/traverser.png" alt="logo erreur">
      <span id="formText"></span>
    </div>

  </main>


  <script src="js/index.js?v=<?= time() ?>"></script>

  <?php if (!empty($erreurs)): ?>
    <script>
      showErrorOrSuccess("<?= htmlspecialchars($erreurs[0]) ?>");
    </script>
  <?php endif; ?>

  <?php if ($succes): ?>
    <script>
      showErrorOrSuccess("Inscription réussie !", "success");
    </script>
  <?php endif; ?>

  <?php App\Core\View::render('partials/footer'); ?>


</body>

</html>
