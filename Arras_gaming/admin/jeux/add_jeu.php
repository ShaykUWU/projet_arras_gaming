
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un jeu</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
     <!-- Inclure l'en-tête -->
    <?php require_once("../../hautbas/header.php"); ?>
    <?php require_once("../check.php"); ?>

    <main class="container mt-4">
       
        
        <h2>Ajouter un jeu</h2>
    
            <a href="crud_jeu.php" class="btn btn-secondary">Retour à la liste des jeux</a>
        

        <!-- Formulaire ajouter un joueur -->
        <form action="" method="post" name="add_jeu" class="mt-3">
            <div class="form-group">
                <label for="nom">Nom du jeu</label>
                <input type="text" name="nom" id="nom" class="form-control" placeholder="Entrez le nom du jeu">
            </div>
            <div class="form-group">
                <label for="editeur">L'éditeur du jeu</label>
                <input type="text" name="editeur" id="editeur" class="form-control" placeholder="Entrez l'éditeur du jeu">
            </div>
            <button type="submit" name="submit" class="btn btn-success">Ajouter le jeu</button>
        </form>

        <!-- Script PHP pour gérer l'ajout des joueurs -->
        <?php
        if (isset($_POST['submit'])) {
            // Récupérer et échapper les valeurs du formulaire
            $nom = $_POST['nom'];
            $editeur = $_POST['editeur'];
          

            // Vérification des champs vides
            if (empty($nom) || empty($editeur) ) {
                echo "Tous les champs obligatoires ne sont pas remplis.";
                echo "<a href='javascript:self.history.back();' class='btn btn-warning mt-2'>Retour</a>";
            } else {
                // Insertion dans la base de données
                $stmt = $pdo->prepare("INSERT INTO jeux (`nom`, `editeur`) VALUES (?,?)");
                $stmt->execute([$nom, $editeur]);

                // Affichage d'un message de succès
                echo "Jeu ajouté avec succès !";
            }
        }
        ?>
    </main>
</body>
</html>
