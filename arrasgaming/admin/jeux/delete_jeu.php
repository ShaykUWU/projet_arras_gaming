<?php
// Include the database connection file
require_once("../../connexion/stayconnect.php");

// Get id parameter value from URL
$id = $_GET['id'];

// Delete row from the database table
$stmt = $pdo->prepare("DELETE FROM jeux WHERE id = $id");
$stmt->execute();
// Redirect to the main display page (index.php in our case)
header("Location: crud_jeu.php");
