<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tournois</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php 

require_once("hautbas/header.php");

// Vérifie si l'utilisateur est connecté
$isConnected = isset($_SESSION['login']);
$id_user = $_SESSION['id_user'];
?>

<div class="container">
    <h2>Tournois disponibles</h2>

    <?php
    // Récupère les tournois de la base de données
    $stmt = $pdo->query("SELECT tournois.*, jeux.nom AS nom_jeu FROM tournois JOIN jeux ON tournois.id_jeux = jeux.id");


    // Affiche chaque tournoi dans une boîte
    while ($res = $stmt->fetch()) {
        $nbr_pers_restante = $res['nbr_pers_max'] - $res['nbr_pers_actuel'];

        // Vérifie si l'utilisateur est déjà inscrit à ce tournoi
        $stmtinscri = $pdo->prepare("SELECT * FROM inscription WHERE id_user = ? AND id_tournois = ?");
        $stmtinscri->execute([$id_user, $res['id']]);
        $inscription = $stmtinscri->fetch();
    ?>

        <div class="tournoi-box">
            <img src="images/<?= $res['nom_jeu'] ?>.jpg" alt="<?= $res['nom_jeu'] ?>">

            <div class="tournoi-details">
                <div class="tournoi-title"><?= ($res['nom']); ?></div>
                <div class="tournoi-info"><strong>Jeu :</strong> <?= ($res['nom_jeu']); ?></div>
                <div class="tournoi-info"><strong>Cash Prize :</strong> <?= ($res['cash_prize']); ?> €</div>
                <div class="tournoi-info"><strong>Début du tournoi :</strong> <?= ($res['debut_tournois']); ?></div>
                <div class="tournoi-info"><strong>Fin du tournoi :</strong> <?= ($res['fin_tournois']); ?></div>
                <div class="tournoi-info"><strong>Participants :</strong> <?= ($res['nbr_pers_actuel']); ?>/<?=$res['nbr_pers_max']; ?></div>
            </div>

            <div>
                <?php if ($isConnected): ?>
                    <!-- Formulaire d'inscription ou de désinscription -->
                    <form action="" method="post">
                        <input type="hidden" name="tournoi_id" value="<?= $res['id']; ?>">
                        
                        <?php if ($inscription): ?>
                            <button type="submit" name="desinscrire" class="btn btn-danger"><h4>Se désinscrire</h4></button>
                        <?php elseif ($nbr_pers_restante > 0): ?>
                            <button type="submit" name="submit" class="btn btn-primary"><h4>S'inscrire</h4></button>
                        <?php else: ?>
                            <button type="button" class="btn btn-secondary" disabled>Complet</button>
                        <?php endif; ?>
                    </form>
                <?php else: ?>
                    <!-- Invitation à se connecter -->
                    <p><a href="connexion/connexions.php" class="btn btn-warning">Connectez-vous pour vous inscrire</a></p>
                <?php endif; ?>
            </div>
        </div>

    <?php
    }
    ?>
</div>

<?php
    // Traitement de l'inscription après soumission du formulaire
    if (isset($_POST['submit'])) {
        $id_tournois = $_POST['tournoi_id'];

        // Vérifie si l'utilisateur est déjà inscrit
        $stmtinscri = $pdo->prepare("SELECT * FROM inscription WHERE id_user = ? AND id_tournois = ?");
        $stmtinscri->execute([$id_user, $id_tournois]);
        $inscription = $stmtinscri->fetch();

        if ($inscription) {
            echo "Vous êtes déjà inscrit à ce tournoi.";
        } else {
            // Inscription de l'utilisateur au tournoi
            $stmtinscri = $pdo->prepare("INSERT INTO inscription (id_user, id_tournois) VALUES (?, ?)");
            $stmtinscri->execute([$id_user, $id_tournois]);

            // Mise à jour du nombre de participants actuels
            $stmt = $pdo->prepare("UPDATE tournois SET nbr_pers_actuel = nbr_pers_actuel + 1 WHERE id = ?");
            $stmt->execute([$id_tournois]);

            echo "Inscription réussie !";
            
        }
    }

    // Traitement de la désinscription
    if (isset($_POST['desinscrire'])) {
        $id_tournois = $_POST['tournoi_id'];

        // Désinscription de l'utilisateur
        $stmt = $pdo->prepare("DELETE FROM inscription WHERE id_user = ? AND id_tournois = ?");
        $stmt->execute([$id_user, $id_tournois]);

        // Mise à jour du nombre de participants actuels
        $stmt = $pdo->prepare("UPDATE tournois SET nbr_pers_actuel = nbr_pers_actuel - 1 WHERE id = ?");
        $stmt->execute([$id_tournois]);

        echo "Désinscription réussie !";
        
    }

    require_once("hautbas/footer.php");
?>
</body>
</html>
