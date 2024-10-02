<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un tournoi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <!-- Inclure l'en-tête -->
    <?php require_once("../../hautbas/header.php"); ?>
    <?php require_once("../check.php"); ?>
    <main class="container mt-4">

        <h2>Ajouter un tournoi</h2>

        <p>
            <a href="crud_tournois.php" class="btn btn-secondary">Retour à la liste des tournois</a>
        </p>

        <!-- Formulaire HTML pour ajouter un tournoi -->
        <form action="" method="post" name="add_tournois" class="mt-3">
            <div class="form-group">
                <label for="nom">Nom du tournoi</label>
                <input type="text" name="nom" id="nom" class="form-control" placeholder="Entrez le nom du tournoi">
            </div>
            <div class="form-group">
                <label for="id_jeux">Jeu</label>
                <select name="id_jeux" id="id_jeux" class="form-control">
                    <?php
                    // Récupérer les jeux disponibles dans la base de données
                    $stmt = $pdo->query("SELECT * FROM jeux");
                    while ($row = $stmt->fetch()) {
                        echo "<option value='" . $row['id'] . "'>" . $row['nom'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="debut_tournois">Date de début du tournoi</label>
                <input type="datetime-local" name="debut_tournois" id="debut_tournois" class="form-control">
            </div>
            <div class="form-group">
                <label for="fin_tournois">Date de fin du tournoi</label>
                <input type="datetime-local" name="fin_tournois" id="fin_tournois" class="form-control">
            </div>
            <div class="form-group">
                <label for="nbr_pers_max">Nombre maximum de participants</label>
                <input type="number" name="nbr_pers_max" id="nbr_pers_max" class="form-control" placeholder="Entrez le nombre maximum de participants">
            </div>
            <div class="form-group">
                <label for="cash_prize">Cash prize</label>
                <input type="number" name="cash_prize" id="cash_prize" class="form-control" placeholder="Entrez le montant du cash prize">
            </div>
            <button type="submit" name="submit" class="btn btn-success">Ajouter le tournoi</button>
        </form>

        <!-- Script PHP pour gérer l'ajout des tournois -->
        <?php
        if (isset($_POST['submit'])) {
            // Récupérer et échapper les valeurs du formulaire
            $nom = $_POST['nom'];
            $id_jeux = $_POST['id_jeux'];
            $debut_tournois = $_POST['debut_tournois'];
            $fin_tournois = $_POST['fin_tournois'];
            $nbr_pers_max = $_POST['nbr_pers_max'];
            $cash_prize = $_POST['cash_prize'];

            // Vérification des champs vides
            if (empty($nom) || empty($id_jeux) || empty($debut_tournois) || empty($fin_tournois) || empty($nbr_pers_max)) {
                echo "<div class='alert alert-danger mt-3'>Tous les champs obligatoires ne sont pas remplis.</div>";
                echo "<a href='javascript:self.history.back();' class='btn btn-warning mt-2'>Retour</a>";
            } else {
                // Insertion dans la base de données
                $stmt = $pdo->prepare("INSERT INTO tournois (`nom`, `id_jeux`, `debut_tournois`, `fin_tournois`, `nbr_pers_max`, `cash_prize`) VALUES (?,?,?,?,?,?)");
                $stmt->execute([$nom, $id_jeux, $debut_tournois, $fin_tournois, $nbr_pers_max, $cash_prize]);

                // Affichage d'un message de succès
                echo "<div class='alert alert-success mt-3'>Tournoi ajouté avec succès !</div>";
            }
        }
        ?>
    </main>
</body>
</html>
