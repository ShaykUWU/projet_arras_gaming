<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un joueur</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
     <!-- Inclure l'en-tête -->
     <?php require_once("../../hautbas/header.php"); ?>
     <?php require_once("../check.php"); ?>
    <main class="container mt-4">
       
        
        <h2>Ajouter un joueur</h2>
    
            <a href="crud.php" class="btn btn-secondary">Retour à la liste des joueurs</a>
        

        <!-- Formulaire HTML pour ajouter un joueur -->
        <form action="" method="post" name="add_joueur" class="mt-3">
            <div class="form-group">
                <label for="login">Login du joueur</label>
                <input type="text" name="login" id="login" class="form-control" placeholder="Entrez le login">
            </div>
            <div class="form-group">
                <label for="mdp">Mot de passe du joueur</label>
                <input type="text" name="mdp" id="mdp" class="form-control" placeholder="Entrez le mot de passe">
            </div>
            <div class="form-group">
                <label for="mail">Email du joueur</label>
                <input type="email" name="mail" id="mail" class="form-control" placeholder="Entrez l'email">
            </div>
            <div class="form-group">
                <label for="pseudo">Pseudo du joueur</label>
                <input type="text" name="pseudo" id="pseudo" class="form-control" placeholder="Entrez le pseudo">
            </div>
            <button type="submit" name="submit" class="btn btn-success">Ajouter le joueur</button>
        </form>

        <!-- Script PHP pour gérer l'ajout des joueurs -->
        <?php
        if (isset($_POST['submit'])) {
            // Récupérer et échapper les valeurs du formulaire
            $login = $_POST['login'];
            $mdp = $_POST['mdp'];
            $mail = $_POST['mail'];
            $pseudo = $_POST['pseudo'];

            // Vérification des champs vides
            if (empty($login) || empty($mdp) || empty($mail) || empty($pseudo)) {
                echo "<div class='alert alert-danger mt-3'>Tous les champs obligatoires ne sont pas remplis.</div>";
                echo "<a href='javascript:self.history.back();' class='btn btn-warning mt-2'>Retour</a>";
            } else {
                // Insertion dans la base de données
                $stmt = $pdo->prepare("INSERT INTO utilisateurs (`login`, `mdp`, `mail`, `pseudo`) VALUES (?,?,?,?)");
                $stmt->execute([$login, $mdp, $mail, $pseudo]);

                // Affichage d'un message de succès
                echo "<div class='alert alert-success mt-3'>Joueur ajouté avec succès !</div>";
            }
        }
        ?>
    </main>
</body>
</html>
