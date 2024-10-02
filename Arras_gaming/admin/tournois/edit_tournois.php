
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un tournoi</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
     <!-- Inclure l'en-tête -->
     <?php require_once("../../hautbas/header.php"); ?>
     <?php require_once("../check.php"); ?>
    <main>
       

        <?php
        // Inclure la connexion à la base de données

        // Récupérer l'id du tournoi à éditer depuis l'URL
        $id = $_GET['id'];

        // Sélectionner les données du tournoi associé à cet ID
        $stmt = $pdo->prepare("SELECT * FROM tournois WHERE id = ?");
        $stmt->execute([$id]);
        $tournoi = $stmt->fetch(PDO::FETCH_ASSOC);

        // Récupérer les informations du tournoi
        $nom = $tournoi['nom'];
        $id_jeux = $tournoi['id_jeux'];
        $debut_tournois = $tournoi['debut_tournois'];
        $fin_tournois = $tournoi['fin_tournois'];
        $nbr_pers_max = $tournoi['nbr_pers_max'];
        $nbr_pers_actuel = $tournoi['nbr_pers_actuel'];
        $cash_prize = $tournoi['cash_prize'];
        ?>

        <h2>Modifier le tournoi</h2>
        <p><a href="crud_tournois.php" class="btn btn-secondary">Retour aux tournois</a></p>

        <!-- Formulaire pour modifier un tournoi -->
        <form action="" method="post" name="edit_tournois">
            <table class="table table-bordered" width="50%">
                <tr>
                    <td>Nom du tournoi</td>
                    <td><input type="text" name="nom" class="form-control" value="<?php echo $nom; ?>"></td>
                </tr>
                <tr>
                    <td>Jeu</td>
                    <td>
                        <select name="id_jeux" class="form-control">
                        <option value="">--Choisir un jeux--</option>
                            <?php
                            // Récupérer les jeux disponibles dans la base de données
                            $stmt = $pdo->query("SELECT * FROM jeux");
                            while ($row = $stmt->fetch()) {
                                $selected = ($row['id']) ? 'selected' : '';
                                echo "<option value='" . $row['id'] . "' $selected>" . $row['nom'] . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Date début tournoi</td>
                    <td><input type="datetime-local" name="debut_tournois" class="form-control" value="<?php echo $debut_tournois; ?>"></td>
                </tr>
                <tr>
                    <td>Date fin tournoi</td>
                    <td><input type="datetime-local" name="fin_tournois" class="form-control" value="<?php echo $fin_tournois; ?>"></td>
                </tr>
                <tr>
                    <td>Nombre max de participants</td>
                    <td><input type="number" name="nbr_pers_max" class="form-control" value="<?php echo $nbr_pers_max; ?>"></td>
                </tr>
                <tr>
                    <td>Nombre actuel de participants</td>
                    <td><input type="number" name="nbr_pers_actuel" class="form-control" value="<?php echo $nbr_pers_actuel; ?>"></td>
                </tr>
                <tr>
                    <td>Cash prize</td>
                    <td><input type="number" name="cash_prize" class="form-control" value="<?php echo $cash_prize; ?>"></td>
                </tr>
                <tr>
                    <td><input type="hidden" name="id" value="<?php echo $id; ?>"></td>
                    <td><input type="submit" name="update" class="btn btn-primary" value="Update Tournoi"></td>
                </tr>
            </table>
        </form>

        <!-- Script PHP pour mettre à jour le tournoi -->
        <?php
        if (isset($_POST['update'])) {
            // Récupérer les valeurs du formulaire
            $id =  $_POST['id'];
            $nom = $_POST['nom'];
            $id_jeux = $_POST['id_jeux'];
            $debut_tournois = $_POST['debut_tournois'];
            $fin_tournois = $_POST['fin_tournois'];
            $nbr_pers_max = $_POST['nbr_pers_max'];
            $nbr_pers_actuel = $_POST['nbr_pers_actuel'];
            $cash_prize = $_POST['cash_prize'];
            

            // Vérification des champs vides
            if (empty($nom) || empty($id_jeux) || empty($debut_tournois) || empty($fin_tournois) || empty($nbr_pers_max)) {
                echo "<div class='alert alert-danger'>Tous les champs obligatoires ne sont pas remplis.</div>";
            } else {
                // Mise à jour du tournoi dans la base de données
                $stmt = $pdo->prepare("UPDATE tournois SET nom = ?, id_jeux = ?, debut_tournois = ?, fin_tournois = ?, nbr_pers_max = ?, nbr_pers_actuel = ?, cash_prize = ? WHERE id = ?");
                $stmt->execute([$nom, $id_jeux, $debut_tournois, $fin_tournois, $nbr_pers_max, $nbr_pers_actuel, $cash_prize, $id]);

                // Affichage d'un message de succès
                echo "<div class='alert alert-success'>Tournoi mis à jour avec succès !</div>";
            }
        }
        ?>
    </main>
</body>
</html>
