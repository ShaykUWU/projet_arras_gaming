
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un joueur</title>
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
        $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE id = ?");
        $stmt->execute([$id]);
        $joueur = $stmt->fetch(PDO::FETCH_ASSOC);

        // Extraire les informations du joueur
        $login = $joueur['login'];
        $mdp = $joueur['mdp'];
        $mail = $joueur['mail'];
        $pseudo = $joueur['pseudo'];
        $id_role = $joueur['id_role'];
    ?>


    <main class="container mt-4">

        <h2>Modifier le joueur</h2>
        <p>
            <a href="crud.php" class="btn btn-secondary">Retour à la liste des joueurs</a>
        </p>

        <!-- Formulaire pour modifier un joueur -->
        <form action="" method="post" name="edit_joueur" class="mt-3">
            <div class="form-group">
                <label for="login">Login du joueur</label>
                <input type="text" name="login" id="login" class="form-control" value="<?php echo $login; ?>">
            </div>
            <div class="form-group">
                <label for="mdp">Mot de passe du joueur</label>
                <input type="text" name="mdp" id="mdp" class="form-control" value="<?php echo $mdp; ?>">
            </div>
            <div class="form-group">
                <label for="mail">Mail du joueur</label>
                <input type="email" name="mail" id="mail" class="form-control" value="<?php echo $mail; ?>">
            </div>
            <div class="form-group">
                <label for="pseudo">Pseudo du joueur</label>
                <input type="text" name="pseudo" id="pseudo" class="form-control" value="<?php echo $pseudo; ?>">
            </div>
            <div class="form-group">
                <label for="role">Rôle du joueur</label>
                <select name="id_role" id="role" class="form-control">
                    <?php
                    // Récupérer les rôles disponibles dans la base de données
                    $stmt = $pdo->query("SELECT * FROM role");
                    while ($row = $stmt->fetch()) {
                        $selected = ($row['id'] == $id_role) ? 'selected' : '';
                        echo "<option value='" . $row['id'] . "' $selected>" . $row['name'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <button type="submit" name="update" class="btn btn-primary">Mettre à jour le joueur</button>
        </form>

        <!-- Script PHP pour mettre à jour le joueur -->
        <?php
        if (isset($_POST['update'])) {
            // Récupérer les valeurs du formulaire
            $login = $_POST['login'];
            $mdp = $_POST['mdp'];
            $mail = $_POST['mail'];
            $pseudo = $_POST['pseudo'];
            $id_role = $_POST['id_role'];

            // Vérification des champs vides
            if (empty($login) || empty($mdp) || empty($mail) || empty($pseudo)) {
                echo "<p class='text-danger'>Tous les champs obligatoires ne sont pas remplis.</p>";
            } else {
                // Mise à jour du joueur dans la base de données
                $stmt = $pdo->prepare("UPDATE utilisateurs SET `login` = ?, mdp = ?, mail = ?, pseudo = ?, id_role = ? WHERE id = ?");
                $stmt->execute([$login, $mdp, $mail, $pseudo, $id_role, $id]);

                // Affichage d'un message de succès
                echo "<p class='text-success'>Joueur mis à jour avec succès !</p>";
                
            }
        }
        ?>
    </main>
</body>
</html>
