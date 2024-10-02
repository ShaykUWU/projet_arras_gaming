<?php
$db="arras_game";
$dbhost="localhost";
$dbport=3306;
$dbuser="root";
$dbpasswd="root";
// Open a new connection to the dpo server

$pdo = new PDO('mysql:host='.$dbhost.';port='.$dbport.';dbname='.$db.'', $dbuser, $dbpasswd);
$pdo->exec("SET CHARACTER SET utf8");