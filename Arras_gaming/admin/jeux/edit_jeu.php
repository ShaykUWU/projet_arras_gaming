<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un jeu</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>

    <?php require_once("../../hautbas/header.php"); ?>
    <?php require_once("../check.php"); ?>
    <?php 
        // Inclure la connexion à la base de données

        // Récupérer l'id du joueur à éditer depuis l'URL
        $id = $_GET['id'];

        // Préparer et exécuter la requête pour récupérer les informations du joueur
        $stmt = $pdo->prepare("SELECT * FROM jeux WHERE id = ?");
        $stmt->execute([$id]);
        $joueur = $stmt->fetch(PDO::FETCH_ASSOC);

        // Extraire les informations du joueur
        $nom = $joueur['nom'];
        $editeur = $joueur['editeur'];
     
    ?>


    <main class="container mt-4">

        <h2>Modifier le jeu</h2>
        <p>
            <a href="crud_jeu.php" class="btn btn-secondary">Retour à la liste des jeux</a>
        </p>

        <!-- Formulaire pour modifier un joueur -->
        <form action="" method="post" name="edit_jeu" class="mt-3">
            <div class="form-group">
                <label for="nom">Nom du jeu</label>
                <input type="text" name="nom" id="nom" class="form-control" value="<?php echo $nom; ?>">
            </div>
            <div class="form-group">
                <label for="editeur">L'éditeur</label>
                <input type="text" name="editeur" id="editeur" class="form-control" value="<?php echo $editeur; ?>">
            </div>
           
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <button type="submit" name="update" class="btn btn-primary">Mettre à jour le jeu</button>
        </form>

        <!-- Script PHP pour mettre à jour le joueur -->
        <?php
        if (isset($_POST['update'])) {
            // Récupérer les valeurs du formulaire
            $nom = $_POST['nom'];
            $editeur = $_POST['editeur'];
      

            // Vérification des champs vides
            if (empty($nom) || empty($editeur) ) {
                echo "<p class='text-danger'>Tous les champs obligatoires ne sont pas remplis.</p>";
            } else {
                // Mise à jour du joueur dans la base de données
                $stmt = $pdo->prepare("UPDATE jeux SET `nom` = ?, editeur = ? WHERE id = ?");
                $stmt->execute([$nom, $editeur, $id]);

                // Affichage d'un message de succès
                echo "<p class='text-success'>Joueur mis à jour avec succès !</p>";
                
            }
        }
        ?>
    </main>
</body>
</html>
