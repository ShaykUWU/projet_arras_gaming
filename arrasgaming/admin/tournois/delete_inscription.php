<?php
// Include the database connection file
require_once("../../connexion/stayconnect.php");

// Get id parameter value from URL
$id_user = $_GET['id_user'];
$id_tournois = $_GET['id_tournois'];

// Delete row from the database table
$stmt = $pdo->prepare("DELETE FROM inscription WHERE id_user = '$id_user' AND id_tournois = '$id_tournois';");
$stmt->execute();
$stmt = $pdo->prepare("UPDATE tournois SET nbr_pers_actuel = nbr_pers_actuel - 1 WHERE id = '$id_tournois';");
$stmt->execute();

// Redirect to the main display page (index.php in our case)
header("Location:crud_tournois.php");
