<?php

// Inclure la connexion à la base de données et le header
require_once("../../hautbas/header.php");
require_once("../check.php");
// Récupérer les données des utilisateurs en ordre croissant d'id
$stmt = $pdo->prepare("SELECT * FROM jeux");
$stmt->execute();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD des jeu</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <main class="container mt-4" id="joueurs-table">
        <section>
            <h2>Gestion des jeux</h2>
            <p>
                <a href="../tournois/crud_tournois.php" class="btn btn-info">Gestion des tournois</a>
                <a href="../joueur/crud.php" class="btn btn-info">Gestion des joueurs</a>
            </p>

            <h2>Table des jeux</h2>
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Id</th>
                        <th>Nom du jeux</th>
                        <th>Edituer</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Récupérer et afficher chaque utilisateur dans un tableau
                    while ($res = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . $res['id'] . "</td>";
                        echo "<td>" . $res['nom'] . "</td>";
                        echo "<td>" . $res['editeur'] . "</td>";
                        echo "<td>
                                <a href=\"edit_jeu.php?id=" . $res['id'] . "\" class='btn btn-outline-warning btn-sm'>Modifier</a> 
                                <a href=\"delete_jeu.php?id=" . $res['id'] . "\" class='btn btn-outline-danger btn-sm' onClick=\"return confirm('Êtes-vous sûr de vouloir supprimer ?')\">Supprimer</a>
                              </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>

            <!-- Bouton pour ajouter un nouveau joueur -->
            <a href="add_jeu.php" class="btn btn-outline-success">Ajouter un jeu</a>
        </section>
    </main>
</body>
</html>
