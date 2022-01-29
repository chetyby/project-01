<?php

namespace App;

use App\classes\Auth;
use App\classes\App;
use PDO;

require '../vendor/autoload.php';
session_start();
$error = false;
$auth = App::getAuth();
if (!empty($_POST)) {
    $user = $auth->login($_POST['username'], $_POST['password']);
    if ($user) {
        header('Location: index.php?login=1');
        exit();
    }
    $error = true;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body class="p-4">
    <h1>Se connecter</h1>
    <?php if ($error) : ?>
        <div class="alert alert-danger">
            Identifiant ou mot de passe incorrect
        </div>
    <?php endif ?>
    <?php if (isset($_GET['forbid'])) : ?>
        <div class="alert alert-danger">
            L'accés á la page est interdit
        </div>
    <?php endif ?>

    <form action="" method="post">
        <div class="form-group">
            <input type="text" class="form-control" name="username" placeholde="Pseudo">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholde="Password">
        </div>
        <button class="btn tn-primary">Se connecter</button>
    </form>
</body>

</html>