<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="./css/style.css?v=<?= time() ?>">
</head>

<body class="body-contact">

    <?php App\Core\View::render('partials/header'); ?>

    <main class="body-contact">
        <div class="container_contact">
            <form action="" method="POST" class="form-connexion">
                <h1>Connexion</h1>
                <input type="email" name="email" id="email" value="<?= htmlspecialchars($email) ?>" placeholder="Votre email">
                <input type="password" name="password" id="password" placeholder="Votre mot de passe">
                <div class="btn_p">
                    <input type="submit" value="Se connecter" id="button">
                    <p>
                        Pas encore inscrit ? <a href="inscription.php">Créer un compte</a>
                    </p>
                </div>

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

    <?php App\Core\View::render('partials/footer'); ?>



</body>

</html>
