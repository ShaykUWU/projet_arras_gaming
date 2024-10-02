<?php

// Include the database connection file
require_once("../../hautbas/header.php");
require_once("../check.php"); 

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM inscription WHERE id_tournois = ?");
$stmt->execute([$id]);

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
            <h2>Gestion des inscription</h2>
            <p>
            <a href="../tournois/crud_tournois.php" class="btn btn-info">Retourn des tournois</a>
            </p>
            <h2>Liste des Tournois</h2>
            <table class="table table-striped table-bordered text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>Nom du tournoi</th>
                        <th>Pseudo du Joueur</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php   
                    while ($res = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>".$res['id_tournois']."</td>";
                        echo "<td>".$res['pseudo']."</td>";
                        echo "<td>
                                <a href='delete_inscription.php?id_user=". $res ['id_user']."&id_tournois= " .$res ['id_tournois']. "' class='btn btn-outline-danger btn-sm' onClick=\"return confirm('Êtes-vous sûr de vouloir supprimer cette inscription ?')\">Supprimer</a>
                              </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            
        </section>
    </main>
</body>
</html>
