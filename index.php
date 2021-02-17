<?php
require_once './classes/Form.php';
require_once './classes/Table.php';
require_once './db.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>My Scoreboard</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light mb-5" style="background-color: #e3f2fd">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Accueil</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?match">Match</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?php

    if (isset($_GET['match'])) {
        require_once './match.php';
    } else {
    ?>

        <div class="container">
            <div class="row">
                <div class="col-3">
                    <?php
                    $players = $db->query('SELECT * FROM player');
                    $games = $db->query('SELECT * FROM game');
                    $table1 = new Table($db);
                    echo $table1->createTable('Joueur', 'player', 'nickname');
                    ?>
                </div>
                <div class="col-3">
                    <?php
                    echo $table1->createTable('Jeux', 'game', 'title');
                    ?>
                </div>
            </div>

            <div class="row">
                <div class="col-4">
                    <h2 class="mb-2">Ajouter un jeu</h2>
                    <form action="./processing.php?game-form" method="POST">
                        <?php
                        $form1 = new Form;
                        echo $form1->createLabel('title', 'Titre du jeu');
                        echo $form1->createInput('text', 'title');
                        echo $form1->createLabel('min_players', 'Nombre minimum de joueurs');
                        echo $form1->createInput('number', 'min_players');
                        echo $form1->createLabel('max_players', 'Nombre maximum de joueurs');
                        echo $form1->createInput('number', 'max_players');
                        echo $form1->createSubmit();
                        ?>
                    </form>
                </div>

                <div class="col-4">
                    <h2 class="mb-2">Ajouter un joueur</h2>
                    <form action="./processing.php?player-form" method="POST">
                        <?php
                        echo $form1->createLabel('email', 'Adresse email');
                        echo $form1->createInput('email', 'email');
                        echo $form1->createLabel('username', 'Nom d\'utilisateur');
                        echo $form1->createInput('text', 'username');
                        echo $form1->createSubmit();
                        ?>
                    </form>
                </div>

                <div class="col-4">
                    <h2 class="mb-2">Ajouter un match</h2>
                    <form action="./processing.php?contest-form" method="POST">
                        <?php
                        echo $form1->createLabel('start_date', 'Date de début');
                        ?>
                        <?php
                        echo $form1->createInput('text', 'start_date');
                        ?>
                        <div class="form-text">Format&thinsp;: AAAA-MM-JJ</div>
                        <?= $form1->createSubmit(); ?>
                    </form>
                </div>
            </div>
        </div>

    <?php } ?>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>

</html>