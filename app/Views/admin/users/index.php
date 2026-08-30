<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des rôles</title>
    <link rel="stylesheet" href="../css/style.css?v=<?= time() ?>">
</head>

<body class="accueil">
    <?php App\Core\View::render('partials/header'); ?>

    <main class="main-admin">
        <div class="panel-admin">
            <h1 style="color: white;">Gestion des rôles</h1>


            <table class="panel-role">
                <thead>
                    <tr style="color: yellow;">
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Rôle</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($roles as $role): ?>
                        <tr style="color: white;">
                            <td><?= $role['user_id'] ?></td>
                            <td><?= htmlspecialchars($role['user_last_name']) ?></td>
                            <td><?= htmlspecialchars($role['user_first_name']) ?></td>
                            <td>
                                <form action="" method="POST">
                                    <input type="hidden" name="user_id" value="<?= $role['user_id'] ?>">
                                    <label for="roles">Rôle </label>
                                    <select name="roles" id="roles">
                                        <option value="admin" <?= $role['user_role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                                        <option value="autor" <?= $role['user_role'] === 'autor' ? 'selected' : '' ?>>Auteur</option>
                                        <option value="user" <?= $role['user_role'] === 'user' ? 'selected' : '' ?>>Utilisateur</option>
                                    </select>
                            </td>
                            <td>
                                <button type="submit">Modifier</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

    <?php App\Core\View::render('partials/footer'); ?>

</body>

</html>
