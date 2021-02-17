<?php

    $host = 'localhost';
    $dbName = 'wf3_php_final_melvin';
    $user = 'root';
    $password = '';

    $db = new PDO('mysql:host=' . $host . ';dbname=' . $dbName . '; charset=utf8', $user, $password);
