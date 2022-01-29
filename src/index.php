<?php

use App\classes\App;

require '../vendor/autoload.php';

$pdo = App::getPDO()->query('SELECT * FROM users')->fetchAll();
$user = App::getAuth()->user();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scal=1.0">
    <title>Site e-commerce complet</title>
    <script src="https://kit.fontawesome.com/5a810986e2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body class="p-4">
    <h1> Accèder aux pages</h1>
    <?php if (isset($_GET['login'])) : ?>
        <div class="alert-success">
            Vous êtes bien identifié.
        </div>
    <?php endif ?>

    <?php if ($user === null) : ?>

        <p>
            Vous êtes connecté en tant que
            <a href="logout.php">se déconnecter</a>
        </p>
    <?php endif ?>
    <ul>
        <li><a href="admin.php">Page reservée à l'administrateur</a></li>
        <li><a href="user.php">Page reservée à l'utilisateur</a></li>
    </ul>
    <table class="table tanle-striped>
        <thead>
            <tr>
                <th>ID</th>
                <th>Pseudo</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) : ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= $user['pseudo'] ?></td>
                <td><?= $user['role'] ?></td>
            </tr>
            <?php endforeach ?>
        </tbody>
</body>
</html>