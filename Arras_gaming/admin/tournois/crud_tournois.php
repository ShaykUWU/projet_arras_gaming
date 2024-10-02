<?php

// Include the database connection file
require_once("../../hautbas/header.php");
require_once("../check.php");
// Fetch data in descending order (latest entry first)
$stmt = $pdo->prepare("SELECT tournois.*, jeux.nom AS nom_jeu FROM tournois JOIN jeux ON tournois.id_jeux = jeux.id ");
$stmt->execute();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud Tournois</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

</head>

<body>
    <main class="container mt-4">
        <section>
            <h2>Gestion des tournois</h2>
            <p>
                <a href="../joueur/crud.php" class="btn btn-info">Gestion des Joueurs</a>
                <a href="../jeux/crud_jeu.php" class="btn btn-info">Gestion des jeux</a>
                
            </p>
            <h2>Liste des Tournois</h2>
            <table class="table table-striped table-bordered text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>Nom du tournoi</th>
                        <th>Jeu</th>
                        <th>Date de début</th>
                        <th>Date de fin</th>
                        <th>Nombre max de participants</th>
                        <th>Nombre actuel de participants</th>
                        <th>Cash prize</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php   
                    while ($res = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>". $res['nom']."</td>";
                        echo "<td>". $res['nom_jeu']."</td>";
                        echo "<td>". $res['debut_tournois']."</td>";
                        echo "<td>". $res['fin_tournois']."</td>";
                        echo "<td>". $res['nbr_pers_max']."</td>";
                        echo "<td>". $res['nbr_pers_actuel']."</td>";
                        echo "<td>". $res['cash_prize']."</td>";
                        echo "<td>
                                <a href='edit_tournois.php?id=".$res['id']."' class='btn btn-outline-warning btn-sm'>Modifier</a> 
                                <a href='delete_tournois.php?id=".$res['id']."' class='btn btn-outline-danger btn-sm' onClick=\"return confirm('Êtes-vous sûr de vouloir supprimer ce tournoi ?')\">Supprimer</a>
                                <a href='crud_inscription.php?id=".$res['id']."' class='btn btn-outline-info btn-sm'>Inscription</a> 
                              </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <a href="add_tournois.php" class="btn btn-outline-success">Ajouter un tournoi</a>
        </section>
    </main>
</body>
</html>
