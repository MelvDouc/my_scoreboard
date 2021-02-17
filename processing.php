<?php

require_once('./db.php');


if (isset($_GET['game-form'])) {
    $title = $_POST['title'];
    $min_players = (int)$_POST['min_players'];
    $max_players = (int)$_POST['max_players'];
    if ($title === null || $min_players === null || $max_players === null) {
        echo 'Veuillez remplir tous les champs.';
    } else {
        $query = $db->query('SELECT * FROM game WHERE title=\'' . $title . '\'')->fetch();
        if ($query != false) {
            echo 'Jeu déjà dans la base de données.';
            die();
        } else {
            if (!is_string($title)) {
                echo 'Titre invalide ou indisponible.';
            } else {
                if (!is_int($min_players) || !is_int($max_players)) {
                    echo 'Le nombres de joueurs doivent être des nombres entiers.';
                    var_dump($_POST);
                } else {
                    if ($min_players > $max_players) {
                        echo 'Le nombre minimum de joueurs ne peut pas être supérieur au nombre maximum.';
                        var_dump($_POST);
                    } else {
                        $req = $db->prepare('INSERT INTO game (title, min_players, max_players) VALUES (:title, :min_players, :max_players)');
                        $req->bindParam(':title', $title, PDO::PARAM_STR);
                        $req->bindParam(':min_players', $min_players, PDO::PARAM_INT);
                        $req->bindParam(':max_players', $max_players, PDO::PARAM_INT);

                        $req->execute();

                        header('Location: index.php');
                    }
                }
            }
        }
    }
} else if (isset($_GET['player-form'])) {
    $email = $_POST['email'];
    $username = $_POST['username'];
    if ($email === null || $username === null) {
        echo 'Veuillez remplir tous les champs.';
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo 'Adresse email invalide.';
        } else {
            if (!is_string($username)) {
                echo 'Nom d\'utilisateur invalide.';
            } else {
                $query = $db->query('SELECT email FROM player WHERE email=\'' . $email . '\'')->fetch();
                if ($query != false) {
                    echo 'Adresse email indisponible';
                } else {
                    $query = $db->query('SELECT nickname FROM player WHERE nickname=\'' . $username . '\'')->fetch();
                    if ($query != false) {
                        echo 'Nom d\'utilisateur indisponible';
                    } else {
                        $req = $db->prepare('INSERT INTO player (email, nickname) VALUES (:email, :nickname)');
                        $req->bindParam(':email', $email, PDO::PARAM_STR);
                        $req->bindParam(':nickname', $username, PDO::PARAM_STR);

                        $req->execute();

                        header('Location: index.php');
                    }
                }
            }
        }
    }
} else if (isset($_GET['contest-form'])) {
    if (!strtotime($_POST['start_date'])) {
        echo 'Date invalide.';
    } else {
        $req = $db->prepare('INSERT INTO contest (start_date) VALUES (DATE(:start_date))');
        $req->bindParam(':start_date', $_POST['start_date'], PDO::PARAM_STR);

        $req->execute();

        header('Location: index.php');
    }
}
